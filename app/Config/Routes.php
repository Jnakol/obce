<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/(:num)', 'Main::index/$1');
$routes->get('/okres/(:num)/str/(:num)', 'Main::okres/$1/$2');

