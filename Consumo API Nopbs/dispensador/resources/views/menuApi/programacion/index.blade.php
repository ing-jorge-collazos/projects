@extends('adminlte::page')

@section('title', 'Suministro API')

@section('content_header')
<h1 class="header-title">Programación</h1>
<hr>
@stop

@section('content')
<form>
    {{ csrf_field() }}
    <div class="row">
        <div class='col-sm-4'>
            <div class="form-group">
                <label for="sel1">Filtro:</label>
                <select class="form-control" aria-label="Default select example" name="filtro" id="filtro">
                    <option value="0" selected disabled>Seleccione opción</option>
                    <option value="1">Fecha</option>
                    <option value="2">Número de Prescripción</option>
                    <option value="3">Detalles Programación</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row" id="fecha" style="display:none">
        <div class='col-sm-4'>
            <div class="form-group">
                <label for="sel1">Fecha:</label>
                <input type='date' class="form-control" name="fechaF1" id="fechaF1" />
            </div>
        </div>
    </div>
    <div class="row" id="prescripcion" style="display:none">
        <div class='col-sm-4'>
            <div class="form-group">
                <label for="sel1">Número de Prescripción:</label>
                <input type='text' class="form-control" name="noPrescripcion" id="noPrescripcion" />
            </div>
        </div>
    </div>
    <div class="row" id="detalle" style="display:none">
        <div class='col-sm-4'>
            <div class="form-group">
                <label for="sel1">Fecha:</label>
                <input type='date' class="form-control" name="fechaF2" id="fechaF2" />
            </div>
        </div>
        <div class='col-sm-4'>
            <div class="form-group">
                <label for="sel1">Tipo de documento:</label>
                <div class="form-group">
                    <select class="form-control input-lg" id="tipoDoc">
                        <option selected disabled>Seleccione opción</option>
                        <option value="CC">Cédula de Ciudadanía</option>
                        <option value="RC">Registro Civil</option>
                        <option value="TI">Tarjeta de Identidad</option>
                        <option value="CE">Cedula de Extranjería</option>
                        <option value="PA">Pasaporte</option>
                        <option value="NV">Nacido Vivo</option>
                        <option value="CD">Carné Diplomático</option>
                        <option value="SC">Salvoconducto de Permanencia</option>
                        <option value="PR">Pasaporte de la ONU</option>
                        <option value="PE">Permiso Especial de Permanencia</option>
                    </select>
                </div>
            </div>
        </div>
        <div class='col-sm-4'>
            <div class="form-group">
                <label for="sel1">Número de documento:</label>
                <input type='text' class="form-control" name="numDoc" id="numDoc" />
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class='col-sm-4'>
            <div class="form-group">
                <button class="btn btn-primary" type="button" id="btn-send">Enviar</button>
            </div>
        </div>
    </div>
</form>
<div class="container-fluid" id="table-content" style="display:none">
    <div class="col-lg-12">
        <div class="card border-primary"><br>
            <div class="card-body">
                <h5 style="" class="title text-center"> <b>Listado de programación</b></h5>
                <div class="">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="DetallesColumnas">
                        <label class="custom-control-label" for="DetallesColumnas">Detalles Columnas</label>
                    </div>
                    <hr>
                    <table class="table mb-0" id="table-programacion" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="align-middle" scope="col">Acciones</th>
                                <th class="align-middle" scope="col" title="Identificador">Id</th>
                                <th class="align-middle" scope="col" title="Identificador del Programación">Id. Programación</th>
                                <th class="align-middle" scope="col" title="Fecha de Programación">Fecha Programación</th>
                                <th class="align-middle" scope="col" title="Estado del Programación(0: Anulado - 1: Activo - 2: Procesado)">Estado Programación</th>
                                <th class="align-middle" scope="col" title="Número de Prescripción">No. Prescripción</th>
                                <th class="align-middle" scope="col" title="Tipo de Servicio o Tecnología">Tipo de Servicio</th>
                                <th class="align-middle" scope="col" title="Consecutivo Orden Servicio o Tecnología">Orden Servicio</th>
                                <th class="align-middle" scope="col" title="Tipo Documento de Identificación del Paciente">Tipo Documento</th>
                                <th class="align-middle" scope="col" title="Número de Identificación del Paciente">Id. Paciente</th>
                                <th class="align-middle" scope="col" title="Número Entrega">No. Entrega</th>
                                <th class="align-middle" scope="col" title="Tipo de Identificación de Sede del Proveedor">Tipo Id. Sede Proveedor</th>
                                <th class="align-middle" scope="col" title="Número de Identificación de Sede del Proveedor">Id. Sede Proveedor</th>
                                <th class="align-middle" scope="col" title="Código de Sede del Proveedor">Cod. Sede Proveedor</th>
                                <th class="align-middle" scope="col" title="Fecha Máxima de Entrega">Fecha Entrega</th>
                                <th class="align-middle" scope="col" title="Cantidad Total a Entregar">Cantidad Entrega</th>
                                <th class="align-middle" scope="col" title="Código Servicio o Tecnología a Entregar">Cod. Servicio</th>
                                <th class="align-middle" scope="col" title="Fecha de Anulación Direccionamiento">Fecha Anulación</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{--Ventana Modal--}}
<div class="row" id="container">
    <div class="contenido">
        <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modalArbol" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="col-md-10">
                            <h3 class="header-title">Entrega</h3>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <hr>
                    </div>
                    <form id="form-prog" style="margin:5%">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="sel1">Identificador:</label>
                                    <input class="form-control" id="Identificador" name="Identificador" type="text">
                                    <span id="requeridoIdentificador" style="display:none" class="badge badge-danger">Debe ingresar identificador de la entrega</span>
                                </div>
                            </div>
                            <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="sel1">Código servicio o tecnología entregado:</label>
                                    <input class="form-control" id="CodServTec" name="CodServTec" type="text">
                                    <span id="requeridoCodServicio" style="display:none" class="badge badge-danger">Debe ingresar código servicio o tecnología entregado</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Cantidad total entregada:</label>
                                    <input class="form-control" id="CantTotEntrega" name="CantTotEntrega" type="text">
                                    <span id="requeridoCantTotEntrega" style="display:none" class="badge badge-danger">Debe ingresar cantidad total entregada</span>
                                </div>
                            </div>
                            <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="sel1">Entrega total:</label>
                                    <select class="form-control" id="EntregaTotal" name="EntregaTotal">
                                        <option selected disabled>Seleccione opción</option>
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                    <span id="requeridoEntregaTotal" style="display:none" class="badge badge-danger">Debe seleccionar entrega total</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Causa no entrega:</label>
                                    <input class="form-control" name="CausaNoEntrega" id="CausaNoEntrega" type="text">
                                    <span id="requeridoCausaNoEntrega" style="display:none" class="badge badge-danger">Debe ingresar causas de no entrega</span>
                                </div>
                            </div>
                            <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="sel1">Fecha de entrega:</label>
                                    <input class="form-control" name="FechaEntrega" id="FechaEntrega" type="date">
                                    <span id="requeridoFechaEntrega" style="display:none" class="badge badge-danger">Debe seleccionar fecha de entrega</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Lote entregado:</label>
                                    <input class="form-control" name="LoteEntregado" id="LoteEntregado" type="text">
                                    <span id="requeridoLoteEntregado" style="display:none" class="badge badge-danger">Debe ingresar lote entrega
                                    </span>
                                </div>
                            </div>
                            <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="sel1">Tipo de documento de identificación de quien recibe</label>
                                    <select class="form-control" id="TipoIDRecibe" name="TipoIDRecibe">
                                        <option selected disabled>Seleccione opción</option>
                                        <option value="CC">Cédula de Ciudadanía</option>
                                        <option value="CE">Cédula de Extranjería</option>
                                        <option value="PA">Pasaporte</option>
                                        <option value="CD">Carné Diplomático</option>
                                        <option value="SC">Salvoconducto de Permanencia</option>
                                        <option value="PR">Pasaporte de la ONU</option>
                                        <option value="PE">Permiso Especial de Permanencia</option>
                                        <option value="AS">Adulto sin Identificación</option>
                                    </select>
                                    <span id="requeridoTipoIDRecibe" style="display:none" class="badge badge-danger">Debe seleccionar tipo de documento</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Número de identificación de quien recibe:</label>
                                    <input class="form-control" name="NoIDRecibe" id="NoIDRecibe" type="text">
                                    <span id="requeridoNoIDRecibe" style="display:none" class="badge badge-danger">Debe ingresar número identificación
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class='col-sm-12'>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="button" id="btn-entrega">Registrar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{--<link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">--}}
<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
<style>
    .dataTables_filter input {
        border-radius: 10px;
    }

    .header-title {
            font-weight: bold;
            text-align: center;
        }

</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
{{--<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}" type="text/javascript" defer></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}" type="text/javascript" defer></script>--}}
<!--<link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">-->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" type="text/javascript" defer></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js" type="text/javascript" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="application/javascript">
    var dataTable;
    $(document).ready(function() {
        $('#filtro option[value="0"]').prop('selected', 'selected').change();
        $('#fecha').hide();
        $('#prescripcion').hide();
        $('#detalle').hide();
    });

    $(document).on("click", "#btn-send", function() {
        proccessData();
    });

    function fillDatatable(formData) {
        dataTable = $('#table-programacion').DataTable({
            destroy: true
            , serverSide: true
            , processing: true
            , 'language': {
                "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            }
            , ajax: {
                url: "{{ route('programacion.data') }}"
                , type: "GET"
                , data: formData
            }
            , "columns": [{
                "render": function(data, type, full, meta) {
                    return full.EstProgramacion == 1 ? "<button class='btn btn-sm btn-dark mr-1' id='entrega' title='Entregar'><i class='fas fa-pills text-cyan'></i></button>"+
                        "<button class='btn btn-sm btn-dark' id='anular' title='Anular programación'><i class='fas fa-trash text-orange'></i></button>" :
                        full.EstProgramacion == 0 ? "<button class='btn btn-sm btn-dark mr-1' title='La programación ha sido anulada' disabled><i class='fas fa-pills text-cyan'></i></button>"+
                        "<button class='btn btn-sm btn-dark' title='La programación ha sido anulada' disabled><i class='fas fa-trash text-orange' disabled></i></button>" :
                        "<button class='btn btn-sm btn-dark mr-1' title='La programación ya fué entregada' disabled><i class='fas fa-pills text-cyan' disabled></i></button>"+
                        "<button class='btn btn-sm btn-dark' title='La programación ya fué entregada' disabled><i class='fas fa-trash text-orange' disabled></i></button>"
                }
                //, "width": "6%"
            }, {
                "data": "ID"
            }, {
                "data": "IDProgramacion"
            }, {
                "data": "FecProgramacion"
            }, {
                "data": "EstProgramacion"
                , "className": "dt-body-center"
            }, {
                "data": "NoPrescripcion"
            }, {
                "data": "TipoTec"
                , "className": "dt-body-center"
            }, {
                "data": "ConTec"
                , "className": "dt-body-center"
            }, {
                "data": "TipoIDPaciente"
                , "className": "dt-body-center"
            }, {
                "data": "NoIDPaciente"
            }, {
                "data": "NoEntrega"
                , "className": "dt-body-center"
            }, {
                "data": "TipoIDSedeProv"
                , "className": "dt-body-center"
            }, {
                "data": "NoIDSedeProv"
            }, {
                "data": "CodSedeProv"
            }, {
                "data": "FecMaxEnt"
            }, {
                "data": "CantTotAEntregar"
                , "className": "dt-body-center"
            }, {
                "data": "CodSerTecAEntregar"
            }, {
                "data": "FecAnulacion"
            }]
            , 'scrollX': true
            , 'columnDefs': [{
                'targets': [6, 7, 10, 11, 12, 13, 15, 16, 17]
                , 'visible': false
            }]
            , 'order': [
                [1, 'asc']
            ]
        });
    }

    function proccessData() {
        if ($('#filtro').val() == 0 || $('#filtro').val() == null)
            getResult("Error al consultar", "Debe seleccionar un tipo de filtro", "error");
        else if ($('#filtro').val() == 1) {
            if ($('#fechaF1').val() != '') {
                var formData = new FormData();
                formData = {
                    '_token': '{{ csrf_token() }}'
                    , 'fecha': $('#fechaF1').val()
                    , 'filtro': $('#filtro').val()
                }
                fillDatatable(formData);
                $("#table-content").css("display", "block");
            } else
                getResult("Información incompleta", "Debe ingresar datos requeridos.", "error");
        } else if ($('#filtro').val() == 2) {
            if ($('#noPrescripcion').val() != '') {
                var formData = new FormData();
                formData = {
                    '_token': '{{ csrf_token() }}'
                    , 'noPrescripcion': $('#noPrescripcion').val()
                    , 'filtro': $('#filtro').val()
                }
                fillDatatable(formData);
                $("#table-content").css("display", "block");
            } else
                getResult("Información incompleta", "Debe ingresar datos requeridos.", "error");
        } else if ($('#filtro').val() == 3) {
            if ($('#fechaF2').val() != '' && $('#tipoDoc').val() != '' &&
                $('#numDoc').val() != '') {
                var formData = new FormData();
                formData = {
                    "_token": "{{ csrf_token() }}"
                    , 'fecha': $('#fechaF2').val()
                    , 'tipoDoc': $('#tipoDoc').val()
                    , 'numDoc': $('#numDoc').val()
                    , 'filtro': $('#filtro').val()
                }
                fillDatatable(formData);
                $("#table-content").css("display", "block");
            } else
                getResult("Información incompleta", "Debe ingresar datos requeridos.", "error");
        }
    }

    function getResult(title, text, icon) {
            Swal.fire({
                title: title,
                icon: icon,
                html: `
                <hr>
                <p>${text}</p>
                <hr>`,
                width: '40%',
                confirmButtonText: "Continuar",
                allowOutsideClick: false,
                allowEscapeKey: false,
                //timer: 4000
            });
        }

    $("#DetallesColumnas").change(function() {
        dataTable.columns([6, 7, 10, 11, 12, 13, 15, 16, 17]).visible($(this).is(':checked'))
    });

    $('#table-programacion').on('click', "button", async function() {
        var row = $("#table-programacion").DataTable().row(this.closest('tr')).data();
        var id = $(this)[0]["id"];
        if(id == 'entrega'){
            $("#Identificador").val(row.ID);
            $("#CodServTec").val(row.CodSerTecAEntregar);
            $("#CantTotEntrega").val(row.CantTotAEntregar);            
            $("#TipoIDRecibe").val(row.TipoIDPaciente);
            $("#NoIDRecibe").val(row.NoIDPaciente);
            $("#FechaEntrega").val((new Date()).toISOString().split('T')[0]);
            $("#EntregaTotal").val("1");
            //$("#CodSedeProv").attr("disabled", "disabled");

            $('.modal').modal({
                'show': true
                , 'backdrop': 'static'
                , 'keyboard': false
            });
        }else if(id == 'anular'){
            anular(row);
        }
    });

    function proccessData1() {
        if (!validField1()) {
            var Identificador = $('#Identificador').val();
            var CodServTec = $('#CodServTec').val();
            var CantTotEntrega = $('#CantTotEntrega').val();
            var EntregaTotal = $('#EntregaTotal').val();
            var CausaNoEntrega = $('#CausaNoEntrega').val();
            var FechaEntrega = $('#FechaEntrega').val();
            var LoteEntregado = $('#LoteEntregado').val();
            var TipoIDRecibe = $('#TipoIDRecibe').val();
            var NoIDRecibe = $('#NoIDRecibe').val();
            var formData = new FormData();
            //var url = '/ui/entrega/reportar';
            var url = "{{ route('reportar-entrega') }}";
            formData = {
                "_token": "{{ csrf_token() }}"
                , Identificador: Identificador
                , CodServTec: CodServTec
                , CantTotEntrega: CantTotEntrega
                , EntregaTotal: EntregaTotal
                , CausaNoEntrega: CausaNoEntrega
                , FechaEntrega: FechaEntrega
                , LoteEntregado: LoteEntregado
                , TipoIDRecibe: TipoIDRecibe
                , NoIDRecibe: NoIDRecibe
            }
            sendData(formData, url, 1);
        }
    }    

    function validField1() {
        var bndValidacion = false;
        var Identificador = $('#Identificador').val();
        var CodServTec = $('#CodServTec').val();
        var CantTotEntrega = $('#CantTotEntrega').val();
        var EntregaTotal = $('#EntregaTotal').val();
        var CausaNoEntrega = $('#CausaNoEntrega').val();
        var FechaEntrega = $('#FechaEntrega').val();
        var LoteEntregado = $('#LoteEntregado').val();
        var TipoIDRecibe = $('#TipoIDRecibe').val();
        var NoIDRecibe = $('#NoIDRecibe').val();

        if (Identificador.trim() == '') {
            $('#requeridoIdentificador').css('display', 'inline');
            $('#Identificador').css('border', '2px solid #dc3545');
            bndValidacion = true;
        } else {
            if (Identificador.length > 19) {
                $('#requeridoIdentificador').css('display', 'inline');
                $('#requeridoIdentificador').text('El identificador debe tener como máximo 19 caracteres');
                $('#Identificador').css('border', '2px solid #dc3545');
                bndValidacion = true;
            } else {
                $('#requeridoIdentificador').css('display', 'none');
                $('#Identificador').css('border', '1px solid #D5CBCB');
            }
        }

        if (CodServTec.trim() == '') {
            $('#requeridoCodServicio').css('display', 'inline');
            $('#CodServTec').css('border', '2px solid #dc3545');
            bndValidacion = true;
        } else {
            if (CodServTec.length > 20) {
                $('#requeridoCodServicio').css('display', 'inline');
                $('#requeridoCodServicio').text('El código debe tener como máximo 20 caracteres');
                $('#CodServTec').css('border', '2px solid #dc3545');
                bndValidacion = true;
            } else {
                $('#requeridoCodServicio').css('display', 'none');
                $('#CodServTec').css('border', '1px solid #D5CBCB');
            }
        }

        if (CantTotEntrega.trim() == '') {
            $('#requeridoCantTotEntrega').css('display', 'inline');
            $('#CantTotEntrega').css('border', '2px solid #dc3545');
            bndValidacion = true;
        } else {
             if (CantTotEntrega.length > 10) {
                $('#requeridoCantTotEntrega').css('display', 'inline');
                $('#requeridoCantTotEntrega').text('La cantidad total debe tener como máximo 10 caracteres');
                $('#CantTotEntrega').css('border', '2px solid #dc3545');
                bndValidacion = true;
            } else {
                $('#requeridoCantTotEntrega').css('display', 'none');
                $('#CantTotEntrega').css('border', '1px solid #D5CBCB');
            }
        }

        if (EntregaTotal == null) {
            $('#requeridoEntregaTotal').css('display', 'inline');
            $('#EntregaTotal').css('border', '2px solid #dc3545');
            bndValidacion = true;
        } else {
            $('#requeridoEntregaTotal').css('display', 'none');
            $('#EntregaTotal').css('border', '1px solid #D5CBCB');
            if($('#EntregaTotal').val())
            {
                if (EntregaTotal == 'N') {
                    $('#requeridoCausaNoEntrega').css('display', 'inline');
                    $('#CausaNoEntrega').css('border', '2px solid #dc3545');
                    bndValidacion = true;
                } else {
                    if (CausaNoEntrega.length > 10) {
                        $('#requeridoCausaNoEntrega').css('display', 'inline');
                        $('#requeridoCausaNoEntrega').text('La causa de no entrega debe tener como máximo 10 caracteres');
                        $('#CausaNoEntrega').css('border', '2px solid #dc3545');
                        bndValidacion = true;
                    } else {
                        $('#requeridoCausaNoEntrega').css('display', 'none');
                        $('#CausaNoEntrega').css('border', '1px solid #D5CBCB');
                    }
                }
            }
        }        

        if (FechaEntrega.trim() == '') {
            $('#requeridoFechaEntrega').css('display', 'inline');
            $('#FechaEntrega').css('border', '2px solid #dc3545');
            bndValidacion = true;
        } else {
            $('#requeridoFechaEntrega').css('display', 'none');
            $('#FechaEntrega').css('border', '1px solid #D5CBCB');           
        }

        /*if (LoteEntregado.trim() == '') {
            $('#requeridoLoteEntregado').css('display', 'inline');
            $('#LoteEntregado').css('border', '2px solid #dc3545');
            bndValidacion = true;
        } else {
            $('#requeridoLoteEntregado').css('display', 'none');
            $('#LoteEntregado').css('border', '1px solid #D5CBCB');
        }*/

        if (TipoIDRecibe == null) {
            $('#requeridoTipoIDRecibe').css('display', 'inline');
            $('#TipoIDRecibe').css('border', '2px solid #dc3545');
            bndValidacion = true;
        } else {
            $('#requeridoTipoIDRecibe').css('display', 'none');
            $('#TipoIDRecibe').css('border', '1px solid #D5CBCB');
        }

        if (NoIDRecibe.trim() == '') {
            $('#requeridoNoIDRecibe').css('display', 'inline');
            $('#NoIDRecibe').css('border', '2px solid #dc3545');
            bndValidacion = true;
        } else {
            $('#requeridoNoIDRecibe').css('display', 'none');
            $('#NoIDRecibe').css('border', '1px solid #D5CBCB');
        }
        return bndValidacion;
    }

    $(document).on("click", "#btn-entrega", function() {
        proccessData1();
    });

    /*$(document).on("click", "#btn-anular", function() {
        var FechaMax = $("#fechaMaxima").val();
        var CodServTec = $("#CodServTec").val();
        var IdDireccionamiento = $("#idDireccionamiento").val();
        var CantidadTotalEntregar = $("#CantidadEntregar").val();
        var NodDocProv = $("#NoDocProv").val();
        var CodSedeProv = $("#CodSedeProv").val();
        var TipoDocProv = $("#tipoDocProv").val();
        var formData = new FormData();
        //var url = '/ui/entrega/reportar';
        var url = "{{ route('reportar-entrega') }}";
        formData = {
            "_token": "{{ csrf_token() }}"
            , FechaMax: FechaMax
            , TipoDocProv: TipoDocProv
            , CodServTec: CodServTec
            , IdDireccionamiento: IdDireccionamiento
            , CantidadTotalEntregar: CantidadTotalEntregar
            , NodDocProv: NodDocProv
            , CodSedeProv: CodSedeProv
        }         
    });*/

    function anular(row) {
        var formData = new FormData();
        //var url = '/ui/programacion/anular';
        var url = "{{ route('anular-programacion') }}";
        formData = {
            "_token": "{{ csrf_token() }}"
            , ID: row.IDProgramacion
        }
        Swal.fire({
            title: '¿Está seguro?',
            html: "El ID <b>"+row.IDProgramacion+"</b> será anulado",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                sendData(formData, url, 0);
            }
        });
    }

    function getResult(title, text, icon) {
            Swal.fire({
                title: title,
                icon: icon,
                html: `
                <hr>
                <p>${text}</p>
                <hr>`,
                width: '40%',
                confirmButtonText: "Continuar",
                allowOutsideClick: false,
                allowEscapeKey: false,
                //timer: 4000
            });
        }

    $('#filtro').on('change', function(e) {
        if (this.value == '1') {
            $('#fecha').show();
            $('#prescripcion').hide();
            $('#detalle').hide();
        } else if (this.value == '2') {
            $('#fecha').hide();
            $('#prescripcion').show();
            $('#detalle').hide();
        } else if (this.value == '3') {
            $('#fecha').hide();
            $('#prescripcion').hide();
            $('#detalle').show();
        }
    });

    function sendData(postData, url, modal) {
        $.ajax({
            type: "PUT"
            , url: url
            , data: postData
            , cache: false
            ,  success: function(data) {
                    if (data.validate == 1){
                        getResult("Bien hecho", data.message, 'success');
                        if(modal == 1)                        
                            $('.modal').modal('hide');
                        $('#table-programacion').DataTable().ajax.reload();
                    }else
                        getResult(data.message, data.error, 'error');                        
            }
        });
    }
</script>
@endsection
