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
            model_class: config('login.model'),
            fields: [
                'id'=>new FormField(
                    type: InputType::HIDDEN,
                ),
                'name'=>new FormField(
                    type: InputType::TEXT,
                    label: "Usuario",
                    placeholder: "Escriba el usuario",
                    rules: ["required"],
                    icon: "f7:person"
                ),
                'status'=>new Selector(
                    label:"Status",
                    options: Options::UserStatus,
                    rules: ["required"],
                ),
            ]
        );
    }

    public function after_process($model){
        if($model->status == UserStatus::Inactivo->value){
            DB::table('sessions')
            ->where('user_id', $model->id)
            ->delete();
        }
    }
}
