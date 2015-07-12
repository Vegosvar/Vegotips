<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main';
$route['(:num)'] = 'main/index/$1';
$route['main/(:num)'] = 'main/index/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
