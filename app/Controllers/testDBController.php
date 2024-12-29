<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Exceptions\DatabaseException;

class TestDBController extends Controller
{
    public function testConnection()
    {
        try {
            $db = \Config\Database::connect();
            if ($db->connID) {
                echo "Connexion réussie à la base de données.";
            }
        } catch (DatabaseException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }
}