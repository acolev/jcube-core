<?php

return [
    [
        'name' => 'Dashboard',
        'access' => 'Manage Dashboard',
        'link' => [
            'type' => 'link',
            'name' => 'admin.dashboard',
            'active' => ['admin.dashboard'],
        ],
        'search' => [
            'query' => 'dashboard',
            'title' => 'Manage Dashboard',
        ],
        'icon' => 'las la-home',
    ],
    [
        'name' => 'Manage Staff',
        'access' => 'Manage Staff',
        'link' => [
            'type' => 'link',
            'name' => 'admin.staff.index',
            'active' => ['admin.staff.*'],
        ],
        'search' => [
            'query' => 'manage staff, admins, manage admins',
            'title' => 'Manage Staff',
            'group' => 'Users',
        ],
        'icon' => 'las la-users',
    ],
    [
        'name' => 'Settings',
        'link' => [
            'type' => 'title',
        ],
        'children' => [
            [
                'name' => 'General Setting',
                'access' => 'Manage General Setting',
                'link' => [
                    'type' => 'link',
                    'name' => 'admin.setting.index',
                    'active' => ['admin.setting.index'],
                ],
                'search' => [
                    'query' => 'general setting',
                    'title' => 'General Setting',
                    'group' => 'Settings',
                ],
                'icon' => 'las la-life-ring',
            ],
            [
                'name' => 'System Configuration',
                'access' => 'Manage System Configuration',
                'link' => [
                    'type' => 'link',
                    'name' => 'admin.setting.system.configuration',
                    'active' => ['admin.setting.system.configuration'],
                ],
                'search' => [
                    'query' => 'system setting, system configuration',
                    'title' => 'System Configuration',
                    'group' => 'Settings',
                ],
                'icon' => 'las la-cog',
            ],
            [
                'name' => 'Logo & Favicon',
                'access' => 'Manage Logo And Favicon',
                'link' => [
                    'type' => 'link',
                    'name' => 'admin.setting.logo.icon',
                    'active' => ['admin.setting.logo.icon'],
                ],
                'search' => [
                    'query' => 'logo, favicon',
                    'title' => 'Logo & Favicon',
                    'group' => 'Settings',
                ],
                'icon' => 'las la-images',
            ],
        ],
    ],
    [
        'name' => 'Others',
        'link' => [
            'type' => 'title',
        ],
        'children' => [
            [
                'name' => 'System',
                'access' => 'Others',
                'link' => [
                    'type' => 'link',
                    'name' => 'admin.setting.index',
                    'active' => 'admin.system*',
                    'open' => 'admin.system*',
                ],
                'icon' => 'la la-server',
                'children' => [
                    [
                        'name' => 'Application',
                        'link' => [
                            'type' => 'link',
                            'name' => 'admin.system.info',
                            'active' => ['admin.system.info'],
                        ],
                        'search' => [
                            'query' => 'application info, app info',
                            'title' => 'Application Info',
                            'group' => 'Others',
                        ],
                    ],
                    [
                        'name' => 'Server',
                        'link' => [
                            'type' => 'link',
                            'name' => 'admin.system.server.info',
                            'active' => ['admin.system.server.info'],
                        ],
                        'search' => [
                            'query' => 'server info',
                            'title' => 'Server Info',
                            'group' => 'Others',
                        ],
                    ],
                    [
                        'name' => 'Cache',
                        'link' => [
                            'type' => 'link',
                            'name' => 'admin.system.optimize',
                            'active' => ['admin.system.optimize'],
                        ],
                        'search' => [
                            'query' => 'clear cache',
                            'title' => 'Clear Cache',
                            'group' => 'Others',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
