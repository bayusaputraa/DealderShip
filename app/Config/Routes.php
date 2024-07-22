<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'BerandaController::index');
//$routes->get('/', 'Admin\DashboardController::index');

//route admin
$routes->get('dashboard','Admin\DashboardController::index');

//route product
$routes->get('daftar-produk', 'Admin\ProdukController::index');

$routes->get('daftar-produk/tambah', 'Admin\ProdukController::form_create');

$routes->get('daftar-produk/ubah/(:num)', 'Admin\ProdukController::form_update/$1');

$routes->post('daftar-produk/create-produk', 'Admin\ProdukController::create_produk');

$routes->put('daftar-produk/update-produk/(:num)', 'Admin\ProdukController::update_produk/$1');

$routes->delete('daftar-produk/delete-produk/', 'Admin\ProdukController::delete_produk');

$routes->get('daftar-produk/detail-produk/(:num)', 'Admin\ProdukController::detail_produk/$1');


//$routes->post('daftar-produk/create-produk/ubah/(:num)', 'Admin\ProdukController::create_produk');


//admin Kategori

$routes->get('daftar-kategori', 'Admin\ProdukController::kategori');

$routes->post('daftar-kategori/tambah', 'Admin\ProdukController::store');

$routes->put('daftar-kategori/ubah/(:num)', 'Admin\ProdukController::update/$1');

$routes->delete('daftar-kategori/hapus/(:num)', 'Admin\ProdukController::destroy/$1');
