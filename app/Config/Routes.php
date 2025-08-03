<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public Routes (No Authentication Required)
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
$routes->get('/search', 'Home::search');

// Divisi Routes (Public)
$routes->get('/divisi', 'Divisi::index');
$routes->get('/divisi/(:segment)', 'Divisi::show/$1');

// Kegiatan Routes (Public)
$routes->get('/kegiatan', 'Kegiatan::index');
$routes->get('/kegiatan/(:segment)', 'Kegiatan::show/$1');

// Kode Etik Routes (Public)
$routes->get('/kode-etik', 'KodeEtik::index');
$routes->get('/kode-etik/(:segment)', 'KodeEtik::show/$1');

// Video Angkatan Routes (Member Only)
$routes->group('video-angkatan', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'VideoAngkatan::index');
    $routes->get('/(:segment)', 'VideoAngkatan::show/$1');
});

// Daftar MAPALA Routes (Public)
$routes->get('/daftar', 'Daftar::index');
$routes->post('/daftar', 'Daftar::store');
$routes->get('/daftar/success', 'Daftar::success');
$routes->get('/daftar/formulir', 'Daftar::formulir');
$routes->get('/daftar/idcard', 'Daftar::idcard');
$routes->get('/daftar/formulir/pdf', 'Daftar::formulirPdf');
$routes->get('/daftar/idcard/pdf', 'Daftar::idcardPdf');

// Auth Routes (Admin Only)
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::authenticate');
$routes->get('/logout', 'Auth::logout');

// Admin Routes (Admin Authentication Required)
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    // Settings Management
    $routes->get('settings', 'Admin\Settings::index');
    $routes->post('settings/update', 'Admin\Settings::update');
    
    // User Management
    $routes->get('users', 'Admin\Users::index');
    $routes->get('users/create', 'Admin\Users::create');
    $routes->post('users', 'Admin\Users::store');
    $routes->get('users/(:num)/edit', 'Admin\Users::edit/$1');
    $routes->post('users/(:num)', 'Admin\Users::update/$1');
    $routes->post('users/(:num)/delete', 'Admin\Users::delete/$1');
    $routes->post('users/(:num)/approve', 'Admin\Users::approve/$1');
    $routes->post('users/(:num)/reject', 'Admin\Users::reject/$1');
    
    // Divisi Management
    $routes->get('divisi', 'Admin\Divisi::index');
    $routes->get('divisi/create', 'Admin\Divisi::create');
    $routes->post('divisi', 'Admin\Divisi::store');
    $routes->get('divisi/(:num)/edit', 'Admin\Divisi::edit/$1');
    $routes->post('divisi/(:num)', 'Admin\Divisi::update/$1');
    $routes->post('divisi/(:num)/delete', 'Admin\Divisi::delete/$1');
    
    // Kegiatan Management
    $routes->get('kegiatan', 'Admin\Kegiatan::index');
    $routes->get('kegiatan/create', 'Admin\Kegiatan::create');
    $routes->post('kegiatan', 'Admin\Kegiatan::store');
    $routes->get('kegiatan/(:num)/edit', 'Admin\Kegiatan::edit/$1');
    $routes->post('kegiatan/(:num)', 'Admin\Kegiatan::update/$1');
    $routes->post('kegiatan/(:num)/delete', 'Admin\Kegiatan::delete/$1');
    
    // Kode Etik Management
    $routes->get('kode-etik', 'Admin\KodeEtik::index');
    $routes->get('kode-etik/create', 'Admin\KodeEtik::create');
    $routes->post('kode-etik', 'Admin\KodeEtik::store');
    $routes->get('kode-etik/(:num)/edit', 'Admin\KodeEtik::edit/$1');
    $routes->post('kode-etik/(:num)', 'Admin\KodeEtik::update/$1');
    $routes->post('kode-etik/(:num)/delete', 'Admin\KodeEtik::delete/$1');
    
    // Video Angkatan Management
    $routes->get('video-angkatan', 'Admin\VideoAngkatan::index');
    $routes->get('video-angkatan/create', 'Admin\VideoAngkatan::create');
    $routes->post('video-angkatan', 'Admin\VideoAngkatan::store');
    $routes->get('video-angkatan/(:num)/edit', 'Admin\VideoAngkatan::edit/$1');
    $routes->post('video-angkatan/(:num)', 'Admin\VideoAngkatan::update/$1');
    $routes->post('video-angkatan/(:num)/delete', 'Admin\VideoAngkatan::delete/$1');
    
    // ID Card Management
    $routes->get('id-card', 'Admin\IdCard::index');
    $routes->get('id-card/create', 'Admin\IdCard::create');
    $routes->post('id-card', 'Admin\IdCard::store');
    $routes->get('id-card/(:num)/edit', 'Admin\IdCard::edit/$1');
    $routes->post('id-card/(:num)', 'Admin\IdCard::update/$1');
    $routes->post('id-card/(:num)/delete', 'Admin\IdCard::delete/$1');
    
    // Reports
    $routes->get('reports', 'Admin\Reports::index');
    $routes->get('reports/users', 'Admin\Reports::users');
    $routes->get('reports/activities', 'Admin\Reports::activities');
});

// API Routes
$routes->group('api', function($routes) {
    $routes->get('divisi', 'Api\Divisi::index');
    $routes->get('kegiatan', 'Api\Kegiatan::index');
    $routes->get('search', 'Api\Search::index');
});

// Utility Routes
$routes->get('download/pdf/(:segment)', 'Download::index/$1');
$routes->post('upload', 'Upload::index');
$routes->get('pdf/registration/(:num)', 'Pdf::registration/$1');
$routes->get('pdf/id-card/(:num)', 'Pdf::idCard/$1');
$routes->get('whatsapp/(:segment)', 'WhatsApp::index/$1');

// Error Routes
$routes->set404Override(function() {
    return view('errors/404');
});
