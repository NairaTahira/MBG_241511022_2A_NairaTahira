<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route, automatically goes to login page
$routes->get('/', 'Auth::login');

// Authentication
$routes->get('/login', 'Auth::login');
$routes->post('/auth/checkLogin', 'Auth::checkLogin');
$routes->get('/register', 'Auth::register');
$routes->post('/auth/storeRegister', 'Auth::storeRegister');
$routes->get('/logout', 'Auth::logout');

// ======================================================================
// Protected routes (all logged-in users)
$routes->group('', ['filter' => 'authguard'], static function ($routes) {
    $routes->get('/home', 'Home::index');

    // Gudang (Admin only)
    $routes->group('bahanbaku', ['filter' => 'authguard:gudang'], function ($routes) {
        $routes->get('/', 'BahanBaku::index');
        $routes->get('create', 'BahanBaku::create');
        $routes->post('store', 'BahanBaku::store');
        $routes->get('edit/(:num)', 'BahanBaku::edit/$1');
        $routes->post('update/(:num)', 'BahanBaku::update/$1');
        $routes->get('confirm-delete/(:num)', 'BahanBaku::confirmDelete/$1');
        $routes->get('delete/(:num)', 'BahanBaku::delete/$1');
    });

    // Dapur (Client only)
    $routes->group('permintaan', ['filter' => 'authguard:dapur'], function ($routes) {
        $routes->get('/', 'Permintaan::index');
        $routes->get('create', 'Permintaan::create');
        $routes->post('store', 'Permintaan::store');
        $routes->get('view/(:num)', 'Permintaan::view/$1');
    });

    // Gudang processes permintaan
    $routes->group('permintaan-admin', ['filter' => 'authguard:gudang'], function ($routes) {
        $routes->get('admin_index', 'Permintaan::adminIndex');
        $routes->post('approve/(:num)', 'Permintaan::approve/$1');
        $routes->post('reject/(:num)', 'Permintaan::reject/$1');
    });
});

