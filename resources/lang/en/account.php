<?php

return [
    'form' => [
        'name' => 'Nombre completo',
        'email' => 'Correo electronico',
        'biography' => 'Biografía',
        'phone' => 'Número telefonico',
        'birthday' => 'Fecha de nacimiento',
        'country' => 'País',
        'province' => 'Estado',
        'city' => 'Ciudad',
        'address' => 'Dirección',
        'postal_code' => 'Codigo postal',
        'submit' => 'Guardar información'
    ],
    'security' => [
        'form' => [
            'old_password' => 'Contraseña anterior',
            'new_password' => 'Nueva contraseña',
            'repeat_password' => 'Confirmar contraseña',
            'submit' => 'Cambiar contraseña'
        ],
        'errors' => [
            'password-fail' => 'La contraseña anterior es incorrecta'
        ]
    ],
    'alerts' => [
        'updated' => 'Perfil modificado existosamente',
        'updated-pass' => 'Contraseña modificada exitosamente'
    ]
];