<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->setAutoRoute(true);
$routes->get('/', 'demo::index');
// $routes->get('/', 'UsersController::index');
//  $routes->post('users/getUsers', 'UsersController::getUsers');
$routes->post('demo/ajax', 'demo::ajax');

$routes->post('demo/Weight', 'demo::Weight');


$routes->get('demo/GetCity', 'demo::GetCity');

$routes->get('demo/GetFinal', 'demo::GetFinal');



$routes->get('demo/display', 'demo::display');
$routes->post('demo/import', 'demo::import');