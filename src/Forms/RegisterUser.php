<?php

namespace Ro749\LoginTemplate\Forms;

use Ro749\SharedUtils\Forms\BaseForm;
use Ro749\SharedUtils\Forms\Field;
use Ro749\SharedUtils\Forms\InputType;
use Ro749\SharedUtils\Forms\Selector;
use Ro749\SharedUtils\Enums\Icon;
use Ro749\LoginTemplate\Enums\Options;
use Ro749\LoginTemplate\Models\Asesor;


class RegisterUser extends BaseForm
{
    public function __construct()
    {
        parent::__construct(
            model_class: config('login.model'),
            submit_text: 'Registrar',
            success_msg: 'Usuario registrado exitosamente. La contraseña default es 123456.',
            fields: [
                'name'=>new Field(
                    type: InputType::TEXT,
                    label: "Usuario",
                    placeholder: "Escriba el usuario",
                    required: true,
                    icon: "f7:person"
                ),
            ]
        );
    }

    public function before_process(array &$data)
    {
        $data['reset'] = 1;
    }
}
