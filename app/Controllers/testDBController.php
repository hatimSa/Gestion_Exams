<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class TestDBController extends Controller
{
    public function index()
    {
        try {
            // Essayer de se connecter à la base de données
            $db = Database::connect();
            echo 'Connexion réussie à la base de données !';
        } catch (\Exception $e) {
            // Si une erreur se produit, afficher l'erreur
            echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
        }
    }
}