<?php

namespace App\Http\Controllers\SuministrosApi;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class EntregaController extends Controller
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
        return view('menuApi.entrega.index');
    }

    public function indexForm()
    {
        return view('menuApi.entrega.create');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            error_log($request->fecha);
            $session = Session::get('SESSION_API');
            $url = Config::get('site_vars.urlApi');
            $nit = $session['nit'];
            $validToken = $session['valid_token'];
            //$fecha = '2019-05-10';            

            if ($request->filtro == 1) {
                $fecha = $request->fecha;
                $response = Http::get($url . 'EntregaXFecha/' . $nit . '/' . $validToken . '/' . $fecha);
            } else if ($request->filtro == 2) {
                $noPrescripcion = $request->noPrescripcion;
                $response = Http::get($url . 'EntregaXPrescripcion/' . $nit . '/' . $validToken . '/' . $noPrescripcion);
            } else if ($request->filtro == 3) {
                $fecha = $request->fecha;
                $tipoDoc = $request->tipoDoc;
                $numDoc = $request->numDoc;
                $response = Http::get($url . 'EntregaXPacienteFecha/' . $nit . '/' . $fecha . '/' . $validToken . '/' . $tipoDoc . '/' . $numDoc);
            }
            return datatables()::of(json_decode($response, true))->make(true);
        }
    }

    public function anularEntrega(Request $request)
    {
        if ($request->ajax()) {

            $session = Session::get('SESSION_API');
            $url = Config::get('site_vars.urlApi');
            $nit = $session['nit'];
            $validToken = $session['valid_token'];
            //$fecha = '2019-05-10';            

            $response = Http::put($url . 'AnularEntrega/' . $nit . '/' . $validToken . '/' . $request->ID);
            if (isset($response['Errors'])) {
                if (count($response['Errors']) > 0) {
                    if (count($response['Errors']) > 1) {
                        $errors = '<ul>';
                        foreach ($response['Errors'] as $error)
                            $errors .= '<li>' . $error . '</li>';
                        $errors .= '</ul>';
                        $message = $response['Message'];;
                    } else {
                        $errors = $response['Errors'][0];
                        $message = $response['Message'];
                    }
                } else {
                    $message = 'No es posible realizar la petición';
                    $errors = 'Verifique la información ingresada.';
                }
                DB::insert(
                    'insert into process_log(user_id, nit, process_type, description, content_process, response_type, response_process, status, created_at, updated_at) 
                    values(?,?,?,?,?,?,?,?,?,?)',
                    [auth()->user()->id, $nit, 'Entrega', 'Entregar Programación', null, 
                    'Error',json_encode($response),null, Carbon::now(), Carbon::now()]
                );
                return with([
                    'validate' => 0,
                    'message' => $message,
                    'error' => $errors
                ]);
            } else if (isset($response['ModelState'])) {
                $ModelState = $response['ModelState'];
                foreach($ModelState as $key=>$val)                    
                    $errors =  explode(".",$key)[1].": ".$val[0];

                DB::insert(
                    'insert into process_log(user_id, nit, process_type, description, content_process, response_type, response_process, status, created_at, updated_at) 
                    values(?,?,?,?,?,?,?,?,?,?)',
                    [auth()->user()->id, $nit, 'Entrega', 'Entregar Programación', null, 
                    'Error',json_encode($response),null, Carbon::now(), Carbon::now()]
                );
                return with([
                    'validate' => 0,
                    'message' => $response['Message'],
                    'error' => $errors
                ]);
            }else {
                DB::insert(
                    'insert into process_log(user_id, nit, process_type, description, content_process, response_type, response_process, status, created_at, updated_at) 
                    values(?,?,?,?,?,?,?,?,?,?)',
                    [auth()->user()->id, $nit, 'Entrega', 'Entregada Anulada', json_encode(['IDEntrega' => $request->ID]), 
                    'Success',json_encode($response),'Anulado', Carbon::now(), Carbon::now()]
                );

                return with([
                    'validate' => 1,
                    'message' => "La entrega se anuló correctamente."
                ]);
            }
        }
    }

    public function reportarEntrega(Request $request)
    {
        //error_log($request);
        //error_log($request->CantTotEntrega);

        if ($request->ajax()) {

            $session = Session::get('SESSION_API');
            $url = Config::get('site_vars.urlApi');
            $nit = $session['nit'];
            $validToken = $session['valid_token'];
            /*if($request->Form == 1){
                $data = [
                    'ID' => $request->ID,
                    'CodSerTecEntregado' => $request->CodSerTecEntregado,
                    'CantTotEntregada' => $request->CantTotEntregada,
                    'EntTotal' => $request->EntTotal,
                    'CausaNoEntrega' => $request->CausaNoEntrega,
                    'FecEntrega' => $request->FecEntrega,
                    'NoLote' => $request->NoLote,
                    'TipoIDRecibe' => $request->TipoIDRecibe,
                    'NoIDRecibe' => $request->NoIDRecibe
                ];
                $response = Http::put($url . 'Entrega/' . $nit . '/' . $validToken, $data); 
            }
            else if($request->Form == 2){
                $data = [
                    'ID' => $request->ID,
                    'CodSerTecEntregado' => $request->CodSerTecEntregado,
                    'CantTotEntregada' => $request->CantTotEntregada,
                    'FecEntrega' => $request->FechaEntregaC                 
                ];
                $response = Http::put($url . 'EntregaCodigos/' . $nit . '/' . $validToken, $data); 
            } 
            else if($request->Form == 3){
                $data = [
                     'NoPrescripcion' => $request->NoPrescripcion,
                     'TipoTec' => $request->TipoTec,
                     'ConTec' => $request->ConTec,
                     'TipoIDPaciente' => $request->TipoIDPaciente,
                     'NoIDPaciente' => $request->NoIDPaciente,
                     'NoEntrega' => $request->NoEntrega,
                     'CodSerTecEntregado' => $request->CodSerTecEntregado,
                     'CantTotEntregada' => $request->CantTotEntregada,
                     'EntTotal' => $request->EntTotal,
                     'CausaNoEntrega' => $request->CausaNoEntrega,
                     'FecEntrega' => $request->FecEntrega,
                     'NoLote' => $request->NoLote   
                ];
                $response = Http::put($url . 'EntregaCodigos/' . $nit . '/' . $validToken, $data); 
            }*/

            //error_log(gettype(($response)));
            $data = [
                'ID' => $request->Identificador,
                'CodSerTecEntregado' => $request->CodServTec,
                'CantTotEntregada' => $request->CantTotEntrega,
                'EntTotal' => $request->EntregaTotal,
                'CausaNoEntrega' => $request->CausaNoEntrega,
                'FecEntrega' => $request->FechaEntrega,
                'NoLote' => $request->LoteEntregado,
                'TipoIDRecibe' => $request->TipoIDRecibe,
                'NoIDRecibe' => $request->NoIDRecibe
            ];
            $response = Http::put($url . 'Entrega/' . $nit . '/' . $validToken, $data);            
            if (isset($response['Errors'])) {
                if (count($response['Errors']) > 0) {
                    if (count($response['Errors']) > 1) {
                        $errors = '<ul>';
                        foreach ($response['Errors'] as $error)
                            $errors .= '<li>' . $error . '</li>';
                        $errors .= '</ul>';
                        $message = $response['Message'];;
                    } else {
                        $errors = $response['Errors'][0];
                        $message = $response['Message'];
                    }
                } else {
                    $message = 'No es posible realizar la petición';
                    $errors = 'Verifique la información ingresada.';
                }

                DB::insert(
                    'insert into process_log(user_id, nit, process_type, description, content_process, response_type, response_process, status, created_at, updated_at) 
                    values(?,?,?,?,?,?,?,?,?,?)',
                    [auth()->user()->id, $nit, 'Entrega', 'Entregar Programación', null, 
                    'Error',$response,null, Carbon::now(), Carbon::now()]
                );
                return with([
                    'validate' => 0,
                    'message' => $message,
                    'error' => $errors
                ]);
            } else if (isset($response['ModelState'])) {
                $ModelState = $response['ModelState'];
                foreach($ModelState as $key=>$val)                    
                    $errors =  explode(".",$key)[1].": ".$val[0];
                
                
                DB::insert(
                    'insert into process_log(user_id, nit, process_type, description, content_process, response_type, response_process, status, created_at, updated_at) 
                    values(?,?,?,?,?,?,?,?,?,?)',
                    [auth()->user()->id, $nit, 'Entrega', 'Entregar Programación', null, 
                    'Error',$response,null, Carbon::now(), Carbon::now()]
                );
                return with([
                    'validate' => 0,
                    'message' => $response['Message'],
                    'error' => $errors
                ]);
            } else {
                DB::insert(
                    'insert into process_log(user_id, nit, process_type, description, content_process, response_type, response_process, status, created_at, updated_at) 
                    values(?,?,?,?,?,?,?,?,?,?)',
                    [auth()->user()->id, $nit, 'Entrega', 'Entregada', json_encode($data), 
                    'Success',json_encode($response),'Entregada', Carbon::now(), Carbon::now()]
                );
                
                return with([
                    'validate' => 1,
                    'message' => "La entrega se realizó correctamente.",
                    //'error' => $errors
                ]);
            }
        }
        //return with('response', json_decode($request, true));
    }
}
