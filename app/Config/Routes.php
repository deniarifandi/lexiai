<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/reading-dashboard', 'Home::readingDashboard');
$routes->get('/reading-test', 'Home::readingTest');
$routes->get('/reading-feedback', 'Home::readingFeedback');
