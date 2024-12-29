<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/test-db', 'TestDBController::index');
$routes->get('/register', 'RegisterController::index');
$routes->post('/register', 'RegisterController::attemptRegister');
$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::attemptLogin');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/logout', 'LoginController::logout');
