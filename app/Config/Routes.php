<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/test-db', 'TestDBController::index');
$routes->get('register', 'RegisterController::index');   // Afficher le formulaire d'inscription
$routes->post('register/store', 'RegisterController::store'); // Traiter l'inscription
$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::Login');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/logout', 'LoginController::logout');
$routes->get('DatabaseTest', 'DatabaseTest::index');