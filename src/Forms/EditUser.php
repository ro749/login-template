<?php

namespace Ro749\LoginTemplate\Forms;

use Ro749\SharedUtils\Forms\BaseForm;
use Ro749\SharedUtils\Forms\FormField;
use Ro749\SharedUtils\Forms\InputType;
use Ro749\SharedUtils\Forms\Selector;
use Ro749\LoginTemplate\Enums\Options;
use Illuminate\Support\Facades\DB;
use Ro749\LoginTemplate\Enums\UserStatus;
class EditUser extends BaseForm
{
    public function __construct()
    {
        parent::__construct(
            table: config('overrides.login.table'),
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
                    label:"Usuario",
                    placeholder:"Escriba el usuario",
                    rules: ["unique","required"],
                    icon: "solar:phone-calling-linear"
                ),
                'status'=>new Selector(
                    label:"Status",
                    options: Options::UserStatus,
                    rules: ["required"],
                ),
            ]
        );
    }

    public function after_process(int $id){
        $asesor = DB::table($this->table)->where('id', $id)->first();
        if($asesor->status == UserStatus::Inactivo->value){
            DB::table('sessions')
            ->where('user_id', $id)
            ->delete();
        }
    }
}
