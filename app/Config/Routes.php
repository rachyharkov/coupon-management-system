<?php

namespace Config;

use App\Controllers\Admin\Formulir;

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
    $routes->get('/', [Formulir::class, 'index'], ['as' => 'formulir.index']); // named route
    $routes->get('create', [Formulir::class, 'create'], ['as' => 'formulir.create']); // named route
    $routes->post('store', [Formulir::class, 'store'], ['as' => 'formulir.store']); // named route
    $routes->addPlaceholder('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
    $routes->get('edit/(:uuid)', [Formulir::class, 'edit/$1'], ['as' => 'formulir.edit']); // named route
    $routes->post('update', [Formulir::class, 'update'], ['as' => 'formulir.update']); // named route
    $routes->delete('delete/(:uuid)', [Formulir::class, 'delete/$1'], ['as' => 'formulir.delete']); // named route
    $routes->get('detail/(:uuid)', [Formulir::class, 'detail/$1'], ['as' => 'formulir.detail']); // named route
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
