<?php

namespace app\controllers;

use app\models\BesoinModel;
use app\models\VilleModel;
use Flight;

class BesoinController
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = Flight::get('flight.base_url') ?: '';
    }

    /**
     * Afficher le formulaire d'ajout d'un besoin
     */
    public function ajouter()
    {
        // Récupérer la liste des villes pour le select
        $villeModel = new VilleModel();
        $villes = $villeModel->getAll();

        Flight::render('besoins/ajouter', [
            'title' => 'Ajouter un besoin - BNGRC',
            'villes' => $villes
        ]);
    }

    /**
     * Traiter le formulaire d'ajout
     */
    public function save()
    {
        $data = $_POST;

        // Validation simple
        if (empty($data['ville_id']) || empty($data['type']) || empty($data['libelle']) || empty($data['quantite']) || empty($data['prix_unitaire'])) {
            $_SESSION['error'] = "Tous les champs sont obligatoires";
            Flight::redirect('/besoins/ajouter');
            return;
        }

        $besoinModel = new BesoinModel();

        if ($besoinModel->create($data)) {
            $_SESSION['success'] = "Besoin ajouté avec succès";
            Flight::redirect('/besoins/liste');
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout";
            Flight::redirect('/besoins/ajouter');
        }
    }

    /**
     * Afficher la liste des besoins
     */
    public function liste()
    {
        $besoinModel = new BesoinModel();
        $besoins = $besoinModel->getAllWithVille(); // Avec jointure pour avoir le nom de la ville

        Flight::render('besoins/liste', [
            'title' => 'Liste des besoins - BNGRC',
            'besoins' => $besoins
        ]);
    }

    /**
     * Afficher le formulaire de modification
     */
    public function modifier($id)
    {
        $besoinModel = new BesoinModel();
        $besoin = $besoinModel->getById($id);

        if (!$besoin) {
            $_SESSION['error'] = "Besoin non trouvé";
            Flight::redirect('/besoins/liste');
            return;
        }

        $villeModel = new VilleModel();
        $villes = $villeModel->getAll();

        Flight::render('besoins/modifier', [
            'title' => 'Modifier un besoin - BNGRC',
            'besoin' => $besoin,
            'villes' => $villes
        ]);
    }

    /**
     * Traiter la modification
     */
    public function update($id)
    {
        $data = $_POST;

        // Validation simple
        if (empty($data['ville_id']) || empty($data['type']) || empty($data['libelle']) || empty($data['quantite']) || empty($data['prix_unitaire'])) {
            $_SESSION['error'] = "Tous les champs sont obligatoires";
            Flight::redirect('/besoins/modifier/' . $id);
            return;
        }

        $besoinModel = new BesoinModel();

        if ($besoinModel->update($id, $data)) {
            $_SESSION['success'] = "Besoin modifié avec succès";
            Flight::redirect('/besoins/liste');
        } else {
            $_SESSION['error'] = "Erreur lors de la modification";
            Flight::redirect('/besoins/modifier/' . $id);
        }
    }

    /**
     * Supprimer un besoin
     */
    public function supprimer($id)
    {
        $besoinModel = new BesoinModel();

        if ($besoinModel->delete($id)) {
            $_SESSION['success'] = "Besoin supprimé";
        } else {
            $_SESSION['error'] = "Erreur de suppression";
        }
        Flight::redirect('/besoins/liste');
    }
}
