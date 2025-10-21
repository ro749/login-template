<?php

namespace Ro749\LoginTemplate\Forms;

use Ro749\SharedUtils\Forms\BaseForm;
use Ro749\SharedUtils\Forms\FormField;
use Ro749\SharedUtils\Forms\InputType;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
class ResetPassword extends BaseForm
{
    public function __construct()
    {
        parent::__construct(
            model_class: config('login.model'),
            submit_text: 'Confirmar',
            db_id: Auth::guard(config('login.guard'))->user()->id,
            redirect : config('login.redirect'),
            fields: [
                "password" => new FormField(
                    placeholder:"Nueva contraseña",
                    type: InputType::PASSWORD,
                    icon: "bx bx-lock-alt",
                ),
                "confirm_password" => new FormField(
                    placeholder:"Confirmar contraseña",
                    type: InputType::PASSWORD,
                    icon: "bx bx-lock-alt",
                ),
            ]
        );
    }

    public function before_process(array &$data)
    {
        if($data['password'] !== $data['confirm_password']){
            throw ValidationException::withMessages([
                'confirm_password' => ['Las contraseñas no coinciden.'],
            ]);
        }
        unset($data['confirm_password']);
        $data['reset'] = 0;
    }
}
