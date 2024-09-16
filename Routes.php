<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->match(['get','post'],'imageupload', 'ImageController::UploadImage');
$routes->get('delete/(:any)','ImageController::deletefileData/$1');


