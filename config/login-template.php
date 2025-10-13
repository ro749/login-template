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
        ],
        'forms'=>[
            'LoginForm'=>\Ro749\LoginTemplate\Forms\LoginForm::class,
            'EditUser'=>\Ro749\LoginTemplate\Forms\EditUser::class,
            'RegisterUser'=>\Ro749\LoginTemplate\Forms\RegisterUser::class,
            'ResetPassword'=>\Ro749\LoginTemplate\Forms\ResetPassword::class,
        ],
        'tables'=>[
            'Users'=>\Ro749\LoginTemplate\Tables\Users::class,
        ],
        'controllers'=>[
            'LoginController'=>\Ro749\LoginTemplate\Controllers\LoginController::class,
        ]
    ]
];
