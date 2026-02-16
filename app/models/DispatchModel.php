<?php

namespace app\models;

use app\utils\Database;
use app\models\AttributionModel;
use Flight;
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
     * Lancer le dispatch automatique des dons
     */
    public function run()
    {
        // 1. Récupérer tous les dons non attribués (ou on va tout réattribuer)
        $dons = $this->getDonsNonAttribues();
        
        // 2. Récupérer tous les besoins avec leurs restes
        $besoins = $this->getBesoinsAvecRestes();
        
        $attributions = [];
        
        // 3. Pour chaque don (trié par date)
        foreach ($dons as $don) {
            // Filtrer les besoins compatibles (même type et même libellé)
            $besoinsCompatibles = array_filter($besoins, function($besoin) use ($don) {
                return $besoin->type === $don->type && 
                       $besoin->libelle === $don->libelle && 
                       $besoin->reste > 0;
            });
            
            // Trier par date de création (plus ancien d'abord)
            usort($besoinsCompatibles, function($a, $b) {
                return strtotime($a->created_at) - strtotime($b->created_at);
            });
            
            $resteDon = $don->type === 'argent' ? $don->montant : $don->quantite;
            
            // 4. Distribuer le don aux besoins
            foreach ($besoinsCompatibles as $besoin) {
                if ($resteDon <= 0) break;
                
                $besoinRestant = $besoin->reste;
                $quantiteAAttribuer = min($resteDon, $besoinRestant);
                
                if ($quantiteAAttribuer > 0) {
                    // Créer l'attribution
                    $attributionData = [
                        'don_id' => $don->id,
                        'besoin_id' => $besoin->id,
                        'ville_id' => $besoin->ville_id
                    ];
                    
                    if ($don->type === 'argent') {
                        $attributionData['montant_attribue'] = $quantiteAAttribuer;
                        $attributionData['quantite_attribuee'] = null;
                    } else {
                        $attributionData['quantite_attribuee'] = $quantiteAAttribuer;
                        $attributionData['montant_attribue'] = null;
                    }
                    
                    $this->attributionModel->create($attributionData);
                    
                    // Mettre à jour les variables pour la suite
                    $resteDon -= $quantiteAAttribuer;
                    $besoin->reste -= $quantiteAAttribuer;
                    
                    $attributions[] = $attributionData;
                }
            }
        }
        
        return [
            'success' => true,
            'message' => count($attributions) . ' attribution(s) créée(s)',
            'count' => count($attributions)
        ];
    }

    /**
     * Récupérer les dons non attribués (ou tous pour simplifier)
     */
    private function getDonsNonAttribues()
    {
        $sql = "SELECT d.* 
                FROM dons d
                LEFT JOIN attributions a ON d.id = a.don_id
                WHERE a.id IS NULL
                ORDER BY d.date_don ASC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Récupérer les besoins avec leurs restes
     */
    private function getBesoinsAvecRestes()
    {
        $sql = "SELECT b.*, v.nom AS ville_nom,
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
                INNER JOIN villes v ON b.ville_id = v.id
                LEFT JOIN attributions a ON b.id = a.besoin_id
                GROUP BY b.id
                HAVING reste > 0
                ORDER BY b.created_at ASC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Réinitialiser et tout redistribuer
     */
    public function redistribute()
    {
        // Supprimer toutes les attributions
        $this->attributionModel->resetAll();
        
        // Relancer le dispatch
        return $this->run();
    }
}