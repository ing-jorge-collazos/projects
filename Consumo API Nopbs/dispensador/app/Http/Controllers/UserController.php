<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $session = Session::get('SESSION_API');
        $nit = $session['nit'];
        $id = auth()->user()->id;
        $resumen = DB::table('process_log')
            ->select('process_type', DB::raw('count(process_type) count'))
            ->where(['user_id' => $id, 'nit' => $nit])
            ->where('status', '<>', NULL)
            ->groupBy('process_type')
            ->get();
        return view('session/user')->with('resumen', $resumen);
    }
}
