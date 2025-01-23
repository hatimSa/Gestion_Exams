<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes principales
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/logout', 'LoginController::logout');

// Routes pour la connexion et l'inscription
$routes->get('/login', 'LoginController::index'); // Connexion
$routes->post('/login', 'LoginController::Login');
$routes->get('/forgot-password', 'LoginController::forgotPassword'); // Réinitialisation du mot de passe
$routes->get('/register', 'RegisterController::index');
$routes->get('getFilieresByDepartement/(:num)', 'RegisterController::getFilieresByDepartement/$1');
$routes->post('/register/store', 'RegisterController::store');

// Routes pour le tableau de bord
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/dashboard/logout', 'DashboardController::logout');

// Routes pour les utilisateurs
$routes->get('/usersAdd', 'UsersAddController::index');
$routes->get('usersAdd/getFilieresByDepartement/(:num)', 'UsersAddController::getFilieresByDepartement/$1');
$routes->post('/usersAdd/store', 'UsersAddController::store');
$routes->get('/usersAdd/logout', 'UsersAddController::logout');
$routes->get('/usersList', 'UsersListController::index');
$routes->get('/usersList/logout', 'UsersListController::logout');
$routes->get('comptes/edit/(:num)', 'UsersListController::edit/$1');
$routes->post('/comptes/update/(:num)', 'UsersListController::update/$1');
$routes->get('details/(:num)', 'UsersListController::details/$1');
$routes->get('/comptes/delete/(:num)', 'UsersListController::delete/$1');

// Routes spécifiques aux rôles
$routes->get('/etudDashboard', 'EtudController::index');
$routes->get('/etudDashboard/logout', 'EtudController::logout');
$routes->get('/profDashboard', 'ProfController::index');
$routes->get('/profDashboard/logout', 'ProfController::logout');

// Routes pour les réclamations
$routes->get('/reclamations', 'ReclamationsController::index');
$routes->get('/reclamations/logout', 'ReclamationsController::logout');
$routes->get('/etudReclamations', 'EtudReclamationsController::index'); // 'reclamations'
$routes->post('/etudReclamations/store', 'EtudReclamationsController::store');
$routes->post('etudReclamations/delete', 'EtudReclamationsController::delete');
$routes->get('reclamations/delete/(:num)', 'ReclamationsController::delete/$1');

// Routes pour les examens
$routes->get('/examsList', 'ExamsListController::index');
$routes->get('exams/edit/(:num)', 'ExamsListController::edit/$1');
$routes->post('exams/update/(:num)', 'ExamsListController::update/$1');
$routes->get('exams/delete/(:num)', 'ExamsListController::delete/$1');
$routes->get('/examsList/logout', 'ExamsListController::logout');
$routes->get('/examsAdd', 'ExamsAddController::index');
$routes->post('/examsAdd/store', 'ExamsAddController::store');
$routes->get('/examsAdd/logout', 'ExamsAddController::logout');

// Routes pour les résultats
$routes->get('/notesList', 'NotesListController::index');
$routes->get('exams/notesList/(:num)', 'ExamsListController::noter/$1');
$routes->get('notesList/(:num)', 'NotesListController::notesList/$1');
$routes->post('notesList/(:num)/store', 'NotesListController::store/$1');
$routes->get('notesFinal', 'NotesFinalController::index'); // Sans $exam_id
$routes->get('notesFinal/(:num)', 'NotesFinalController::index/$1'); // Avec $exam_id


// Routes pour le profil
$routes->get('/profil', 'ProfilController::index');
$routes->get('/profil/logout', 'ProfilController::logout');

// Routes pour les tests
$routes->get('/test-db', 'TestDBController::index');

// Route pour la gestion des examens (utilisez celle-ci)
$routes->get('/manage-exams', 'ManageExams::index');
//routes pour gestion notes
$routes->get('/student-results', 'resultController::index');

// Routes pour l'étudiant
$routes->get('/exams', 'ExamController::index');


$routes->get('/studentResults', 'resultController::index');
$routes->get('/listeResult', 'listeResultController::index');