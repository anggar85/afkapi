<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']    = 'auth/index';
$route['system/admin']          = 'system/index';
$route['dashboard/user']        = 'dashboard/index';


$route['api/v1/auth/register']  = 'auth/register';
$route['api/v1/auth/login']     = 'auth/login';
$route['api/v1/auth/logout']     = 'auth/logout';
$route['api/v1/auth/checksession']     = 'auth/checkSession';
$route['api/v1/auth/password_recovery']     = 'auth/password_recovery'; // send email to reset password
$route['api/v1/auth/password_reset']     = 'auth/password_reset'; // Check if token is valid to send user a section where it update new password
$route['password_reset']     = 'auth/password_reset'; // page where user put new password
$route['api/v1/auth/set_new_password']     = 'auth/set_new_password'; // save new password


// Users
$route['api/v1/create_user']    = 'users/create';
$route['api/v1/users_list']     = 'users/list_all';
$route['api/v1/show_user']      = 'users/show';
$route['api/v1/update_user']    = 'users/update';
$route['api/v1/delete_user']    = 'users/delete';

$route['api/v1/users/create_user']    = 'users/create';
$route['api/v1/users/users_list']     = 'users/list_all';
$route['api/v1/users/show_user']      = 'users/show';
$route['api/v1/users/update_user']    = 'users/update';
$route['api/v1/users/update_user_password']    = 'users/update_user_password';


$route['404_override']  = '';
$route['translate_uri_dashes'] = FALSE;

// Manifest
$route['api/v1/manifest/list_all_manifest']     = 'manifest/list_all';
$route['api/v1/manifest/show_manifest']         = 'manifest/show';
$route['api/v1/manifest/delete_manifest']       = 'manifest/delete';
$route['api/v1/manifest/create_manifest']       = 'manifest/create';
$route['api/v1/manifest/request_cancelation']   = 'manifest/request_cancelation';
$route['api/v1/manifest/acept_cancelation']     = 'manifest/acept_cancelation';



