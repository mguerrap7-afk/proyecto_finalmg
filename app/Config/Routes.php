<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('lang/(:segment)', 'Language::set/$1');
$routes->get('signup', 'Auth::signup');
$routes->post('signup', 'Auth::register');
$routes->get('activate/(:segment)', 'Auth::activate/$1');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->post('logout', 'Auth::logout');

