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
	    				'items' => []
        			]
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
        						'route' => 'admin/settings/basic'
        					],
                            [
                                'name' => [
        							'es' => 'Menú Lateral',
        							'en' => 'Left Sidebar',
                                    'pt' => 'Menu Lateral'
        						],
                                'route' => 'admin/settings/left-sidebar'
                            ],
                            [
                                'name' => [
        							'es' => 'Cabecera',
        							'en' => 'Header',
                                    'pt' => 'Cabeçalho'
        						],
                                'route' => 'admin/settings/header'
                            ],
                            [
                                'name' => [
        							'es' => 'Idiomás',
        							'en' => 'Languajes',
                                    'pt' => 'Idiomás'
        						],
                                'route' => 'admin/settings/languajes'
                            ],
        					[
        						'name' => [
        							'es' => 'Traducciones',
        							'en' => 'Translations',
                                    'pt' => 'Traduções'
        						],
        						'route' => 'admin/settings/translations'
        					],
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
								'route' => 'admin/roles'
							],
		                  	[
		                  		'name' => [
									'es' => 'Permisos',
									'en' => 'Permissions',
		                            'pt' => 'Autorizações'
								],
		                        'route' => 'admin/permissions'
		                    ],
		                    [
		                        'name' => [
									'es' => 'Usuarios',
									'en' => 'Users',
		                            'pt' => 'Usuários'
								],
		                        'route' => 'admin/users'
		                    ]
		                ]
                    ]
        		],
                'order' => 1000
        	],
        ];

        leftSidebar()->make($sidebars);
    }
}
