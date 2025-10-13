<?php

namespace Ro749\LoginTemplate\Tables;
use Ro749\SharedUtils\Getters\ArrayGetter;
use Ro749\SharedUtils\Tables\BaseTable;
use Ro749\SharedUtils\Tables\Column;
use Ro749\SharedUtils\Models\LogicModifiers\Options;
use Ro749\SharedUtils\Tables\TableButtonAjax;
use Ro749\SharedUtils\Enums\Icon;
use Ro749\LoginTemplate\Enums\Options as OptionsEnum;
use Ro749\LoginTemplate\Forms\EditUser;
class Users extends BaseTable
{
    public function __construct(){
        parent::__construct(
            getter: new ArrayGetter(
                table: config('overrides.login.table'),
                columns : [
                    'name'=>new Column(
                        display:"Nombre",
                    ),
                    'email'=>new Column(
                        display:"Email",
                    ),
                    'status'=>new Column(
                        display:"Status",
                        logic_modifier: new Options(options: OptionsEnum::UserStatus),
                    ),
                ],
            ),
            form: EditUser::instanciate(),
            buttons: [
                new TableButtonAjax(
                    icon: Icon::RESTART,
                    button_class: "reset-btn",
                    background_color_class:"btn-primary-600",
                    text_color_class: "",
                    url: route("reset-password"),
                    warning: "Quieres restablecer la contraseña de {name}?",
                    success: "La contraseña provicional para {name} es 0000.",
                    reload: false
                )
            ]
        );
    }
}