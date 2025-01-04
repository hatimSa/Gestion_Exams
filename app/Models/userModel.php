<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Nom de la table
    protected $primaryKey = 'user_id'; // Clé primaire
    protected $allowedFields = ['email', 'password', 'compte_id']; // Champs autorisés pour les opérations
    protected $useTimestamps = false; // Pas besoin de timestamps

    /**
     * Récupérer un utilisateur par email.
     *
     * @param string $email
     * @return array|null
     */
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first(); // Utilisation de Active Record
    }

    /**
     * Insérer un utilisateur avec un mot de passe sécurisé.
     *
     * @param array $data
     * @return int|false
     */
    public function insertUser($data)
    {
        if (isset($data['password'])) {
            // Utiliser la même méthode de hachage pour garantir la consistance
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT); // Hachage du mot de passe
        }

        return $this->insert($data); // Insérer l'utilisateur
    }

    /**
     * Récupérer tous les utilisateurs.
     *
     * @return array
     */
    public function getAllUsers()
    {
        return $this->findAll(); // Récupère tous les enregistrements de la table
    }
}