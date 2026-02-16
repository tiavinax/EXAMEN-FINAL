<?php

namespace app\controllers;

use flight\Engine;
use app\models\DonModel;
use Flight;


class DonController
{

    private $donModel;
    private $app;

    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = Flight::get('flight.base_url') ?: '';
    }

    /**
     * Afficher le formulaire d'ajout
     */
    public function ajouter()
    {
        // Générer un nonce unique
        $nonce = base64_encode(random_bytes(16));

        // Stocker le nonce dans l'application pour le middleware
        Flight::set('csp_nonce', $nonce);

        Flight::render('dons/ajouter', [
            'title' => 'Ajouter un don - BNGRC',
            'nonce' => $nonce // Passer à la vue aussi
        ]);
    }

    /**
     * Traiter le formulaire d'ajout
     */
    public function save()
    {
        $data = $_POST;

        // Validation simple
        if (empty($data['type']) || empty($data['libelle']) || empty($data['valeur'])) {
            $_SESSION['error'] = "Tous les champs sont obligatoires";
            Flight::redirect('/dons/ajouter');
            return;
        }

        // Ajouter la date si non fournie
        if (empty($data['date_don'])) {
            $data['date_don'] = date('Y-m-d H:i:s');
        }

        $donModel = new DonModel();

        if ($donModel->create($data)) {
            $_SESSION['success'] = "Don ajouté avec succès";
            Flight::redirect('/dons/liste');
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout";
            Flight::redirect('/dons/ajouter');
        }
    }

    /**
     * Afficher la liste des dons
     */
    public function liste()
    {
        // Générer un nonce pour la liste aussi
        $nonce = base64_encode(random_bytes(16));
        Flight::set('csp_nonce', $nonce);

        $donModel = new DonModel();
        $dons = $donModel->getAll();

        Flight::render('dons/liste', [
            'title' => 'Liste des dons - BNGRC',
            'dons' => $dons,
            'nonce' => $nonce
        ]);
    }


    /**
     * Supprimer un don
     */
    public function supprimer($id)
    {
        if ($this->donModel->delete($id)) {
            $_SESSION['success'] = "Don supprimé";
        } else {
            $_SESSION['error'] = "Erreur de suppression";
        }
        Flight::redirect('/dons/liste');
    }
}
