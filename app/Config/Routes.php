<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('/auth/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

$routes->group('products', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Products::index');
    $routes->get('create', 'Products::create');
    $routes->get('show/(:num)', 'Products::show/$1');
    $routes->post('store', 'Products::store');
    $routes->get('edit/(:num)', 'Products::edit/$1');
    $routes->post('update/(:num)', 'Products::update/$1');
    $routes->get('delete/(:num)', 'Products::delete/$1');
});


$routes->group('transactions', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Transactions::index');
    $routes->get('create', 'Transactions::create');
    $routes->post('store', 'Transactions::store');
    $routes->get('edit/(:num)', 'Transactions::edit/$1');
    $routes->post('update/(:num)', 'Transactions::update/$1');
    $routes->get('delete/(:num)', 'Transactions::delete/$1');
});


$routes->group('reports', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Reports::index');
    $routes->get('exportPdf', 'Reports::exportPdf');
});


$routes->group('categories', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Categories::index');
    $routes->get('create', 'Categories::create');
    $routes->post('store', 'Categories::store');
    $routes->get('edit/(:num)', 'Categories::edit/$1');
    $routes->post('update/(:num)', 'Categories::update/$1');
    $routes->get('delete/(:num)', 'Categories::delete/$1');
});

