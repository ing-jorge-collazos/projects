<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\AuthFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
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
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function login(AuthFormRequest $request)
    {
        $active_user = User::where(['nit' => $request->nit, 'active' => '1'])->first();
        if ($active_user != null) {
            $ldate = date('Y-m-d H:i:s');
            $license = User::where([['nit', '=', $request->nit], ['end_date', '>=', $ldate]])
                ->orWhere([['nit', '=', $request->nit], ['end_date', '=', null]])->first();
            if ($license != null) {
                if (Auth::attempt(['nit' => $request->nit, 'password' => $request->token])) {
                    if ($active_user->type_user == '2') {
                        $url = Config::get('site_vars.urlApi');
                        $validToken = Http::get($url . 'GenerarToken/' . $request->nit . '/' . $request->token)->json();
                        if (is_array($validToken)) {
                            //"error": "no response from server"
                            return back()
                                ->withErrors([
                                    'validate' => 'El servicio de Sumunistro API no se encuentra disponible',
                                    'message' => $validToken['Message']
                                ])
                                ->withInput(request(['nit']));
                        } else {
                            Session::put(
                                'SESSION_API',
                                [
                                    "nit" => $request->nit,
                                    "valid_token" => $validToken,
                                    "object" => ''
                                ]
                            );
                            $update = User::where('nit', '=', $request->nit)->first();
                            $update->valid_token = $validToken;
                            $update->save();
                            return redirect()->route('home');
                        }
                    } else {
                        return redirect()->route('admin');
                    }
                } else {
                    return back()
                        ->withErrors(['validate' => 'Verifique su información'])
                        ->withInput(request(['nit']));
                }
            } else {
                return back()
                    ->withErrors(['validate' => 'La licencia de la empresa ha caducado'])
                    ->withInput(request(['nit']));
            }
        } else {
            return back()
                ->withErrors(['validate' => 'La empresa no cuenta con un servicio asignado'])
                ->withInput(request(['nit']));
        }
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'nit';
    }
}
