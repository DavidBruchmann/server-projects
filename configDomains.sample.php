<?php

// not used yet, just as info
$basic_source = 'C:/Windows/System32/drivers/etc/hosts';

// not used yet, just as info
$registered_vhosts_conf = array(
	'xampp-win32-1.8.2-0-VC9'
);

$arr_domains = array(
	#DOMAIN
		#PARENT-DOMAIN (main-domain)
		#ALIAS (www.*)
		#PATH
		#ADMIN (url)
		#ADMIN-PATH
		#LOGIN: #USER #PASSWORD
	'localhost' => array(
		'parent-domain' => '',
		'alias' => '',
		'path' => 'D:/WWW',
		'admin-url' => '',
		'admin-path' => '',
		'admin-login' => array('user'=>'','password'=>''),
		// not used yet, just as info
		'registered_vhosts_conf' => array(
			'xampp-win32-1.8.2-0-VC9'
		),
	),
	'domain.com' => array(
		'parent-domain' => '',
		'alias' => 'www.domain.com',
		'path' => 'D:/WWW/domain.com/',
		'admin-url' => 'domain.com/admin/',
		'admin-path' => 'D:/WWW/domain.com/admin/',
		'admin-login' => array('user'=>'admin','password'=>'password'),
		// not used yet, just as info
		'registered_vhosts_conf' => array(
			'xampp-win32-1.8.2-0-VC9'
		),
	),
);

?>