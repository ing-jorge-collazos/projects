@extends('adminlte::page')

@section('title', 'Suministro API')

@section('content_header')
    <h1 class="header-title">Direccionamiento</h1>
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
                    <h5 style="" class="title text-center"> <b>Listado de direccionamiento</b></h5>
                    <div class="">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="DetallesColumnas">
                            <label class="custom-control-label" for="DetallesColumnas">Detalles Columnas</label>
                        </div>
                        <hr>
                        <table class="table mb-0" id="table-direccionamiento" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="align-middle" scope="col">Acciones</th>
                                    <th class="align-middle" scope="col" title="Identificador">Id</th>
                                    <th class="align-middle" scope="col" title="Identificador del direccionamiento">Id.
                                        Direccionamiento</th>
                                    <th class="align-middle" scope="col" title="Fecha de Direccionamiento">Fecha
                                        Direccionamiento</th>
                                    <th class="align-middle" scope="col"
                                        title="Estado del Direccionamiento(0: Anulado - 1: Activo - 2: Procesado)">Estado
                                        Direccionamiento</th>
                                    <th class="align-middle" scope="col" title="Número de Prescripción">No. Prescripción
                                    </th>
                                    <th class="align-middle" scope="col" title="Tipo de Servicio o Tecnología">Tipo de
                                        Servicio</th>
                                    <th class="align-middle" scope="col" title="Consecutivo Orden Servicio o Tecnología">
                                        Orden Servicio</th>
                                    <th class="align-middle" scope="col"
                                        title="Tipo Documento de Identificación del Paciente">Tipo Documento</th>
                                    <th class="align-middle" scope="col" title="Número de Identificación del Paciente">Id.
                                        Paciente</th>
                                    <th class="align-middle" scope="col" title="Número Entrega">No. Entrega</th>
                                    <th class="align-middle" scope="col" title="Número Sub Entrega">No. Sub Entrega</th>
                                    <th class="align-middle" scope="col" title="Tipo de Identificación del Proveedor">Tipo
                                        Id. Proveedor</th>
                                    <th class="align-middle" scope="col" title="Número de Identificación del Proveedor">Id.
                                        Proveedor</th>
                                    <th class="align-middle" scope="col" title="Lugar de Entrega">Lugar Entrega</th>
                                    <th class="align-middle" scope="col" title="Fecha Máxima de Entrega">Fecha Entrega</th>
                                    <th class="align-middle" scope="col" title="Cantidad Total a Entregar">Cantidad Entrega
                                    </th>
                                    <th class="align-middle" scope="col" title="Dirección del Paciente">Dirección Paciente
                                    </th>
                                    <th class="align-middle" scope="col" title="Nit de la EPS">Nit. EPS</th>
                                    <th class="align-middle" scope="col" title="Código de la EPS">Cod. EPS</th>
                                    <th class="align-middle" scope="col" title="Código Servicio o Tecnología a Entregar">
                                        Cod. Servicio</th>
                                    <th class="align-middle" scope="col" title="Fecha de Anulación Direccionamiento">Fecha
                                        Anulación</th>
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

    {{-- Ventana Modal --}}
    <div class="row" id="container">
        <div class="contenido">
            <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modalArbol" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="col-md-10">
                                <h3 class="header-title">Programación</h3>
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
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Identificador de Direccionamiento:</label>
                                        <input class="form-control" id="idDireccionamiento" name="idDireccionamiento"
                                            type="text">
                                    </div>
                                </div>
                                <div class='col-sm-6'>
                                    <div class="form-group">
                                        <label for="sel1">Fecha Máxima de Entrega:</label>
                                        <input type='date' class="form-control" name="fechaMaxima" id="fechaMaxima" />
                                        <input type='date' class="form-control" name="fechaDireccionamiento" id="fechaDireccionamiento" style="display:none" />
                                        <span id="requeridoFecha" style="display:none" class="badge badge-danger">Debe
                                            seleccionar la fecha máxima de entrega</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tipo de Identificación Sede Provedor:</label>
                                        <input class="form-control" id="tipoDocProv" name="tipoDocProv" value="Nit"
                                            type="text" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Número de Identificación Sede Provedor:</label>
                                        <div class="form-group">
                                            <input class="form-control" id="NoDocProv" name="NoDocProv" type="text">
                                            <span id="requeridoNoSede" style="display:none" class="badge badge-danger">Debe
                                                ingresar número de identificación de sede proveedor</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Código de Sede de Provedor:</label>
                                        <select class="form-control" id="CodSedeProv" name="CodSedeProv">
                                            <option value="" selected disabled>Seleccione opción</option>
                                            <option value="S">Si</option>
                                            <option value="N">No</option>
                                        </select>
                                        <span id="requeridoCodSedeProv" style="display:none" class="badge badge-danger">Debe
                                            seleccionar código de sede proveedor</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Código servicio o tecnología a entregar:</label>
                                        <div class="form-group">
                                            <input class="form-control" id="CodServTec" name="CodServTec" type="text">
                                            <span id="requeridoCodServ" style="display:none" class="badge badge-danger">Debe
                                                ingresar el código servicio o tecnología a entregar</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Cantidad total a entregar:</label>
                                        <div class="form-group">
                                            <input class="form-control" id="CantidadEntregar" name="CantidadEntregar"
                                                type="text">
                                            <span id="requeridoCantEnt" style="display:none" class="badge badge-danger">Debe
                                                ingresar la cantidad total a entregar</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class='col-sm-12'>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block" type="button"
                                            id="btn-prog">Registrar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link href="{!! asset('assets/css/app.css') !!}" rel="stylesheet"  type="text/css">
    @push('styles')
        
    @endpush
    {{-- <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
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
    {{-- <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}" type="text/javascript" defer></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}" type="text/javascript" defer></script> --}}
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
            dataTable = $('#table-direccionamiento').DataTable({
                destroy: true,
                serverSide: true,
                processing: true,
                responsive: true,
                'language': {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                ajax: {
                    url: "{{ route('direccionamiento.data') }}",
                    type: "GET",
                    data: formData
                },
                "columns": [{
                    "render": function(data, type, full, meta) {
                        return full.EstDireccionamiento == 1 ?
                            "<button class='btn btn-sm btn-dark' title='Programar'><i class='fas fa-stethoscope text-yellow'></i></button>" :
                            "<button class='btn btn-sm btn-dark' title='El direccionamiento ya fué programado' disabled><i class='fas fa-stethoscope text-yellow'></i></button>"
                    },
                    "width": "6%"
                }, {
                    "data": "ID"
                }, {
                    "data": "IDDireccionamiento"
                }, {
                    "data": "FecDireccionamiento"
                }, {
                    "data": "EstDireccionamiento",
                    "className": "dt-body-center"
                }, {
                    "data": "NoPrescripcion"
                }, {
                    "data": "TipoTec",
                    "className": "dt-body-center"
                }, {
                    "data": "ConTec",
                    "className": "dt-body-center"
                }, {
                    "data": "TipoIDPaciente",
                    "className": "dt-body-center"
                }, {
                    "data": "NoIDPaciente"
                }, {
                    "data": "NoEntrega",
                    "className": "dt-body-center"
                }, {
                    "data": "NoSubEntrega",
                    "className": "dt-body-center"
                }, {
                    "data": "TipoIDProv",
                    "className": "dt-body-center"
                }, {
                    "data": "NoIDProv"
                }, {
                    "data": "CodMunEnt"
                }, {
                    "data": "FecMaxEnt"
                }, {
                    "data": "CantTotAEntregar",
                    "className": "dt-body-center"
                }, {
                    "data": "DirPaciente"
                }, {
                    "data": "NoIDEPS"
                }, {
                    "data": "CodEPS"
                }, {
                    "data": "CodSerTecAEntregar"
                }, {
                    "data": "FecAnulacion"
                }],
                'scrollX': true,
                'columnDefs': [{
                    'targets': [4, 6, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20, 21],
                    'visible': false
                }],
                'order': [
                    [1, 'asc']
                ]
            });   
        }        

        function proccessData() {
            if ($('#filtro').val() == 0 || $('#filtro').val() == null)
                getResult("Error al consultar", "Debe seleccionar un tipo de filtro", 'error');
            else if ($('#filtro').val() == 1) {
                if ($('#fechaF1').val() != '') {
                    var formData = new FormData();
                    formData = {
                        '_token': '{{ csrf_token() }}',
                        'fecha': $('#fechaF1').val(),
                        'filtro': $('#filtro').val()
                    }
                    fillDatatable(formData);
                    $("#table-content").css("display", "block");
                } else
                    getResult("Información incompleta", "Debe ingresar datos requeridos.", 'error');
            } else if ($('#filtro').val() == 2) {
                if ($('#noPrescripcion').val() != '') {
                    var formData = new FormData();
                    formData = {
                        '_token': '{{ csrf_token() }}',
                        'noPrescripcion': $('#noPrescripcion').val(),
                        'filtro': $('#filtro').val()
                    }
                    fillDatatable(formData);
                    $("#table-content").css("display", "block");
                } else
                    getResult("Información incompleta", "Debe ingresar datos requeridos.", 'error');
            } else if ($('#filtro').val() == 3) {
                if ($('#fechaF2').val() != '' && $('#tipoDoc').val() != '' &&
                    $('#numDoc').val() != '') {
                    var formData = new FormData();
                    formData = {
                        "_token": "{{ csrf_token() }}",
                        'fecha': $('#fechaF2').val(),
                        'tipoDoc': $('#tipoDoc').val(),
                        'numDoc': $('#numDoc').val(),
                        'filtro': $('#filtro').val()
                    }
                    fillDatatable(formData);
                    $("#table-content").css("display", "block");
                } else
                    getResult("Información incompleta", "Debe ingresar datos requeridos.", 'error');
            }
        }

        $("#DetallesColumnas").change(function() {
            dataTable.columns([4, 6, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20, 21]).visible($(this).is(':checked'))
        });

        $('#table-direccionamiento').on('click', "button", async function() {
            var row = $("#table-direccionamiento").DataTable().row(this.closest('tr')).data();
            $("#fechaMaxima").val(row.FecMaxEnt);
            $("#fechaDireccionamiento").val((row.FecDireccionamiento).split(" ")[0]);
            $("#CodServTec").val(row.CodSerTecAEntregar);
            $("#idDireccionamiento").val(row.ID);
            $("#CantidadEntregar").val(row.CantTotAEntregar);
            $("#NoDocProv").val(row.NoIDProv);
            $("#CodSedeProv").val("S");
            $("#CodSedeProv").attr("disabled", "disabled");

            $('.modal').modal({
                'show': true,
                'backdrop': 'static',
                'keyboard': false
            });
        });

        $(document).on("click", "#btn-prog", function() {

            var FechaMax = $("#fechaMaxima").val();
            var FecDireccionamiento = $("#fechaDireccionamiento").val();
            var CodServTec = $("#CodServTec").val();
            var IdDireccionamiento = $("#idDireccionamiento").val();
            var CantidadTotalEntregar = $("#CantidadEntregar").val();
            var NodDocProv = $("#NoDocProv").val();
            var CodSedeProv = $("#CodSedeProv").val();
            var TipoDocProv = $("#tipoDocProv").val();
            var formData = new FormData();
            formData = {
                "_token": "{{ csrf_token() }}",
                FechaMax: FechaMax,
                FecDireccionamiento: FecDireccionamiento,
                TipoDocProv: TipoDocProv,
                CodServTec: CodServTec,
                IdDireccionamiento: IdDireccionamiento,
                CantidadTotalEntregar: CantidadTotalEntregar,
                NodDocProv: NodDocProv,
                CodSedeProv: CodSedeProv
            }
            sendData(formData);
        });

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

        $(document).on("click", ".fb-entrega", function() {
            var entrega_id = $(this).data('id');
            Swal.fire({
                title: '¿Está seguro?',
                text: "No es posible revertir el proceso",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "PUT",
                        url: '/ui/entrega/anular/',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'entrega_id': entrega_id
                        },
                        cache: false,
                        success: function(data) {
                            $("#response").html(data);
                        },
                        error: function(request, status, error) {
                            alert(request.responseText);
                        }
                    });
                }
            })
        });

        function sendData(postData) {
            $.ajax({
                type: "PUT",
                url: "{{ route('reportar-programacion') }}",
                data: postData,
                cache: false,
                success: function(data) {
                    if (data.validate == 1){
                        getResult("Bien hecho", data.message, 'success');                        
                        $('.modal').modal('hide');
                        $('#table-direccionamiento').DataTable().ajax.reload();
                    }else
                        getResult(data.message, data.error, 'error');
                        
                }
            });
        }

    </script>
@endsection
