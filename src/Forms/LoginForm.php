<?php

namespace Ro749\LoginTemplate\Forms;

use Ro749\SharedUtils\Forms\LoginForm as LoginFormBase;
use Ro749\SharedUtils\Forms\FormField;
use Ro749\SharedUtils\Forms\InputType;


class LoginForm extends LoginFormBase
{
    public function __construct()
    {
        parent::__construct(
            guard: config('login.guard'),
            submit_text: "Entrar",
            column_status: "status",
            redirect : config('login.redirect'),
            fields: [
                "name" => new FormField(
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
