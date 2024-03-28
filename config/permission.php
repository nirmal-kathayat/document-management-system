<?php 

return[
	"without" =>[
		'/',
		'logout',
		'forgotPassword',
		'password/reset/{token}'
	],
	"allow" =>[
		"login",
		"logout",
		'admin.dashboard',
		// 'password.reset',
		'forgotPassword'
	],
	'guard' => 'admin',
	"guest_redirect" =>'login',
	"basePrefix" => 'admin'
];