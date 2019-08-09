<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']    = 'auth/index';


// Mobile
$route['api/v1/hero/list']                          = 'api/v1/hero/list_all';
$route['api/v1/hero/detail/(:num)']                 = 'api/v1/hero/detail/$1';

$route['api/v2/extras/faq']                         = 'extras/faq';
$route['api/v2/extras/items_list']                  = 'extras/items_list';
$route['api/v2/extras/rol_definitions']             = 'extras/rol_definitions';
$route['api/v2/extras/create_StrengthWeakness']     = 'extras/create_StrengthWeakness';


// Web Interface

// Login
$route['api/v1/auth/register']  = 'auth/register';
$route['api/v1/auth/login']     = 'auth/login';
$route['api/v1/auth/logout']     = 'auth/logout';
$route['api/v1/auth/checksession']     = 'auth/checkSession';
$route['api/v1/auth/password_recovery']     = 'auth/password_recovery'; // send email to reset password
$route['api/v1/auth/password_reset']     = 'auth/password_reset'; // Check if token is valid to send user a section where it update new password
$route['password_reset']     = 'auth/password_reset'; // page where user put new password
$route['api/v1/auth/set_new_password']     = 'auth/set_new_password'; // save new password



// Heroes
$route['hero/list']                                         = 'hero/list_all_interface';
$route['hero/edit/(:num)']                                  = 'hero/edit/$1';
$route['hero/update/(:num)']                                = 'hero/update/$1';
$route['hero/update_skill/(:num)']                          = 'hero/update_skill/$1';
$route['hero/strengthweakenes_delete/(:num)/hero/(:num)']   = 'hero/strengthweakenes_delete/$1/$2';
$route['hero/create_strength_weakness']                     = 'hero/create_strength_weakness';
$route['hero/update_tier_data/(:any)/(:any)/(:any)']        = 'hero/update_tier_data/$1/$2/$3';
$route['hero/new']                                          = 'hero/new_hero';
$route['hero/save']                                         = 'hero/save';
// $route['items/delete/(:num']    = 'items/delete/$1';


// Items
$route['items/list']            = 'items/list';
$route['items/edit/(:num)']     = 'items/edit/$1';
$route['items/update/(:num)']   = 'items/update/$1';
$route['items/new']             = 'items/new';
$route['items/save']            = 'items/save';
$route['items/delete/(:num)']    = 'items/delete/$1';



$route['extras/dbBackup']  = 'extras/dbBackup';



