<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index',['filter' => 'auth:1,2,3']);


$routes->group('auth', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->add('login', 'Auth::login');
	$routes->add('inicio2', 'Auth::inicio');
	$routes->get('logout', 'Auth::logout');
	$routes->add('forgot_password', 'Auth::forgot_password');
	$routes->add('change_password', 'Auth::change_password',['filter' => 'auth:1,2,3']);
	$routes->get('/', 'Auth::index',['filter' => 'auth:1,2,3']);
	$routes->add('create_user', 'Auth::create_user',['filter' => 'auth:1']);
	$routes->add('edit_user/(:num)', 'Auth::edit_user/$1',['filter' => 'auth:1']);
	$routes->add('create_group', 'Auth::create_group',['filter' => 'auth:1']);
	$routes->get('activate/(:num)', 'Auth::activate/$1',['filter' => 'auth:1']);
	$routes->get('activate/(:num)/(:hash)', 'Auth::activate/$1/$2',['filter' => 'auth:1']);
	$routes->add('deactivate/(:num)', 'Auth::deactivate/$1',['filter' => 'auth:1']);
	$routes->get('reset_password/(:hash)', 'Auth::reset_password/$1',['filter' => 'auth:1,2,3']);
	$routes->post('reset_password/(:hash)', 'Auth::reset_password/$1',['filter' => 'auth:1,2,3']);
	// ...
});

$routes->group('administrador', ['namespace' => 'App\Controllers','filter' => 'auth:1'], function ($routes) {
	$routes->add('/', 'Administrador::principal');
	$routes->get('logout', 'Auth::logout');
	$routes->add('tipo_producto', 'Administrador::tipo_producto');
	$routes->add('producto', 'Administrador::producto');
});


$routes->group('archivo', ['namespace' => 'App\Controllers\ArchivoDocente'], function ($routes) {
	$routes->add('/', 'Inicio::Index',['filter' => 'auth:2']);
	$routes->add('principal', 'Inicio::Principal',['filter' => 'auth:2']);
	$routes->add('kardex/(:any)', 'Kardex::Index/$1',['filter' => 'auth:2,3']);
	$routes->add('docente/(:any)', 'Inicio::Docente/$1',['filter' => 'auth:2,3']);
	$routes->add('titulo/(:any)', 'Titulo::Index/$1',['filter' => 'auth:2,3']);
	$routes->add('produccionintelectual/(:any)', 'ProduccionIntelectual::Index/$1',['filter' => 'auth:2,3']);
	// $routes->add('curso/(:any)', 'Curso::Index/$1',['filter' => 'auth:2,3']);
	$routes->add('actividadacademica/(:any)', 'ActividadAcademica::Index/$1',['filter' => 'auth:2,3']);
	$routes->add('vidauniversitaria/(:any)', 'VidaUniversitaria::Index/$1',['filter' => 'auth:2,3']);
	$routes->add('evaluacion/(:any)', 'Evaluacion::Index/$1',['filter' => 'auth:2,3']);
});

$routes->group('docente', ['namespace' => 'App\Controllers\Docente','filter' => 'auth:3'], function ($routes) {
	$routes->add('/', 'Inicio::Index');
	$routes->add('principal', 'Inicio::Principal');
});


$routes->group('atencioncliente', ['namespace' => 'App\Controllers\AtencionCliente','filter' => 'auth:2'], function ($routes) {
	$routes->add('/', 'Cliente::Index');
	$routes->get('principal', 'Inicio::Principal');
	// $routes->add('cliente/(:any)', 'Cliente::Index/$1');
	$routes->add('cliente', 'Cliente::Index');
});

$routes->group('gerente', ['namespace' => 'App\Controllers\Gerente','filter' => 'auth:2'], function ($routes) {
	$routes->add('/', 'Gerente::index');
	$routes->add('cliente', 'Gerente::cliente');
	$routes->add('empleado', 'Gerente::empleado');
	$routes->add('usuario', 'Gerente::usuario');

});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
