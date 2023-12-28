<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('user', 'UserController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'user', 'UserController::SignUp', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'user/login', 'UserController::SignIn');
$routes->match(['put', 'options'], 'update/user/(:segment)', 'UserController::update/$1');
$routes->match(['delete', 'options'], 'delete/user/(:segment)', 'UserController::delete/$1');

$routes->get('admin', 'AdminController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'admin', 'AdminController::create', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'admin/login', 'AdminController::SignIn');
$routes->match(['put', 'options'], 'update/admin/(:segment)', 'AdminController::update/$1');
$routes->match(['delete', 'options'], 'delete/admin/(:segment)', 'AdminController::delete/$1');

$routes->get('produk-tas', 'ProdukTasController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'produk-tas', 'ProdukTasController::create', ['filter' => 'cors']);
$routes->match(['put', 'options'], 'update/produk-tas/(:segment)', 'ProdukTasController::update/$1');
$routes->match(['delete', 'options'], 'delete/produk-tas/(:segment)', 'ProdukTasController::delete/$1');
$routes->get('image/(:segment)', 'ProdukTasController::getImage/$1');

$routes->get('produk-sepatu', 'ProdukSepatuController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'produk-sepatu', 'ProdukSepatuController::create', ['filter' => 'cors']);
$routes->match(['put', 'options'], 'update/produk-sepatu/(:segment)', 'ProdukSepatuController::update/$1');
$routes->match(['delete', 'options'], 'delete/produk-sepatu/(:segment)', 'ProdukSepatuController::delete/$1');
$routes->get('image/(:segment)', 'ProdukSepatuController::getImage/$1');

$routes->get('produk-tenda', 'ProdukTendaController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'produk-tenda', 'ProdukTendaController::create', ['filter' => 'cors']);
$routes->match(['put', 'options'], 'update/produk-tenda/(:segment)', 'ProdukTendaController::update/$1');
$routes->match(['delete', 'options'], 'delete/produk-tenda/(:segment)', 'ProdukTendaController::delete/$1');
$routes->get('image/(:segment)', 'ProdukTendaController::getImage/$1');

$routes->get('produk-trackingpool', 'ProdukTrackingPoolController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'produk-trackingpool', 'ProdukTrackingPoolController::create', ['filter' => 'cors']);
$routes->match(['put', 'options'], 'update/produk-trackingpool/(:segment)', 'ProdukTrackingPoolController::update/$1');
$routes->match(['delete', 'options'], 'delete/produk-trackingpool/(:segment)', 'ProdukTrackingPoolController::delete/$1');
$routes->get('image/(:segment)', 'ProdukTrackingPoolController::getImage/$1');

$routes->get('message', 'MsgController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'message', 'MsgController::create', ['filter' => 'cors']);
$routes->match(['put', 'options'], 'update/message/(:segment)', 'MsgController::update/$1');
$routes->match(['delete', 'options'], 'delete/message/(:segment)', 'MsgController::delete/$1');

$routes->get('sewa', 'SewaController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'sewa', 'SewaController::create', ['filter' => 'cors']);
$routes->match(['put', 'options'], 'update/sewa/(:segment)', 'SewaController::update/$1');
$routes->match(['delete', 'options'], 'delete/sewa/(:segment)', 'SewaController::delete/$1');