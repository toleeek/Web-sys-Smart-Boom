<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     *
     */
    protected function authenticated(Request $request, $user) {
        $route = 'user.index';
        $message = 'Ви успішно ввійшли в особистий кабінет';
        if ($user->admin) {
            $route = 'admin.index';
            $message = 'Ви успішно ввійшли в панель управління';
        }
        return redirect()->route($route)
            ->with('success', $message);
    }


    protected function loggedOut(Request $request) {
        return redirect()->route('user.login')
            ->with('success', 'Ви успішно вийшли із особистого кабінета');
    }
}
