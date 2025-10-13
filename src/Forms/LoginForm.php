<?php

namespace Ro749\LoginTemplate\Forms;

use Ro7409\SharedUtils\Forms\LoginForm as LoginFormBase;
use Ro749\SharedUtils\Forms\FormField;
use Ro749\SharedUtils\Forms\InputType;

use Ro749\LoginTemplate\Models\User;
use Ro749\LoginTemplate\Models\Client;

class LoginForm extends LoginFormBase
{
    public function __construct()
    {
        parent::__construct(
            table: config('overrides.login.table'),
            submit_text: "Entrar",
            column_status: "status",
            redirect : config('overrides.login.redirect'),
            fields: [
                "user" => new FormField(
                    type: InputType::TEXT,
                    placeholder:"Usuario", 
                    icon: "bx bx-user"
                ),
                "password" => new FormField(
                    placeholder:"Contraseña",
                    type: InputType::PASSWORD,
                    icon: "bx bx-lock-alt"
                ),
            ],
        );
    }
}
