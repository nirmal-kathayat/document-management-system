<?php 

return[
	"without" =>[
		'/',
		'logout',
	],
"allow" =>[
	"login",
	"logout"
],

	'guard' => 'admin',
	"guest_redirect" =>'login',
	"basePrefix" => 'admin'
];