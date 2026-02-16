<?php

namespace app\controllers;

use app\models\VilleModel;
use Flight;

class VilleController
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = Flight::get('flight.base_url') ?: '';
    }

    /**
     * Afficher le formulaire d'ajout d'une ville
     */
    public function ajouter()
    {
        Flight::render('villes/ajouter', [
            'title' => 'Ajouter une ville - BNGRC'
        ]);
    }

    /**
     * Traiter le formulaire d'ajout
     */
    public function save()
    {
        $data = $_POST;

        // Validation simple
        if (empty($data['nom']) || empty($data['region'])) {
            $_SESSION['error'] = "Tous les champs sont obligatoires";
            Flight::redirect('/villes/ajouter');
            return;
        }

        $villeModel = new VilleModel();

        if ($villeModel->create($data)) {
            $_SESSION['success'] = "Ville ajoutée avec succès";
            Flight::redirect('/villes/liste');
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout";
            Flight::redirect('/villes/ajouter');
        }
    }

    /**
     * Afficher la liste des villes
     */
    public function liste()
    {
        $villeModel = new VilleModel();
        $villes = $villeModel->getAll();

        Flight::render('villes/liste', [
            'title' => 'Liste des villes - BNGRC',
            'villes' => $villes
        ]);
    }

    /**
     * Afficher le formulaire de modification
     */
    public function modifier($id)
    {
        $villeModel = new VilleModel();
        $ville = $villeModel->getById($id);
        
        if (!$ville) {
            $_SESSION['error'] = "Ville non trouvée";
            Flight::redirect('/villes/liste');
            return;
        }

        Flight::render('villes/modifier', [
            'title' => 'Modifier une ville - BNGRC',
            'ville' => $ville
        ]);
    }

    /**
     * Traiter la modification
     */
    public function update($id)
    {
        $data = $_POST;

        // Validation simple
        if (empty($data['nom']) || empty($data['region'])) {
            $_SESSION['error'] = "Tous les champs sont obligatoires";
            Flight::redirect('/villes/modifier/' . $id);
            return;
        }

        $villeModel = new VilleModel();

        if ($villeModel->update($id, $data)) {
            $_SESSION['success'] = "Ville modifiée avec succès";
            Flight::redirect('/villes/liste');
        } else {
            $_SESSION['error'] = "Erreur lors de la modification";
            Flight::redirect('/villes/modifier/' . $id);
        }
    }

    /**
     * Supprimer une ville
     */
    public function supprimer($id)
    {
        $villeModel = new VilleModel();
        
        // Vérifier si la ville a des besoins
        if ($villeModel->hasBesoins($id)) {
            $_SESSION['error'] = "Impossible de supprimer : cette ville a des besoins associés";
            Flight::redirect('/villes/liste');
            return;
        }
        
        if ($villeModel->delete($id)) {
            $_SESSION['success'] = "Ville supprimée";
        } else {
            $_SESSION['error'] = "Erreur de suppression";
        }
        Flight::redirect('/villes/liste');
    }
}