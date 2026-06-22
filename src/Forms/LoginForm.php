<?php

namespace Ro749\LoginTemplate\Forms;

use Ro749\SharedUtils\Forms\LoginForm as LoginFormBase;
use Ro749\SharedUtils\Forms\Field;
use Ro749\SharedUtils\Forms\InputType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;

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
                "name" => new Field(
                    type: InputType::TEXT,
                    placeholder:"Usuario", 
                    icon: "bx bx-user"
                ),
                "password" => new Field(
                    placeholder:"Contraseña",
                    type: InputType::PASSWORD,
                    icon: "bx bx-lock-alt"
                ),
            ],
        );
    }

    public function prosses(Request $request): string
    {
        if($this->blocked){
            throw ValidationException::withMessages([
                'password' => ['Acceso bloqueado, contacte al administrador.'],
            ]);
        }
        $credentials = $request->validate($this->rules($request));
        $user = array_values($credentials)[0];
        $key = "login-attempts:".$this->guard.$user;
        if (RateLimiter::tooManyAttempts($key, 6)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'password' => ['Demasiados intentos de inicio de sesión. Inténtalo en ' . $seconds . ' segundos.'],
            ]);
        }
        if ($this->plain_password) {
            $credentials['password'] = $user;
        }
        else{
            if (!Auth::guard($this->guard)->attempt($credentials)) {
                $this->incorrect_credentials($key);
            }
        }
        if($this->column_status != ''){
            if(!empty(Auth::guard($this->guard)->user()->{$this->column_status})){
                Auth::guard($this->guard)->logout();
                throw ValidationException::withMessages([
                    'password' => ['Usuario bloqueado.'],
                ]);
            }
        }
        if(Auth::guard($this->guard)->user()->reset == '1'){
            return route('reset-password-view');
        }
        RateLimiter::clear($key);
        $request->session()->regenerate();
        Auth::guard($this->guard)->user()->update(['last_session_register' => now()]);
        return $this->redirect;
    }
}
