<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home Routes
$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');
$routes->get('contact', 'Home::contact');
$routes->get('search', 'Home::search');
$routes->get('sitemap', 'Home::sitemap');
$routes->get('robots', 'Home::robots');

// Auth Routes
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register');
$routes->get('register/success', 'Auth::registerSuccess');
$routes->get('forgot-password', 'Auth::forgotPassword');
$routes->post('forgot-password', 'Auth::forgotPassword');
$routes->get('reset-password/(:segment)', 'Auth::resetPassword/$1');
$routes->post('reset-password/(:segment)', 'Auth::resetPassword/$1');

// Divisi Routes
$routes->get('divisi', 'Divisi::index');
$routes->get('divisi/(:segment)', 'Divisi::show/$1');

// Kegiatan Routes
$routes->get('kegiatan', 'Kegiatan::index');
$routes->get('kegiatan/(:segment)', 'Kegiatan::show/$1');

// Kode Etik Routes
$routes->get('kode-etik', 'KodeEtik::index');
$routes->get('kode-etik/(:segment)', 'KodeEtik::show/$1');

// Member Routes (requires login)
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('profile', 'Profile::index');
    $routes->post('profile', 'Profile::update');
    
    // Video Angkatan (member only)
    $routes->get('video-angkatan', 'VideoAngkatan::index');
    $routes->get('video-angkatan/(:num)', 'VideoAngkatan::show/$1');
    
    // Download documents (member only)
    $routes->get('download/(:segment)', 'Download::document/$1');
});

// Admin Routes (requires admin)
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
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
    $routes->get('id-cards', 'Admin\IdCard::index');
    $routes->get('id-cards/create', 'Admin\IdCard::create');
    $routes->post('id-cards', 'Admin\IdCard::store');
    $routes->get('id-cards/(:num)/edit', 'Admin\IdCard::edit/$1');
    $routes->post('id-cards/(:num)', 'Admin\IdCard::update/$1');
    $routes->post('id-cards/(:num)/delete', 'Admin\IdCard::delete/$1');
    $routes->get('id-cards/(:num)/generate', 'Admin\IdCard::generate/$1');
    
    // Reports
    $routes->get('reports', 'Admin\Reports::index');
    $routes->get('reports/users', 'Admin\Reports::users');
    $routes->get('reports/kegiatan', 'Admin\Reports::kegiatan');
    $routes->get('reports/divisi', 'Admin\Reports::divisi');
});

// API Routes (for AJAX requests)
$routes->group('api', function($routes) {
    $routes->get('divisi', 'Api\Divisi::index');
    $routes->get('kegiatan', 'Api\Kegiatan::index');
    $routes->get('search', 'Api\Search::index');
});

// PDF Generation Routes
$routes->get('pdf/registration/(:num)', 'Pdf::registration/$1');
$routes->get('pdf/id-card/(:num)', 'Pdf::idCard/$1');

// File Upload Routes
$routes->post('upload/foto', 'Upload::foto');
$routes->post('upload/document', 'Upload::document');

// WhatsApp Integration
$routes->get('whatsapp/join', 'WhatsApp::join');

// Error Pages
$routes->set404Override(function() {
    return view('errors/404');
});

$routes->get('500', function() {
    return view('errors/500');
});
