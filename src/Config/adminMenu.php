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
    "name" => "Staff",
    "access" => "Staff:Read",
    "link" => [
      "type" => "link",
      "name" => "admin.staff.index",
      "active" => ['admin.staff.*','admin.roles.*'],
    ],
    "icon" => 'las la-users',
    "children" => [
      [
        "name" => "Staff",
        "access" => "Staff:Read",
        "link" => [
          "type" => "link",
          "name" => "admin.staff.index",
          "active" => ['admin.staff.index'],
        ],
        "search" => [
          "query" => "manage staff, admins, manage admins",
          "title" => "Manage Staff",
          "group" => "Users"
        ],
      ],
      [
        "name" => "Roles",
        "access" => "Role:Edit",
        "link" => [
          "type" => "link",
          "name" => "admin.roles.index",
          "active" => ['admin.roles.*'],
        ],
        "search" => [
          "query" => "manage roles",
          "title" => "Manage Roles",
        ],
      ],
    ]
  ],
	[
		"name" => "Settings",
		"link" => [
			"type" => "title",
		],
		"children" => [
			[
				"name" => "System Configuration",
				"access" => "Manage System Configuration",
				"link" => [
					"type" => "link",
					"name" => "admin.config.view",
					"params" => ['general'],
					"active" => ['admin.config*'],
				],
				"search" => [
					"query" => "config, settings, preference, system",
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
];
