<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login', ['as' => 'login']); // named route
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard', 'Admin\Dashboard::index');

$routes->group('formulir', function ($routes) {
    $routes->get('/', 'Admin\Formulir::index', ['as' => 'formulir.index']);
    $routes->get('create', 'Admin\Formulir::create', ['as' => 'formulir.create']);
    $routes->post('store', 'Admin\Formulir::store', ['as' => 'formulir.store']);
    $routes->get('edit/(:segment)', 'Admin\Formulir::edit/$1', ['as' => 'formulir.edit']);
    $routes->post('update/(:segment)', 'Admin\Formulir::update/$1', ['as' => 'formulir.update']);
    $routes->delete('delete/(:segment)', 'Admin\Formulir::delete/$1', ['as' => 'formulir.delete']);
    $routes->get('detail/(:segment)', 'Admin\Formulir::detail/$1', ['as' => 'formulir.detail']);
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
