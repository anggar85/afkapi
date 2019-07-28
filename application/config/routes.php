<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']    = 'auth/index';

$route['api/v2/hero/list']  = 'hero/list_all';
$route['api/v2/hero/detail']  = 'hero/detail';

$route['api/v2/extras/faq']  = 'extras/faq';
$route['api/v2/extras/items_list']  = 'extras/items_list';
$route['api/v2/extras/rol_definitions']  = 'extras/rol_definitions';




