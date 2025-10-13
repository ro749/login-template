<?php

namespace Ro749\LoginTemplate\Forms;

use Ro749\SharedUtils\Forms\BaseForm;
use Ro749\SharedUtils\Forms\FormField;
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
            table: config('overrides.login.table'),
            submit_text: 'Registrar',
            success_msg: 'Vendedor registrado exitosamente. La contraseña default es 123456.',
            fields: [
                'name'=>new FormField(
                    type: InputType::TEXT,
                    label: "Nombre",
                    placeholder: "Escriba el nombre",
                    rules: ["required"],
                    icon: "f7:person"
                ),
                'mail'=>new FormField(
                    type: InputType::EMAIL,
                    label:"Email",
                    placeholder:"Escriba el email",
                    rules: ["required"],
                    icon: "mage:email"
                ),
                'phone'=>new FormField(
                    type: InputType::PHONE,
                    label:"Teléfono",
                    placeholder:"Escriba el teléfono",
                    rules: ["unique","required"],
                    icon: "solar:phone-calling-linear"
                ),
                'username'=>new FormField(
                    type: InputType::TEXT,
                    label:"Nombre de usuario",
                    placeholder:"Escriba el nombre de usuario",
                    rules: ["unique","required"],
                    icon: Icon::USER->value
                ),
            ]
        );
    }

    public function before_process(array &$data)
    {
        $data['reset'] = 1;
    }
}
