<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'C_login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'C_login';
$route['login/aksi'] = 'C_login/aksi';
$route['logout/(:any)'] = 'C_login/logout/$1';
$route['dashboard'] = 'C_dashboard';


$route['master/user'] = 'admin/C_user';
$route['master/user/data'] = 'admin/C_user/data';
$route['master/user/get/(:any)'] = 'admin/C_user/get/$1';
$route['master/user/insert'] = 'admin/C_user/insert';
$route['master/user/delete/(:any)'] = 'admin/C_user/delete/$1';
$route['master/user/update'] = 'admin/C_user/update';


$route['master/dokumen'] = 'admin/C_dokumen';
$route['master/dokumen/data'] = 'admin/C_dokumen/data';
$route['master/dokumen/get/(:any)'] = 'admin/C_dokumen/get/$1';
$route['master/dokumen/insert'] = 'admin/C_dokumen/insert';
$route['master/dokumen/delete/(:any)'] = 'admin/C_dokumen/delete/$1';
$route['master/dokumen/update'] = 'admin/C_dokumen/update';


$route['surat/(:any)'] = 'admin/C_surat/surat/$1';
$route['surat/(:any)/data'] = 'admin/C_surat/data';
$route['surat/delete/(:any)'] = 'admin/C_surat/delete/$1';
$route['surat/action/(:any)/(:any)'] = 'admin/C_surat/action/$1/$2';
$route['surat/action/tambah'] = 'admin/C_surat/add_';
$route['surat/unduh/(:any)'] = 'admin/C_surat/unduh/$1';
$route['surat/get/notif'] = 'admin/C_surat/getNotif';
$route['surat/get/surat/(:any)'] = 'admin/C_surat/getSurat/$1';
$route['surat/test/surat'] = 'admin/C_surat/testSurat';
