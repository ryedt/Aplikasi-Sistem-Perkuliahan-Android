<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->get('krs', 'Krs::index');
$routes->post('krs/tambah', 'Krs::create');
$routes->put('krs/(:num)', 'Krs::update/$1');
$routes->delete('krs/(:num)', 'Krs::delete/$1');

$routes->get('mk', 'Matakuliah::index');
$routes->get('kelas', 'Matakuliah::kelas');
$routes->post('mk/tambah', 'Matakuliah::create');
$routes->delete('mk/(:num)', 'Matakuliah::delete/$1');

$routes->get('login', 'UserApi::tampil');
$routes->post('login', 'UserApi::login');
$routes->post('register', 'UserApi::regist');

$routes->get('absensi', 'Presensi::index');
$routes->post('absensi', 'Presensi::create');
$routes->get('presen', 'Presensi::presen');
$routes->post('presensi', 'Presensi::new');

$routes->get('pdf/(:num)', 'PdfApiController::generatePdf/$1');
