<?php
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('index', 'Home::index');
$routes->get('admin', 'Admin::index');
$routes->get('student', 'Student::index');

$routes->get('adddept', 'Admin::add');
$routes->get('addstu', 'Student::add');

//additional
$routes->get('fetch', 'Student::fetch');
$routes->post('admin/approve/(:num)', 'Admin::approve/$1');
$routes->post('admin/reject/(:num)', 'Admin::reject/$1');



// student 
$routes->post('stuSave','Student::stuSave');// save data  studnet
$routes->get('stuData','Student::stuData'); //get data of studnet
$routes->post('admiSave','admin::admiSave');// save department to admin
$routes->get('admiData','admin::admiData'); //get data of studnet