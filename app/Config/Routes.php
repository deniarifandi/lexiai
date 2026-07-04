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
