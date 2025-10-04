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




// // Students (only admins can access this)
// $routes->get('/students', 'Students::index', ['filter' => 'authguard:admin']);
// $routes->get('/students/view/(:num)', 'Students::view/$1', ['filter' => 'authguard']);

// // Protected routes
// $routes->group('', ['filter' => 'authguard'], static function ($routes) {
//     // Home
//     $routes->get('/home', 'Home::index');

//     // Courses
//     $routes->get('/courses', 'Courses::index');
//     $routes->get('/courses/create', 'Courses::create', ['filter' => 'authguard:admin']);
//     $routes->post('/courses/store', 'Courses::store', ['filter' => 'authguard:admin']);
//     $routes->get('/courses/edit/(:num)', 'Courses::edit/$1', ['filter' => 'authguard:admin']);
//     $routes->post('/courses/update/(:num)', 'Courses::update/$1', ['filter' => 'authguard:admin']);
//     $routes->get('/courses/delete/(:num)', 'Courses::delete/$1', ['filter' => 'authguard:admin']);

//     // Enrollment (student only)
//     $routes->get('/enroll/(:num)', 'Enrollment::enroll/$1', ['filter' => 'authguard:student']);
//     $routes->get('/my-courses', 'Enrollment::myCourses', ['filter' => 'authguard:student']);

//     // Takes (admin only → delete enrollment)
//     $routes->group('takes', ['filter' => 'authguard:admin'], function ($routes) {
//         $routes->post('update/(:num)', 'Takes::update/$1');
//         $routes->get('delete/(:num)', 'Takes::delete/$1');
//     });
// });

// // Submit Enrollment
// $routes->get('/enroll', 'Enrollment::selectCourses');
// $routes->post('/enroll/submit', 'Enrollment::submit');


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
        $routes->get('delete/(:num)', 'BahanBaku::delete/$1');
    });

    // Dapur (Client only)
    $routes->group('permintaan', ['filter' => 'authguard:dapur'], function ($routes) {
        $routes->get('/', 'Permintaan::myRequests');
        $routes->get('create', 'Permintaan::create');
        $routes->post('store', 'Permintaan::store');
        $routes->get('view/(:num)', 'Permintaan::view/$1');
    });

    // Gudang processes permintaan
    $routes->group('permintaan-admin', ['filter' => 'authguard:gudang'], function ($routes) {
        $routes->get('/', 'Permintaan::index');
        $routes->get('approve/(:num)', 'Permintaan::approve/$1');
        $routes->get('reject/(:num)', 'Permintaan::reject/$1');
    });
});

