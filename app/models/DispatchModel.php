<?php

namespace app\models;

use app\utils\Database;
use app\models\AttributionModel;
use PDO;

class DispatchModel
{
    private $db;
    private $attributionModel;

    public function __construct()
    {
        $this->db = Database::getConnection();
        $this->attributionModel = new AttributionModel();
    }

    /**
     * Lancer le dispatch automatique des dons selon le mode choisi
     */
    public function run($mode = 'fifo')
    {
        try {
            $dons = $this->getDonsNonAttribues(); // Appel à la méthode corrigée
            $besoins = $this->getBesoinsAvecRestes();
            
            if (empty($dons)) {
                return ['success' => true, 'message' => 'Aucun don disponible'];
            }
            
            if (empty($besoins)) {
                return ['success' => true, 'message' => 'Aucun besoin en attente'];
            }
            
            $totalAttributions = 0;
            
            foreach ($dons as $don) {
                $resteDon = ($don->type === 'argent') ? $don->montant : $don->quantite;
                
                $besoinsCompatibles = array_filter($besoins, function($b) use ($don) {
                    return $b->type === $don->type && 
                           $b->libelle === $don->libelle && 
                           $b->reste > 0;
                });
                
                if (empty($besoinsCompatibles)) continue;
                
                $besoinsTries = $this->trierBesoins($besoinsCompatibles, $mode);
                
                switch ($mode) {
                    case 'smallest':
                        $attributions = $this->distribuerPlusPetite($don, $besoinsTries, $resteDon);
                        break;
                        
                    case 'proportional':
                        $attributions = $this->distribuerProportionnel($don, $besoinsTries, $resteDon);
                        break;
                        
                    default:
                        $attributions = $this->distribuerFIFO($don, $besoinsTries, $resteDon);
                        break;
                }
                
                $totalAttributions += count($attributions);
            }
            
            return [
                'success' => true,
                'message' => "$totalAttributions nouvelle(s) attribution(s) créée(s) en mode $mode"
            ];
            
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Récupérer les dons disponibles (en tenant compte des quantités déjà attribuées)
     * 
     * CETTE MÉTHODE DOIT ÊTRE AJOUTÉE ICI
     */
    public function getDonsNonAttribues()
    {
        $sql = "SELECT d.*,
                       d.quantite - COALESCE((
                           SELECT SUM(quantite_attribuee) 
                           FROM attributions 
                           WHERE don_id = d.id
                       ), 0) as quantite_restante,
                       d.montant - COALESCE((
                           SELECT SUM(montant_attribue) 
                           FROM attributions 
                           WHERE don_id = d.id
                       ), 0) as montant_restant
                FROM dons d
                HAVING 
                    (d.type = 'argent' AND montant_restant > 0) OR
                    (d.type != 'argent' AND quantite_restante > 0)
                ORDER BY d.date_don ASC";
        
        $stmt = $this->db->query($sql);
        $dons = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        // Transformer pour garder la même structure
        foreach ($dons as $don) {
            if ($don->type === 'argent') {
                $don->montant = $don->montant_restant;
            } else {
                $don->quantite = $don->quantite_restante;
            }
            // Nettoyer les propriétés temporaires
            unset($don->quantite_restante);
            unset($don->montant_restant);
        }
        
        return $dons;
    }

    /**
     * Récupérer les besoins avec leurs restes
     */
    public function getBesoinsAvecRestes()
    {
        $sql = "SELECT b.*, v.nom AS ville_nom, v.region,
                       COALESCE(SUM(
                           CASE 
                               WHEN b.type = 'argent' THEN a.montant_attribue
                               ELSE a.quantite_attribuee
                           END
                       ), 0) AS total_attribue,
                       CASE 
                           WHEN b.type = 'argent' THEN b.quantite - COALESCE(SUM(a.montant_attribue), 0)
                           ELSE b.quantite - COALESCE(SUM(a.quantite_attribuee), 0)
                       END AS reste
                FROM besoins b
                JOIN villes v ON b.ville_id = v.id
                LEFT JOIN attributions a ON b.id = a.besoin_id
                GROUP BY b.id
                HAVING reste > 0
                ORDER BY b.created_at ASC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Trier les besoins selon le mode
     */
    public function trierBesoins($besoins, $mode)
    {
        $besoinsArray = array_values($besoins);
        
        switch ($mode) {
            case 'smallest':
                usort($besoinsArray, fn($a, $b) => $a->reste - $b->reste);
                break;
            case 'proportional':
                // Pas de tri spécifique
                break;
            default: // fifo
                usort($besoinsArray, fn($a, $b) => strtotime($a->created_at) - strtotime($b->created_at));
        }
        
        return $besoinsArray;
    }

    /**
     * Distribution FIFO
     */
    public function distribuerFIFO($don, $besoins, $resteDon)
    {
        $attributions = [];
        
        foreach ($besoins as $besoin) {
            if ($resteDon <= 0) break;
            
            $besoinRestant = $besoin->reste;
            $quantiteAAttribuer = min($resteDon, $besoinRestant);
            
            if ($quantiteAAttribuer > 0) {
                $attribution = $this->creerAttribution($don, $besoin, $quantiteAAttribuer);
                $attributions[] = $attribution;
                
                $resteDon -= $quantiteAAttribuer;
                $besoin->reste -= $quantiteAAttribuer;
            }
        }
        
        return $attributions;
    }

    /**
     * Distribution plus petite demande
     */
    public function distribuerPlusPetite($don, $besoins, $resteDon)
    {
        $attributions = [];
        
        // Trier par reste croissant
        usort($besoins, function($a, $b) {
            return $a->reste - $b->reste;
        });
        
        foreach ($besoins as $besoin) {
            if ($resteDon <= 0) break;
            
            $besoinRestant = $besoin->reste;
            $quantiteAAttribuer = min($resteDon, $besoinRestant);
            
            if ($quantiteAAttribuer > 0) {
                $attribution = $this->creerAttribution($don, $besoin, $quantiteAAttribuer);
                $attributions[] = $attribution;
                
                $resteDon -= $quantiteAAttribuer;
                $besoin->reste -= $quantiteAAttribuer;
            }
        }
        
        return $attributions;
    }

    /**
     * Distribution proportionnelle
     */
    public function distribuerProportionnel($don, $besoins, $resteDon)
    {
        $attributions = [];
        
        $totalBesoins = array_reduce($besoins, function($carry, $besoin) {
            return $carry + $besoin->reste;
        }, 0);
        
        if ($totalBesoins <= 0) return $attributions;
        
        $parts = [];
        $totalAttribue = 0;
        
        foreach ($besoins as $besoin) {
            $partTheorique = ($besoin->reste / $totalBesoins) * $resteDon;
            $partEntiere = floor($partTheorique);
            $decimal = $partTheorique - $partEntiere;
            
            $parts[] = [
                'besoin' => $besoin,
                'part_entiere' => $partEntiere,
                'decimal' => $decimal
            ];
            
            $totalAttribue += $partEntiere;
        }
        
        $resteADistribuer = $resteDon - $totalAttribue;
        
        usort($parts, function($a, $b) {
            return $b['decimal'] <=> $a['decimal'];
        });
        
        for ($i = 0; $i < min($resteADistribuer, count($parts)); $i++) {
            if ($parts[$i]['decimal'] > 0) {
                $parts[$i]['part_entiere']++;
            }
        }
        
        foreach ($parts as $part) {
            if ($part['part_entiere'] > 0) {
                $attribution = $this->creerAttribution($don, $part['besoin'], $part['part_entiere']);
                $attributions[] = $attribution;
                $part['besoin']->reste -= $part['part_entiere'];
            }
        }
        
        return $attributions;
    }

    /**
     * Créer une attribution
     */
    public function creerAttribution($don, $besoin, $quantite)
    {
        $attributionData = [
            'don_id' => $don->id,
            'besoin_id' => $besoin->id,
            'ville_id' => $besoin->ville_id
        ];
        
        if ($don->type === 'argent') {
            $attributionData['montant_attribue'] = round($quantite, 2);
            $attributionData['quantite_attribuee'] = null;
        } else {
            $attributionData['quantite_attribuee'] = round($quantite, 2);
            $attributionData['montant_attribue'] = null;
        }
        
        $this->attributionModel->create($attributionData);
        
        return $attributionData;
    }

    /**
     * Réinitialiser toutes les attributions
     */
    public function resetAll()
    {
        $sql = "DELETE FROM attributions";
        return $this->db->exec($sql);
    }
}