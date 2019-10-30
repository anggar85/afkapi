<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']    = 'auth/index';


// Mobile

// V1
$route['api/v1/hero/list']                          = 'api/v1/hero/list_all';
$route['api/v1/hero/detail/(:num)']                 = 'api/v1/hero/detail/$1';

$route['api/v1/extras/faq']                         = 'extras/faq';
$route['api/v1/extras/items_list']                  = 'extras/items_list';
$route['api/v1/extras/contributors']                = 'extras/contributors';
$route['api/v1/extras/rol_definitions']             = 'extras/rol_definitions';
$route['api/v1/extras/create_StrengthWeakness']     = 'extras/create_StrengthWeakness';



// V2
$route['api/v2/hero/list']                          = 'api/v2/hero/list_all';
$route['api/v2/hero/list_advanced']                 = 'api/v2/hero/list_advanced';
$route['api/v2/hero/detail/(:num)']                 = 'api/v2/hero/detail/$1';
$route['api/v2/hero/show/(:num)/(:any)']            = 'api/v2/hero/show/$1/$2';

$route['api/v2/extras/faq']                         = 'extras/faq';
$route['api/v2/extras/items_list']                  = 'extras/items_list';
$route['api/v2/extras/contributors']                = 'extras/contributors';
$route['api/v2/extras/rol_definitions']             = 'extras/rol_definitions';
$route['api/v2/extras/add_suggestion']              = 'extras/add_suggestion';
$route['api/v2/extras/news']                        = 'extras/news_list';

$route['api/v2/user/show_profile/(:num)']           = 'users/show_profile/$1';
$route['api/v2/user/update_profile/(:num)']         = 'users/update_profile/$1';
$route['api/v2/user/show_fb']                       = 'users/show_fb';
$route['api/v2/user/create_fb']                     = 'users/create_fb';

// DECKS
$route['api/v2/deck/decks_list/(:num)/(:num)']      = 'api/v2/deck/decks_list/$1/$2';
$route['api/v2/deck/mydecks/(:num)']                = 'api/v2/deck/mydecks/$1';
$route['api/v2/deck/show_deck/(:num)']              = 'api/v2/deck/show_deck/$1';
$route['api/v2/deck/create_deck/']                  = 'api/v2/deck/create_deck/';

// VOTES
$route['api/v2/votes/create_vote']                  = 'api/v2/votes/create_vote';

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
$route['items/list']            = 'items/list_items';
$route['items/edit/(:num)']     = 'items/edit/$1';
$route['items/update/(:num)']   = 'items/update/$1';
$route['items/new']             = 'items/new_item';
$route['items/save']            = 'items/save';
$route['items/delete/(:num)']    = 'items/delete/$1';

