<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$a = base_url();

if (strpos($a, 'localhost') !== false) {
	// echo "es local";
    $db['default'] = array(
		'dsn'	=> '',
		'hostname' => 'localhost',
		'username' => AFK_USER_LOCAL,
		'password' => AFK_PASSWORD_LOCAL,
		'database' => AFK_DATABASE_LOCAL,
		'dbdriver' => 'mysqli',
		'dbprefix' => '',
		'pconnect' => FALSE,
		'db_debug' => (ENVIRONMENT !== 'production'),
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE
	);


}else{

	if (strpos($a, 'staging') !== false) {
		// echo "es staging";

		$db['default'] = array(
			'dsn'	=> '',
			'hostname' => 'localhost',
			'username' => AFK_USER_STAGING,
			'password' => AFK_PASSWORD_STAGING,
			'database' => AFK_DATABASE_STAGING,
			'dbdriver' => 'mysqli',
			'dbprefix' => '',
			'pconnect' => FALSE,
			'db_debug' => (ENVIRONMENT !== 'production'),
			'cache_on' => FALSE,
			'cachedir' => '',
			'char_set' => 'utf8',
			'dbcollat' => 'utf8_general_ci',
			'swap_pre' => '',
			'encrypt' => FALSE,
			'compress' => FALSE,
			'stricton' => FALSE,
			'failover' => array(),
			'save_queries' => TRUE
		);
	}else{
		// echo "es produccion";

			$db['default'] = array(
				'dsn'	=> '',
				'hostname' => 'localhost',
				'username' => AFK_USER,
				'password' => AFK_PASSWORD,
				'database' => AFK_DATABASE,
				'dbdriver' => 'mysqli',
				'dbprefix' => '',
				'pconnect' => FALSE,
				'db_debug' => (ENVIRONMENT !== 'production'),
				'cache_on' => FALSE,
				'cachedir' => '',
				'char_set' => 'utf8',
				'dbcollat' => 'utf8_general_ci',
				'swap_pre' => '',
				'encrypt' => FALSE,
				'compress' => FALSE,
				'stricton' => FALSE,
				'failover' => array(),
				'save_queries' => TRUE
			);
	}

}



