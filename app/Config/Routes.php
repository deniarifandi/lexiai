<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/','Home::index');

// $routes->get('/dashboard', 'Home::index');

$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::store');

$routes->get('/login', 'Home::login');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/reading-dashboard', 'Home::readingDashboard');
$routes->get('/reading-test', 'Home::readingTest');
$routes->get('/reading-feedback', 'Home::readingFeedback');


// -------------------------------------------
// admin
// -------------------------------

$routes->group('admin', ['filter' => 'admin'], function($routes){

    $routes->get('dashboard', 'AdminController::index');

    $routes->get('users', 'AdminController::users');

    $routes->get('modules', 'AdminController::modules');

});

// ------users

$routes->group('admin', function($routes){

    $routes->get('/', 'AdminController::index');

    $routes->get('users', 'AdminController::users');

    $routes->get('users/create', 'AdminController::createUser');
    $routes->post('users/store', 'AdminController::storeUser');

    $routes->get('users/edit/(:num)', 'AdminController::editUser/$1');
    $routes->post('users/update/(:num)', 'AdminController::updateUser/$1');

    $routes->get('users/delete/(:num)', 'AdminController::deleteUser/$1');


});

// ------------------------------------------------
// Reading Materials
// ------------------------------------------------

$routes->group('admin', function($routes){
	$routes->get('reading-materials', 'ReadingMaterials::index');
	$routes->get('reading-materials/create', 'ReadingMaterials::create');
	$routes->post('reading-materials/store', 'ReadingMaterials::store');
	$routes->get('reading-materials/edit/(:num)', 'ReadingMaterials::edit/$1');
	$routes->post('reading-materials/update/(:num)', 'ReadingMaterials::update/$1');
	$routes->get('reading-materials/delete/(:num)', 'ReadingMaterials::delete/$1');
	$routes->get('reading-materials/questions/(:num)', 'ReadingQuestions::index/$1');
});

// ------------------------------------------------
// Reading Questions 
// ------------------------------------------------

$routes->group('admin', function($routes){
	$routes->get('reading-materials/questions/(:num)', 'ReadingQuestions::index/$1');
	$routes->get('reading-questions/create/(:num)', 'ReadingQuestions::create/$1');
	$routes->post('reading-questions/store', 'ReadingQuestions::store');
	$routes->get('reading-questions/edit/(:num)', 'ReadingQuestions::edit/$1');
	$routes->post('reading-questions/update/(:num)', 'ReadingQuestions::update/$1');
	$routes->get('reading-questions/delete/(:num)', 'ReadingQuestions::delete/$1');
});



// -------------------------------------------------------
// Studentt
// _----------------------------------------

$routes->group('student', function ($routes) {

    $routes->get('reading', 'Student\Reading::index');

    $routes->get('reading/(:num)', 'Student\Reading::show/$1');
    $routes->get('reading/test/(:num)', 'Student\Reading::test/$1');
    $routes->post('reading/submit/(:num)', 'Student\Reading::submit/$1');
    $routes->get('reading/result/(:num)', 'Student\Reading::result/$1');
    $routes->post('reading/save-answer', 'Student\Reading::saveAnswer');
	$routes->get('reading/feedback/(:num)','Student\Reading::feedback/$1');
	
$routes->post('reading/chat', 'Student\Reading::chat');
});

$routes->get('student/reading/start/(:num)', 'Student\Reading::start/$1');
