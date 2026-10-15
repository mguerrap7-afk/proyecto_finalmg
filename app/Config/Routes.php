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
$routes->group('tasks', ['filter' => 'auth'], static function ($routes) {
$routes->get('/', 'Tasks::index');
$routes->get('new', 'Tasks::new');
$routes->post('create', 'Tasks::create');
$routes->get('(:num)', 'Tasks::show/$1');
$routes->get('(:num)/edit', 'Tasks::edit/$1');
$routes->post('(:num)/update', 'Tasks::update/$1');
$routes->post('(:num)/delete', 'Tasks::delete/$1');
});
$routes->group('profile', ['filter' => 'auth'], static function ($routes) {
$routes->get('/', 'Profile::index');
$routes->get('confirm', 'Profile::confirm');
$routes->post('confirm', 'Profile::checkConfirm');
$routes->get('edit', 'Profile::edit');
$routes->post('update', 'Profile::update');
$routes->get('password', 'Profile::password');
$routes->post('password', 'Profile::updatePassword');
$routes->get('image', 'Profile::image');
$routes->post('image', 'Profile::saveImage');
$routes->get('image/delete', 'Profile::deleteImageConfirm');
$routes->post('image/delete', 'Profile::deleteImage');
});
$routes->group('users', ['filter' => 'admin'], static function ($routes) {
$routes->get('/', 'Users::index');
$routes->get('new', 'Users::new');
$routes->post('create', 'Users::create');
$routes->get('(:num)', 'Users::show/$1');
$routes->get('(:num)/edit', 'Users::edit/$1');
$routes->post('(:num)/update', 'Users::update/$1');
$routes->post('(:num)/delete', 'Users::delete/$1');
});

