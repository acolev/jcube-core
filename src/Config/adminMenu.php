<?php

return [
	[
		"name" => "Dashboard",
		"access" => "Manage Dashboard",
		"link" => [
			"type" => "link",
			"name" => "admin.dashboard",
			"active" => ['admin.dashboard'],
		],
		"icon" => 'las la-home',
	],
	[
		"name" => "Manage Staff",
		"access" => "Manage Staff",
		"link" => [
			"type" => "link",
			"name" => "admin.staff.index",
			"active" => ['admin.staff.*'],
		],
		"icon" => 'las la-users',
	],
	[
		"name" => "Settings",
		"link" => [
			"type" => "title",
		],
		"children" => [
			[
				"name" => "General Setting",
				"access" => "Manage General Setting",
				"link" => [
					"type" => "link",
					"name" => "admin.setting.index",
					"active" => ['admin.setting.index'],
				],
				"icon" => 'las la-life-ring',
			],
			[
				"name" => "System Configuration",
				"access" => "Manage System Configuration",
				"link" => [
					"type" => "link",
					"name" => "admin.setting.system.configuration",
					"active" => ['admin.setting.system.configuration'],
				],
				"icon" => 'las la-cog',
			],
			[
				"name" => "Logo & Favicon",
				"access" => "Manage Logo And Favicon",
				"link" => [
					"type" => "link",
					"name" => "admin.setting.logo.icon",
					"active" => ['admin.setting.logo.icon'],
				],
				"icon" => 'las la-images',
			],
		],
	],
];
