<?php

// config for Ro749/LoginTemplate
return [
    "options" => [
        "AsesorStatus"=> [
            "Activo",
            "Inactivo"
        ]
    ],
    'overrides'=>[
        'login'=>[
            'guard'=>'web',
            'admin_guard'=>'web',
            'table'=>'users',
            'default_password'=>'123456',
            'redirect'=>'/',
        ]
    ]
];
