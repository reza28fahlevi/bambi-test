<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'GraphController::index');
$routes->get('/theGraph/(:any)', 'GraphController::getGraph/$1');
$routes->group('transactions', static function ($routes) {
    $routes->get('/', 'TransactionController::index');
    $routes->post('fetch', 'TransactionController::fetch');
    $routes->post('add', 'TransactionController::add');
    $routes->get('get', 'TransactionController::getData');
});
$routes->group('ipo', static function ($routes) {
    $routes->get('/', 'SahamController::index');
    $routes->post('fetch', 'SahamController::fetch');
    $routes->post('add', 'SahamController::add');
    $routes->get('getData/(:any)', 'SahamController::getData/$1');
    $routes->post('update', 'SahamController::update');
    $routes->post('delete', 'SahamController::delete');
});