<?php

namespace Ro749\LoginTemplate\Forms;

use Ro749\SharedUtils\Forms\BaseForm;
use Ro749\SharedUtils\Forms\Field;
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
            redirect : config('login.redirect'),
            db_id: Auth::guard(config('login.guard'))->user()->id,
            fields: [
                "password" => new Field(
                    placeholder:"Nueva contraseña",
                    type: InputType::PIN,
                    icon: "bx bx-lock-alt",
                    max: 4,
                ),
                "password_confirmation" => new Field(
                    placeholder:"Confirmar contraseña",
                    type: InputType::PIN,
                    icon: "bx bx-lock-alt",
                    max: 4,
                ),
            ]
        );
    }

    public function before_process(array &$data)
    {
        $data['reset'] = 0;
    }
}
