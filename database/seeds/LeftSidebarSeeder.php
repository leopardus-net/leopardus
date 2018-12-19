<?php

use Illuminate\Database\Seeder;

class LeftSidebarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sidebars = [
        	[
        		'name' => [
                    'es' => 'Menú',
                    'en' => 'Menu',
                    'pt' => 'Cardápio'
                ],
        		'items' => [
        			[
	        			'name' => [
                            'es' => 'Tablero',
                            'en' => 'Dashboard',
                            'pt' => 'Painel de controle'
                        ],
	    				'icon' => 'ti-dashboard',
	    				'route' => 'admin/dashboard',
						'items' => [],
						'permissions' => [
							'dashboard.view'
						]
        			]
				],
				'permissions' => [
					'dashboard.view'
				]
        	],
        	[
        		'name' => [
        			'es' => 'Sistema',
        			'en' => 'System',
                    'pt' => 'Sistema'
        		],
        		'items' => [
        			[
        				'name' => [
        					'es' => 'Configuración',
        					'en' => 'Settings',
                            'pt' => 'Definições'
        				],
        				'icon' => 'ti-settings',
        				'route' => '',
        				'items' => [
        					[
        						'name' => [
        							'es' => 'Básica',
        							'en' => 'Basic',
                                    'pt' => 'Basic'
        						],
								'route' => 'admin/settings/basic',
								'permissions' => [
									'settings.basic.view'
								]
        					],
                            // [
                            //     'name' => [
        					// 		'es' => 'Menú Lateral',
        					// 		'en' => 'Left Sidebar',
                            //         'pt' => 'Menu Lateral'
        					// 	],
                            //     'route' => 'admin/settings/left-sidebar'
                            // ],
                            // [
                            //     'name' => [
        					// 		'es' => 'Cabecera',
        					// 		'en' => 'Header',
                            //         'pt' => 'Cabeçalho'
        					// 	],
                            //     'route' => 'admin/settings/header'
                            // ],
                            [
                                'name' => [
        							'es' => 'Idiomás',
        							'en' => 'Languajes',
                                    'pt' => 'Idiomás'
        						],
                                'route' => 'admin/settings/languajes',
								'permissions' => [
									'languaje.view'
								]
                            ],
        					[
        						'name' => [
        							'es' => 'Traducciones',
        							'en' => 'Translations',
                                    'pt' => 'Traduções'
        						],
        						'route' => 'admin/settings/translations',
								'permissions' => [
									'translations.view'
								]
        					],
        				],
						'permissions' => [
							'settings.basic.view',
							'languaje.view',
							'translations.view'
						]
        			],
        			[
                        'name' => [
							'es' => 'Seguridad',
							'en' => 'Security',
                            'pt' => 'Segurança'
						],
                        'icon' => 'ti-lock',
                        'route' => 'admin/permissions',
		                'items' =>   [
							[
								'name' => [
								  'es' => 'Roles',
								  'en' => 'Roles',
								  'pt' => 'Função'
								],
								'route' => 'admin/roles',
								'permissions' => [
									'roles.view'
								]
							],
		                  	[
		                  		'name' => [
									'es' => 'Permisos',
									'en' => 'Permissions',
		                            'pt' => 'Autorizações'
								],
		                        'route' => 'admin/permissions',
								'permissions' => [
									'permissions.view'
								]
		                    ],
		                    [
		                        'name' => [
									'es' => 'Usuarios',
									'en' => 'Users',
		                            'pt' => 'Usuários'
								],
		                        'route' => 'admin/users',
								'permissions' => [
									'users.view'
								]
		                    ]
		                ],
						'permissions' => [
							'roles.view',
							'permissions.view',
							'users.view'
						]
                    ]
        		],
				'order' => 1000,
				'permissions' => [
					'settings.basic.view',
					'languaje.view',
					'translations.view',
					'roles.view',
					'permissions.view',
					'users.view'
				]
        	],
        ];

        leftSidebar()->make($sidebars);
    }
}
