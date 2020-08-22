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


$route['surat/pending'] = 'admin/C_surat/pending';
$route['surat/ditolak'] = 'admin/C_surat/ditolak';
$route['surat/selesai'] = 'admin/C_surat/selesai';