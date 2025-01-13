<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/test-db', 'TestDBController::index');
$routes->get('/register', 'RegisterController::index');
$routes->post('/register/store', 'RegisterController::store');
$routes->get('/login', 'LoginController::index'); // Connexion
$routes->get('/forgot-password', 'LoginController::forgotPassword'); // Réinitialisation du mot de passe
$routes->post('/login', 'LoginController::Login');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/dashboard', 'DashboardController::logout');
$routes->get('/usersAdd', 'UsersAddController::index');
$routes->post('/usersAdd/store', 'UsersAddController::store');
$routes->get('/etudDashboard', 'EtudController::index');
$routes->get('/etudDashboard', 'EtudController::logout');
$routes->get('/profDashboard', 'ProfController::index');
$routes->get('/profDashboard', 'ProfController::logout');
$routes->get('/profil', 'ProfilController::index');
$routes->get('/usersList', 'UsersListController::index');
$routes->get('comptes/edit/(:num)', 'UsersListController::edit/$1');
$routes->post('/comptes/update/(:num)', 'UsersListController::update/$1');
$routes->get('details/(:num)', 'UsersListController::details/$1');
$routes->get('/comptes/delete/(:num)', 'UsersListController::delete/$1');
$routes->get('/reclamations', 'ReclamationsController::index');
$routes->get('/logout', 'LoginController::logout');
