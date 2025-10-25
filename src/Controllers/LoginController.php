<?php

namespace Ro749\LoginTemplate\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Ro749\SharedUtils\Controllers\Controller;
use Ro749\LoginTemplate\Forms\LoginForm;
use Ro749\LoginTemplate\Forms\ResetPassword;
use Ro749\LoginTemplate\Forms\RegisterUser;
use Ro749\LoginTemplate\Tables\Users;

class LoginController extends Controller
{
    public function index() {
        $form = LoginForm::instanciate();
        return view('simple-login', ['form'=>$form]);
    }

    public function reset_password(){
        $asesor =  Auth::guard(config('login.guard'))->user();
        return view('reset-password', [
            'name'=>$asesor->name,
            'form'=>ResetPassword::instanciate(),
        ]);
    }

    public function reset_password_admin(Request $request){
        DB::table(config('login.table'))
        ->where('id', $request->input('id'))
        ->update(values: ['reset' => true,'password' => bcrypt(config('login.default_password'))]);
    }

    public function register_user() {
        $form = RegisterUser::instanciate();
        return view('register-asesor', ['form'=>$form]);
    }

    public function users() {
        $table = Users::instance();
        return view('simple-table', ['table'=>$table]);
    }
}
