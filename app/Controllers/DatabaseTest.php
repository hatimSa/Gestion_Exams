<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class DatabaseTest extends Controller
{
    public function index()
    {
        try {
            $db = Database::connect();
            if ($db->connect()) {
                echo "Connexion réussie à la base de données.";
            } else {
                echo "Échec de la connexion à la base de données.";
            }
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
