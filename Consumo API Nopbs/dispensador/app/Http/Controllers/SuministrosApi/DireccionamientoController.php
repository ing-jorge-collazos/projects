<?php

namespace App\Http\Controllers\SuministrosApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class DireccionamientoController extends Controller
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
        return view('menuApi.direccionamiento.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            //error_log($request->fecha);
            $session = Session::get('SESSION_API');
            $url = Config::get('site_vars.urlApi');
            $nit = $session['nit'];
            $validToken = $session['valid_token'];
            //$fecha = '2019-05-10'; 
            if ($request->filtro == 1) {
                $fecha = $request->fecha;
                $response = Http::get($url . 'DireccionamientoXFecha/' . $nit . '/' . $validToken . '/' . $fecha);
            } else if ($request->filtro == 2) {
                $noPrescripcion = $request->noPrescripcion;
                $response = Http::get($url . 'DireccionamientoXPrescripcion/' . $nit . '/' . $validToken . '/' . $noPrescripcion);
            } else if ($request->filtro == 3) {
                $fecha = $request->fecha;
                $tipoDoc = $request->tipoDoc;
                $numDoc = $request->numDoc;
                $response = Http::get($url . 'DireccionamientoXPacienteFecha/' . $nit . '/' . $fecha . '/' . $validToken . '/' . $tipoDoc . '/' . $numDoc);
            }
            
            //$response = Http::get($url . 'DireccionamientoXFecha/' . $nit . '/' . $validToken . '/' . '2019-05-10');            
            return datatables()::of(json_decode($response,true))->make(true);
        }
    }
}
