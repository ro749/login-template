<?php

namespace Ro749\LoginTemplate\Forms;

use Ro749\SharedUtils\Forms\BaseForm;
use Ro749\SharedUtils\Forms\Field;
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
                'name'=>new Field(
                    type: InputType::TEXT,
                    label: "Usuario",
                    placeholder: "Escriba el usuario",
                ),
                'status'=>new Selector(
                    label:"Status",
                    options: Options::UserStatus,
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
