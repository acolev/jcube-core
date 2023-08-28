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
		"search" => [
			"query" => "dashboard",
			"title" => "Manage Dashboard"
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
		"search" => [
			"query" => "manage staff, admins, manage admins",
			"title" => "Manage Staff",
			"group" => "Users"
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
				"name" => "General Settings",
				"access" => "Manage General Settings",
				"link" => [
					"type" => "link",
					"name" => "admin.setting.index",
					"active" => ['admin.setting.index'],
				],
				"search" => [
					"query" => "general Settings",
					"title" => "General Settings",
					"group" => "Settings"
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
				"search" => [
					"query" => "system setting, system configuration",
					"title" => "System Configuration",
					"group" => "Settings"
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
				"search" => [
					"query" => "logo, favicon",
					"title" => "Logo & Favicon",
					"group" => "Settings"
				],
				"icon" => 'las la-images',
			],
			[
				"name" => "Custom CSS",
				"access" => "Others",
				"link" => [
					"type" => "link",
					"name" => "admin.setting.custom.css",
					"active" => 'admin.setting.custom.css',
					"open" => 'admin.setting.custom.css',
				],
				"icon" => 'lab la-css3-alt',
			],
			[
				"name" => "Notification Settings",
				"access" => "Manage Notification Settings",
				"link" => [
					"type" => "link",
					"name" => "admin.setting.notification.global",
					"active" => 'admin.setting.notification*',
					"open" => 'admin.setting.notification*',
				],
				"icon" => 'las la-bell',
				"children" => [
					[
						"name" => "Global Template",
						"link" => [
							"type" => "link",
							"name" => "admin.setting.notification.global",
							"active" => 'admin.setting.notification.global',
							"open" => 'admin.setting.notification.global',
						],
					],
					[
						"name" => "Email Settings",
						"link" => [
							"type" => "link",
							"name" => "admin.setting.notification.email",
							"active" => 'admin.setting.notification.email',
							"open" => 'admin.setting.notification.email',
						],
					],
					[
						"name" => "SMS Settings",
						"link" => [
							"type" => "link",
							"name" => "admin.setting.notification.sms",
							"active" => 'admin.setting.notification.sms',
							"open" => 'admin.setting.notification.sms',
						],
					],
					[
						"name" => "Notification Templates",
						"link" => [
							"type" => "link",
							"name" => "admin.setting.notification.templates",
							"active" => 'admin.setting.notification.templates',
							"open" => 'admin.setting.notification.templates',
						],
					],
				]
			],
		],
	],
	[
		"name" => "Others",
		"link" => [
			"type" => "title",
		],
		"children" => [
			[
				"name" => "System",
				"access" => "Others",
				"link" => [
					"type" => "link",
					"name" => "admin.setting.index",
					"active" => 'admin.system*',
					"open" => 'admin.system*',
				],
				"icon" => 'la la-server',
				"children" => [
					[
						"name" => "Application",
						"link" => [
							"type" => "link",
							"name" => "admin.system.info",
							"active" => ['admin.system.info'],
						],
						"search" => [
							"query" => "application info, app info",
							"title" => "Application Info",
							"group" => "Others"
						],
					],
					[
						"name" => "Server",
						"link" => [
							"type" => "link",
							"name" => "admin.system.server.info",
							"active" => ['admin.system.server.info'],
						],
						"search" => [
							"query" => "server info",
							"title" => "Server Info",
							"group" => "Others"
						],
					],
					[
						"name" => "Cache",
						"link" => [
							"type" => "link",
							"name" => "admin.system.optimize",
							"active" => ['admin.system.optimize'],
						],
						"search" => [
							"query" => "clear cache",
							"title" => "Clear Cache",
							"group" => "Others"
						],
					],
				],
			],
		],
	],
];