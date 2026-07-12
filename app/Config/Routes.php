<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// =====================================================
// PUBLIC
// =====================================================

$routes->get('/', 'Home::index');

$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::store');

$routes->get('dashboard', 'Home::dashboard');


// =====================================================
// ADMIN
// =====================================================

$routes->group('admin', ['filter' => 'admin'], function ($routes) {

    // Dashboard
    $routes->get('/', 'AdminController::index');
    $routes->get('dashboard', 'AdminController::index');

    // =====================================================
    // USERS
    // =====================================================

    $routes->get('users', 'AdminController::users');
    $routes->get('modules', 'AdminController::modules');
    $routes->get('users/create', 'AdminController::createUser');
    $routes->post('users/store', 'AdminController::storeUser');

    $routes->get('users/edit/(:num)', 'AdminController::editUser/$1');
    $routes->post('users/update/(:num)', 'AdminController::updateUser/$1');

    $routes->get('users/delete/(:num)', 'AdminController::deleteUser/$1');


    // =====================================================
    // READING MATERIALS
    // =====================================================

    $routes->get('reading-materials', 'ReadingMaterials::index');

    $routes->get('reading-materials/create', 'ReadingMaterials::create');
    $routes->post('reading-materials/store', 'ReadingMaterials::store');

    $routes->get('reading-materials/edit/(:num)', 'ReadingMaterials::edit/$1');
    $routes->post('reading-materials/update/(:num)', 'ReadingMaterials::update/$1');

    $routes->get('reading-materials/delete/(:num)', 'ReadingMaterials::delete/$1');

    $routes->get('reading-materials/questions/(:num)', 'ReadingQuestions::index/$1');


    // =====================================================
    // READING QUESTIONS
    // =====================================================

    $routes->get('reading-questions/create/(:num)', 'ReadingQuestions::create/$1');
    $routes->post('reading-questions/store', 'ReadingQuestions::store');

    $routes->get('reading-questions/edit/(:num)', 'ReadingQuestions::edit/$1');
    $routes->post('reading-questions/update/(:num)', 'ReadingQuestions::update/$1');

    $routes->get('reading-questions/delete/(:num)', 'ReadingQuestions::delete/$1');


    // =====================================================
    // VOCABULARY CATEGORIES
    // =====================================================

    $routes->get('vocabulary-categories', 'VocabularyCategories::index');

    $routes->get('vocabulary-categories/create', 'VocabularyCategories::create');
    $routes->post('vocabulary-categories/store', 'VocabularyCategories::store');

    $routes->get('vocabulary-categories/edit/(:num)', 'VocabularyCategories::edit/$1');
    $routes->post('vocabulary-categories/update/(:num)', 'VocabularyCategories::update/$1');

    $routes->get('vocabulary-categories/delete/(:num)', 'VocabularyCategories::delete/$1');


    // =====================================================
    // VOCABULARIES
    // =====================================================

    $routes->get('vocabularies', 'Vocabularies::index');

    $routes->get('vocabularies/create', 'Vocabularies::create');
    $routes->post('vocabularies/store', 'Vocabularies::store');

    $routes->get('vocabularies/edit/(:num)', 'Vocabularies::edit/$1');
    $routes->post('vocabularies/update/(:num)', 'Vocabularies::update/$1');

    $routes->get('vocabularies/delete/(:num)', 'Vocabularies::delete/$1');

    $routes->get('vocabularies/examples/(:num)', 'VocabularyExamples::index/$1');
    $routes->get('vocabularies/exercises/(:num)', 'VocabularyExercises::index/$1');


    // =====================================================
    // VOCABULARY EXAMPLES
    // =====================================================

    $routes->get('vocabulary-examples/create/(:num)', 'VocabularyExamples::create/$1');
    $routes->post('vocabulary-examples/store', 'VocabularyExamples::store');

    $routes->get('vocabulary-examples/edit/(:num)', 'VocabularyExamples::edit/$1');
    $routes->post('vocabulary-examples/update/(:num)', 'VocabularyExamples::update/$1');

    $routes->get('vocabulary-examples/delete/(:num)', 'VocabularyExamples::delete/$1');


    // =====================================================
    // VOCABULARY EXERCISES
    // =====================================================

    $routes->get('vocabulary-exercises/create/(:num)', 'VocabularyExercises::create/$1');
    $routes->post('vocabulary-exercises/store', 'VocabularyExercises::store');

    $routes->get('vocabulary-exercises/edit/(:num)', 'VocabularyExercises::edit/$1');
    $routes->post('vocabulary-exercises/update/(:num)', 'VocabularyExercises::update/$1');

    $routes->get('vocabulary-exercises/delete/(:num)', 'VocabularyExercises::delete/$1');


    // =====================================================
    // PRONUNCIATION
    // =====================================================
    // Tambahkan route Pronunciation di sini nanti.
});


// =====================================================
// STUDENT
// =====================================================

$routes->group('student', function ($routes) {

    // =====================================================
    // READING
    // =====================================================

    $routes->get('reading', 'Student\Reading::index');

    $routes->get('reading/start/(:num)', 'Student\Reading::start/$1');

    $routes->get('reading/(:num)', 'Student\Reading::show/$1');

    $routes->get('reading/test/(:num)', 'Student\Reading::test/$1');

    $routes->post('reading/submit/(:num)', 'Student\Reading::submit/$1');

    $routes->post('reading/save-answer', 'Student\Reading::saveAnswer');

    $routes->get('reading/result/(:num)', 'Student\Reading::result/$1');

    $routes->get('reading/feedback/(:num)', 'Student\Reading::feedback/$1');

    $routes->post('reading/chat', 'Student\Reading::chat');


    // =====================================================
    // VOCABULARY
    // =====================================================

    $routes->get('vocabulary', 'Student\Vocabulary::index');

    $routes->get('vocabulary/(:num)', 'Student\Vocabulary::show/$1');

    $routes->get('vocabulary/exercise/(:num)', 'Student\Vocabulary::exercise/$1');

    $routes->post('vocabulary/submit/(:num)', 'Student\Vocabulary::submit/$1');

    $routes->get('vocabulary/result/(:num)', 'Student\Vocabulary::result/$1');

    $routes->get('vocabulary/feedback/(:num)', 'Student\Vocabulary::feedback/$1');

    $routes->post('vocabulary/chat', 'Student\Vocabulary::chat');


    // =====================================================
    // PRONUNCIATION
    // =====================================================

    $routes->get('pronunciation', 'Student\Pronunciation::index');

    $routes->get('pronunciation/(:num)', 'Student\Pronunciation::show/$1');

    $routes->post('pronunciation/submit/(:num)', 'Student\Pronunciation::submit/$1');

    $routes->get('pronunciation/result/(:num)', 'Student\Pronunciation::result/$1');

    $routes->post('pronunciation/chat', 'Student\Pronunciation::chat');
});

$routes->group('student', function ($routes) {

    $routes->get('vocabulary', 'Student\Vocabulary::index');

    $routes->get('vocabulary/start/(:num)', 'Student\Vocabulary::start/$1');

    $routes->get('vocabulary/test/(:num)', 'Student\Vocabulary::test/$1');

    $routes->post('vocabulary/save-answer', 'Student\Vocabulary::saveAnswer');

    $routes->get(
    'vocabulary/feedback/(:num)',
    'Student\Vocabulary::feedback/$1'
);

    $routes->post(
        'student/vocabulary/chat',
        'Student\Vocabulary::chat'
    );
});


// ------------------------------------------------
// Student - Pronunciation
// ------------------------------------------------

$routes->group('student', function ($routes) {

    $routes->get('pronunciation', 'Student\Pronunciation::index');

    $routes->get('pronunciation/start/(:num)', 'Student\Pronunciation::start/$1');

    $routes->get('pronunciation/test/(:num)', 'Student\Pronunciation::test/$1');

    $routes->post('pronunciation/save-answer', 'Student\Pronunciation::saveAnswer');

    $routes->get('pronunciation/feedback/(:num)', 'Student\Pronunciation::feedback/$1');

    $routes->post('pronunciation/chat', 'Student\Pronunciation::chat');

});