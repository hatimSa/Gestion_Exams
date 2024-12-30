<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/test-db', 'TestDBController::index');
<<<<<<< HEAD
$routes->get('/register', 'RegisterController::index');
$routes->post('/register/store', 'RegisterController::store');
$routes->get('/login', 'LoginController::index'); // Connexion
$routes->get('/forgot-password', 'LoginController::forgotPassword'); // Réinitialisation du mot de passe
$routes->post('/login', 'LoginController::Login');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/profil', 'ProfilController::index');
$routes->get('/usersList', 'UsersListController::index');
$routes->get('/logout', 'LoginController::logout');
=======
$routes->get('register', 'RegisterController::index');   // Afficher le formulaire d'inscription
$routes->post('register/store', 'RegisterController::store'); // Traiter l'inscription
$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::Login');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/logout', 'LoginController::logout');
$routes->get('DatabaseTest', 'DatabaseTest::index');
>>>>>>> 363dca957c628133bcac990c7a19dd1ac0e9475a
