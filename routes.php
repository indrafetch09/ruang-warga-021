<?php

$router = new \Core\Router();

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

// Laporan Bulanan
$router->get('/laporan', 'laporan/index.php');
$router->get('/laporan/create', 'laporan/create.php')->only('auth');
$router->post('/laporan', 'laporan/store.php')->only('auth');
$router->get('/laporan/export', 'laporan/export.php')->only('auth');

// Admin Panel
$router->get('/admin', 'admin/dashboard.php')->only('auth');
$router->get('/admin/dashboard', 'admin/dashboard.php')->only('auth');

// Admin - Data Warga
$router->get('/admin/warga', 'admin/warga/index.php')->only('auth');
$router->post('/admin/warga', 'admin/warga/store.php')->only('auth');
$router->patch('/admin/warga', 'admin/warga/update.php')->only('auth');
$router->delete('/admin/warga/delete', 'admin/warga/destroy.php')->only('auth');

// Admin - Data RT
$router->get('/admin/rt', 'admin/rt/index.php')->only('auth');
$router->post('/admin/rt', 'admin/rt/store.php')->only('auth');
$router->patch('/admin/rt', 'admin/rt/update.php')->only('auth');
$router->delete('/admin/rt/delete', 'admin/rt/destroy.php')->only('auth');

// Admin - Pengaturan
$router->get('/admin/pengaturan', 'admin/pengaturan/index.php')->only('auth');

// Notes
$router->get('/notes', 'notes/index.php')->only('auth');
$router->get('/note', 'notes/show.php');
$router->delete('/note', 'notes/destroy.php');
$router->get('/note/edit', 'notes/edit.php');
$router->patch('/note', 'notes/update.php');
$router->get('/notes/create', 'notes/create.php');
$router->post('/notes', 'notes/store.php');

// Auth & Session
$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');
$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');
