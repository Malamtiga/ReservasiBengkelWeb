<?php

namespace Config;
use CodeIgniter\Router\RouteCollection;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('DatauserController');
$routes->setDefaultMethod('viewLogin');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.





//viewlogin
$routes->get('/', 'DatauserController::viewLogin');
//



//login page dan fungsi login
$routes->group(
    '/login',
    [
        'filter' => 'CekLogin',
        'CekLogin' => \App\Filters\Logincuy::class,

        'filter' => 'LoginBengkel',
        'LoginBengkel' => \App\Filters\BengkelLogin::class,
        
        'filter' => 'LoginAdmin',
        'LoginAdmin' => \App\Filters\AdminLogin::class,
     
    ],
    
    function (RouteCollection $routes) {
        $routes->post('/', 'DatauserController::login');
        $routes->get('/', 'DatauserController::viewLogin');
    }
);
//

//fungsi logout
$routes->delete('login', 'DatauserController::logout');
$routes->patch('login', 'DatauserController::logout');
//

//fungsi register
$routes->group('/register',function(RouteCollection $routes){
    $routes->get('/', 'DatauserController::viewRegister');;
    $routes->post('/', 'DatauserController::register');
});
//

//controller admin

$routes->group('admin/registhsv',['filter' => 'CekAdmin'],function(RouteCollection $routes){
    $routes->get('/', 'admin\AdminHSVController::index');
    $routes->patch('(:num)', 'admin\AdminHSVController::approve/$1');
    $routes->get('(:num)', 'admin\AdminHSVController::reject/$1');
    $routes->get('(:num)', 'admin\AdminHSVController::show/$1');
    $routes->get('all', 'admin\AdminHSVController::all');
});

$routes->group('admin/datauser',['filter' => 'CekAdmin'],function(RouteCollection $routes){
    $routes->get('/', 'admin\AdminUserController::index');
    $routes->post('/', 'admin\AdminUserController::store');
    $routes->patch('/', 'admin\AdminUserController::update');
    $routes->delete('/', 'admin\AdminUserController::delete');
    $routes->get('(:num)', 'admin\AdminUserController::show/$1');
    $routes->get('all', 'admin\AdminUserController::all');
});


$routes->group('admin/reservhs',['filter' => 'CekAdmin'],function(RouteCollection $routes){
    $routes->get('/', 'admin\AdminReservhsController::index');
    $routes->delete('/', 'admin\AdminReservhsController::delete');
    $routes->get('(:num)', 'admin\AdminReservhsController::show/$1');
    $routes->get('all', 'admin\AdminReservhsController::all');
});

$routes->group('admin/datareservasi',['filter' => 'CekAdmin'],function(RouteCollection $routes){
    $routes->get('/', 'admin\AdminReservasiController::index');
    $routes->delete('/', 'admin\AdminReservasiController::delete');
    $routes->get('(:num)', 'admin\AdminReservasiController::show/$1');
    $routes->get('all', 'admin\AdminReservasiController::all');
});


$routes->group('admin/profile/',['filter' => 'CekAdmin'],function(RouteCollection $routes){
    $routes->get('/', 'admin\AdminprofileController::index');
    $routes->post('/', 'admin\AdminprofileController::update');
    $routes->post('upload', 'admin\AdminprofileController::upload'); 

});
$routes->group('admin/dashboard',['filter' => 'CekAdmin'],['filter' => 'CekAdmin'],function(RouteCollection $routes){
    $routes->get('/', 'admin\DashboardadminController::index');

});
// batas route admin


//controller pengguna

$routes->group('pengguna/datareservasi',['filter' => 'Login'],function(RouteCollection $routes){
    $routes->get('/', 'pengguna\DataReservasiController::index');
    $routes->post('/', 'pengguna\DataReservasiController::store');
    $routes->get('(:num)', 'pengguna\DataReservasiController::batal/$1');
    $routes->get('(:num)', 'pengguna\DataReservasiController::show/$1');
    $routes->get('all', 'pengguna\DataReservasiController::all');
});
$routes->group('pengguna/registhsv',['filter' => 'Login'],function(RouteCollection $routes){
    $routes->get('/', 'pengguna\DataregistrasihsvController::index');
    $routes->get('(:num)', 'pengguna\DataregistrasihsvController::show/$1');
    $routes->get('all', 'pengguna\DataregistrasihsvController::all');
});
$routes->group('pengguna/reservasihsv',['filter' => 'Login'],function(RouteCollection $routes){
    $routes->get('/', 'pengguna\DatareservhomeservController::index');
    $routes->post('/', 'pengguna\DatareservhomeservController::store');
    $routes->get('(:num)', 'pengguna\DatareservhomeservController::batal/$1');
    $routes->get('(:num)', 'pengguna\DatareservhomeservController::show/$1');
    $routes->get('all', 'pengguna\DatareservhomeservController::all');
});

$routes->group('pengguna/profile',['filter' => 'Login'],function(RouteCollection $routes){
    $routes->get('/', 'pengguna\ProfileController::index');
    $routes->post('/', 'pengguna\ProfileController::update');
    $routes->post('upload', 'pengguna\ProfileController::upload'); 

});

$routes->group('pengguna/dashboard',['filter' => 'Login'],function(RouteCollection $routes){
    $routes->get('/', 'pengguna\DashboardController::index');
 
});

// batas route pengguna



//controller bengkel
$routes->group('bengkel/datareservasi',['filter' => 'CekBengkel'],function(RouteCollection $routes){
    $routes->get('/', 'bengkel\BengkelReservasiController::index');
    $routes->patch('(:num)', 'bengkel\BengkelReservasiController::approve/$1');
    $routes->get('(:num)', 'bengkel\BengkelReservasiController::reject/$1');
    $routes->get('(:num)', 'bengkel\BengkelReservasiController::show/$1');
    $routes->get('all', 'bengkel\BengkelReservasiController::all');
});

$routes->group('bengkel/reservhs',['filter' => 'CekBengkel'],function(RouteCollection $routes){
    $routes->get('/', 'bengkel\BengkelReservhsController::index');
    $routes->patch('(:num)', 'bengkel\BengkelReservhsController::approve/$1');
    $routes->get('(:num)', 'bengkel\BengkelReservhsController::reject/$1');
    $routes->get('(:num)', 'bengkel\BengkelReservhsController::show/$1');
    $routes->get('all', 'bengkel\BengkelReservhsController::all');

});
$routes->group('bengkel/registhsv',['filter' => 'CekBengkel'],function(RouteCollection $routes){
    $routes->get('/', 'bengkel\BengkelRegistHSVController::index');
    $routes->post('/', 'bengkel\BengkelRegistHSVController::store');
    $routes->patch('/', 'bengkel\BengkelRegistHSVController::update');
    $routes->delete('/', 'bengkel\BengkelRegistHSVController::delete');
    $routes->get('(:num)', 'bengkel\BengkelRegistHSVController::show/$1');
    $routes->get('all', 'bengkel\BengkelRegistHSVController::all');
});


$routes->group('bengkel/layanan',function(RouteCollection $routes){
    $routes->get('/', 'bengkel\BengkelLayananController::index');
    $routes->post('/', 'bengkel\BengkelLayananController::store');
    $routes->delete('/', 'bengkel\BengkelLayananController::delete');
    $routes->get('(:num)', 'bengkel\BengkelLayananController::show/$1');
    $routes->get('all', 'bengkel\BengkelLayananController::all');
});

$routes->group('bengkel/profile',['filter' => 'CekBengkel'],function(RouteCollection $routes){
    $routes->get('/', 'bengkel\BengkelprofileController::index');
    $routes->post('/', 'bengkel\BengkelprofileController::update');
    $routes->post('upload', 'bengkel\BengkelprofileController::upload'); 

    
});

$routes->group('bengkel/dashboard',['filter' => 'CekBengkel'],function(RouteCollection $routes){
    $routes->get('/', 'bengkel\DashboardbengkelController::index');
});
// batas route bengkel















/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
