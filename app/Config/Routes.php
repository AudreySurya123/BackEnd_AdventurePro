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

$routes->get('produk', 'ProdukController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'produk', 'ProdukController::create', ['filter' => 'cors']);
$routes->match(['put', 'options'], 'update/produk/(:segment)', 'ProdukController::update/$1');
$routes->match(['delete', 'options'], 'delete/produk/(:segment)', 'ProdukController::delete/$1');
$routes->get('image/(:segment)', 'ProdukController::getImage/$1');
$routes->get('produk/show/(:segment)', 'ProdukController::show/$1');

$routes->get('message', 'MsgController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'message', 'MsgController::create', ['filter' => 'cors']);
$routes->match(['put', 'options'], 'update/message/(:segment)', 'MsgController::update/$1');
$routes->match(['delete', 'options'], 'delete/message/(:segment)', 'MsgController::delete/$1');

$routes->get('sewa', 'SewaController::index', ['filter' => 'cors']);
$routes->match(['post', 'options'], 'sewa', 'SewaController::create', ['filter' => 'cors']);
$routes->match(['put', 'options'], 'update/sewa/(:segment)', 'SewaController::update/$1');
$routes->match(['delete', 'options'], 'delete/sewa/(:segment)', 'SewaController::delete/$1');