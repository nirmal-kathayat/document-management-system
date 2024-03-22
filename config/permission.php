<?php 

return[
	"without" =>[
		'/',
		'logout',
		'admin/users/forgotPassword'
	],
	"allow" =>[
		"login",
		"logout",
		'admin.dashboard'
	],
	'guard' => 'admin',
	"guest_redirect" =>'login',
	"basePrefix" => 'admin'
];