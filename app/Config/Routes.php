<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->add('/', 'login\Login::index');
// Login Auth
$routes->add('login', 'login\Login::index');
$routes->add('login/auth', 'login\Login::auth');
$routes->add('logout', 'login\Login::logout');
// Static create user login
// $routes->add('user/add', 'login\Login::usera');

// Index Home
$routes->add('prod', 'master\Produksi::index', ['filter' => 'auth']);
$routes->add('product', 'master\Product::index', ['filter' => 'auth']);
$routes->add('history', 'master\History::index', ['filter' => 'auth']);

// Datatables
$routes->add('prod/table', 'master\Produksi::datatable');
$routes->add('product/datatabel', 'master\Product::datatables');

// Produksi
$routes->add('prod/type', 'master\Produksi::types');
$routes->add('prod/load', 'master\Produksi::load');
$routes->add('prod/compare', 'master\Produksi::compare');
$routes->add('prod/data', 'master\Produksi::process');
$routes->add('prod/addser', 'master\Produksi::serialAdd');
$routes->add('prod/edit', 'master\Produksi::forms');
$routes->add('prod/result', 'master\Produksi::saveRes');
$routes->add('prod/getSel', 'master\Produksi::getSel');
$routes->add('prod/prev', 'master\Produksi::getProduct');
$routes->add('prod/upex', 'master\Produksi::Upex');


// Product
$routes->add('product/form', 'master\Product::formViews');
$routes->add('product/add', 'master\Product::process');
$routes->add('product/single', 'master\Product::getOne');
$routes->add('product/exp/(:num)', 'master\Product::exPDF/$1');
$routes->add('product/delete', 'master\Product::delete');

// History
$routes->add('history/datatabel', 'master\History::datatables');
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
