<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/test-db', 'TestDB::index');
$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::attemptLogin');
$routes->get('/logout', 'LoginController::logout');
