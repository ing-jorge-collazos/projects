<?php

namespace App\Http\Controllers\SuministrosApi;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProgramacionController extends Controller
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
        return view('menuApi.programacion.index');
    }

    public function indexForm(Request $request)
    {
        error_log($request);
        return view('menuApi.programacion.create')->render();
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $session = Session::get('SESSION_API');
            $url = Config::get('site_vars.urlApi');
            $nit = $session['nit'];
            $validToken = $session['valid_token'];
            //$fecha = '2019-05-10';            

            if ($request->filtro == 1) {
                $fecha = $request->fecha;
                $response = Http::get($url . 'ProgramacionXFecha/' . $nit . '/' . $validToken . '/' . $fecha);
            } else if ($request->filtro == 2) {
                $noPrescripcion = $request->noPrescripcion;
                $response = Http::get($url . 'ProgramacionXPrescripcion/' . $nit . '/' . $validToken . '/' . $noPrescripcion);
            } else if ($request->filtro == 3) {
                $fecha = $request->fecha;
                $tipoDoc = $request->tipoDoc;
                $numDoc = $request->numDoc;
                $response = Http::get($url . 'ProgramacionXPacienteFecha/' . $nit . '/' . $fecha . '/' . $validToken . '/' . $tipoDoc . '/' . $numDoc);
            }

            return datatables()::of(json_decode($response, true))->make(true);
        }
    }

    public function reportarProgramacion(Request $request)
    {
        if ($request->ajax()) {
            $session = Session::get('SESSION_API');
            $url = Config::get('site_vars.urlApi');
            $nit = $session['nit'];
            $validToken = $session['valid_token'];
            //$fecha = '2019-05-10';            
            $data = [
                'ID' => $request->IdDireccionamiento,
                'FecMaxEnt' => $request->FechaMax,
                'TipoIDSedeProv' => "NI",
                'NoIDSedeProv' => $request->NodDocProv,
                'CodSedeProv' => Config::get('site_vars.codSedeIPS'),
                'CodSerTecAEntregar' => $request->CodServTec,
                'CantTotAEntregar' => $request->CantidadTotalEntregar
            ];
            /*error_log(auth()->user()->id);
            error_log(json_encode($data));*/

            //DB::table('process_log')->insert($array);
            /*$response = json_decode('{"Message":"La solicitud no es válida",
                                     "ModelState":{
                                            "entrega.CodTecEntregado":[
                                                "El campo CodTecEntregado es obligatorio"
                                            ]
                                        }         ,
                                        "Errors":["La entrega ya se encuentra anulada","La entrega ya se encuentra anulada 1"]                               
                                    }');
            $response1 = json_decode('[
                                        {"Mensaje":"Anulación existosa ID: 14"}
                                    ]');
            $response2 = json_decode('{"Message":"La solicitud no es válida",
                                        "Errors":["La entrega ya se encuentra anulada"]
                                       }');
            error_log(gettype($response));*/

            $ldate = date('Y-m-d');
            if ($ldate >= $request->FecDireccionamiento && $request->FechaMax >= $ldate) {
                $response = Http::put($url . 'Programacion/' . $nit . '/' . $validToken, $data);
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
                        [auth()->user()->id, $nit, 'Programación', 'Programar Direccionamiento', null, 
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
                        [auth()->user()->id, $nit, 'Programación', 'Programar Direccionamiento', null, 
                        'Error',json_encode($response),null, Carbon::now(), Carbon::now()]
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
                        [auth()->user()->id, $nit, 'Programación', 'Direccionamiento Programado', json_encode($data), 
                        'Success',json_encode($response),'Programado', Carbon::now(), Carbon::now()]
                    );                    
                    return with([
                        'validate' => 1,
                        'message' => "La programación se realizó correctamente.",
                        //'error' => $errors
                    ]);
                }
            } else {   
                return with([
                    'validate' => 0,
                    'message' => 'No es posible procesar la petición',
                    'error' => 'La fecha máxima de entrega ha sido superada.'
                ]);
            }
        }
    }

    public function anularProgramacion(Request $request)
    {
        if ($request->ajax()) {
            $session = Session::get('SESSION_API');
            $url = Config::get('site_vars.urlApi');
            $nit = $session['nit'];
            $validToken = $session['valid_token'];

            $response = Http::put($url . 'AnularProgramacion/' . $nit . '/' . $validToken . '/' . $request->ID);
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
                    [auth()->user()->id, $nit, 'Programación', 'Programar Direccionamiento', null, 
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
                    [auth()->user()->id, $nit, 'Programación', 'Programar Direccionamiento', null, 
                    'Error',json_encode($response),null, Carbon::now(), Carbon::now()]
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
                    [auth()->user()->id, $nit, 'Programación', 'Direccionamiento Programado', json_encode(['IDDireccionamiento'=>$request->ID]), 
                    'Success',json_encode($response),'Anulado', Carbon::now(), Carbon::now()]
                );
                return with([
                    'validate' => 1,
                    'message' => "La programación se anuló correctamente."
                ]);
            }
        }
    }
}
