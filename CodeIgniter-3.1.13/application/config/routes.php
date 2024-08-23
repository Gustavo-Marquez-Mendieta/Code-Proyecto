<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['usuarios'] = 'usuarios/listaUsuarios';
$route['Welcome/editarVajilla/(:num)'] = 'Welcome/editVajilla/$1';
$route['adminDecoraciones'] = 'Welcome/adminDecoraciones';
$route['mi-cuenta'] = 'Welcome/miCuenta';
$route['Welcome/eliminar_del_carrito/(:num)'] = 'Welcome/eliminar_del_carrito/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
