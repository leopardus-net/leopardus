<?php

use Illuminate\Database\Seeder;

class PermissionsRolesSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Web Master', 'route' => '/admin'],
            ['name' => 'Administrator', 'route' => '/admin'],
        ];

        foreach($roles as $role) {
            roles()->create($role);
        }        

        $permisos = [
            [
                'group' => [
                    'en' => 'Dashboard',
                    'es' => 'Tablero',
                ],
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Widget Order',
                            'es' => 'Ordenar Widget',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Widget Add',
                            'es' => 'Agregar Widget',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Widget Delete',
                            'es' => 'Eliminar Widget',
                        ]
                    ],
                ]
            ],
            [
                'group' => [
                    'en' => 'Settings Basic',
                    'es' => 'Configuraciones Basicas',
                ],
                'slug' => 'settings.basic',
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Update',
                            'es' => 'Modificar',
                        ]
                    ],
                ]
            ],
            [
                'group' => [
                    'en' => 'Languaje',
                    'es' => 'Lenguajes',
                ],
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Store',
                            'es' => 'Guardar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Update',
                            'es' => 'Modificar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Delete',
                            'es' => 'Eliminar',
                        ]
                    ],
                ]
            ],
            [
                'group' => [
                    'en' => 'Translations',
                    'es' => 'Traducciones'
                ],
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Groups',
                            'es' => 'Grupos',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Groups Store',
                            'es' => 'Crear Grupo',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Groups Update',
                            'es' => 'Modificar Grupo',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Groups Delete',
                            'es' => 'Eliminar Grupo',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Key Store',
                            'es' => 'Agregar Llave',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Key Update',
                            'es' => 'Modificar Llave',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Key Delete',
                            'es' => 'Eliminar Llave',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Import',
                            'es' => 'Importar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Export',
                            'es' => 'Exportar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Publish',
                            'es' => 'Publicar',
                        ]
                    ],
                ]
            ],
            [
                'group' => [
                    'en' => 'Roles',
                    'es' => 'Roles',
                ],
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Store',
                            'es' => 'Guardar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Update',
                            'es' => 'Modificar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Delete',
                            'es' => 'Eliminar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Assing Permission',
                            'es' => 'Asignar permiso',
                        ]
                    ],
                ]
            ],
            [
                'group' => [
                    'en' => 'Permissions',
                    'es' => 'Permisos',
                ],
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Store',
                            'es' => 'Guardar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Update',
                            'es' => 'Modificar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Delete',
                            'es' => 'Eliminar',
                        ]
                    ],
                ]
            ],
            [
                'group' => [
                    'en' => 'Users',
                    'es' => 'Usuarios',
                ],
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Store',
                            'es' => 'Guardar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Update',
                            'es' => 'Modificar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Delete',
                            'es' => 'Eliminar',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Details',
                            'es' => 'Detalles',
                        ]
                    ],
                ]
            ],
            [
                'group' => [
                    'en' => 'Profile',
                    'es' => 'Perfil',
                ],
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                ]
            ],
            [
                'group' => [
                    'en' => 'Account',
                    'es' => 'Cuenta',
                ],
                'items' => [
                    [
                        'name' => [
                            'en' => 'View',
                            'es' => 'Ver',
                        ]
                    ],
                    [
                        'name' => [
                            'en' => 'Update',
                            'es' => 'Modificar',
                        ]
                    ],
                ]
            ],
        ];

        foreach ($permisos as $data) {
            $slug = array_key_exists('slug', $data) ? $data['slug'] : null;

            $perm = permissions()
                ->addGroup($data['group'], $slug)
                ->make($data['items']);
        }
    }
}
