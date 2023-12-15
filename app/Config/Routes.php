<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('user', 'UserController::index', ['filter' => 'cors']);
$routes->match(['post','options'],'user', 'UserController::SignUp', ['filter' => 'cors']);
$routes->match(['put', 'options'], 'update/user/(:segment)', 'UserController::update/$1');
$routes->match(['delete', 'options'], 'delete/user/(:segment)', 'UserController::delete/$1');