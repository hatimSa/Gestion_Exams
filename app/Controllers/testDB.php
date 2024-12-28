<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Config;

class TestController extends Controller
{
    public function index()
    {
        $db = Config::connect(); // Se connecte à la base de données
        if ($db->connID) {
            echo "Connexion réussie !";
        } else {
            echo "Échec de la connexion.";
        }
    }
}