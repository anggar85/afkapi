<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']    = 'auth/index';

// Login
$route['api/v1/auth/register']  = 'auth/register';
$route['api/v1/auth/login']     = 'auth/login';
$route['api/v1/auth/logout']     = 'auth/logout';
$route['api/v1/auth/checksession']     = 'auth/checkSession';
$route['api/v1/auth/password_recovery']     = 'auth/password_recovery'; // send email to reset password
$route['api/v1/auth/password_reset']     = 'auth/password_reset'; // Check if token is valid to send user a section where it update new password
$route['password_reset']     = 'auth/password_reset'; // page where user put new password
$route['api/v1/auth/set_new_password']     = 'auth/set_new_password'; // save new password


// Mobile
$route['api/v2/hero/list']  = 'hero/list_all';
$route['api/v2/hero/detail']  = 'hero/detail';

$route['api/v2/extras/faq']  = 'extras/faq';
$route['api/v2/extras/items_list']  = 'extras/items_list';
$route['api/v2/extras/rol_definitions']  = 'extras/rol_definitions';
$route['api/v2/extras/create_StrengthWeakness']  = 'extras/create_StrengthWeakness';


// Web Interface

$route['api/v2/hero/list_all_interface']  = 'hero/list_all_interface';
$route['hero/update_hero_basic_info']  = 'hero/update_hero_basic_info';

$route['extras/dbBackup']  = 'extras/dbBackup';



