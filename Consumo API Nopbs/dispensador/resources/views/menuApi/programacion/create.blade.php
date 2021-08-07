@extends('adminlte::page')

@section('title', 'Suministro API')

@section('content_header')
    <h1 class="header-title">Programación</h1>
    <hr>
@stop

@section('content')
    <form id="form-prog">
        {{ csrf_field() }}

        <div class="container-fluid bg-light py-3">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card card-body">
                        <div class="container">
                            <hr>
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Identificador de Direccionamiento:</label>
                                            <input class="form-control" id="idDireccionamiento" name="idDireccionamiento"
                                                type="text">
                                            <span id="requeridoDireccionamiento" style="display:none"
                                                class="badge badge-danger">Debe
                                                ingresar identificador de direccionamiento</span>
                                        </div>
                                    </div>
                                    <div class='col-sm-6'>
                                        <div class="form-group">
                                            <label for="sel1">Fecha Máxima de Entrega:</label>
                                            <input type='date' class="form-control" name="fechaMaxima" id="fechaMaxima" />
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
                                                <span id="requeridoNoSede" style="display:none"
                                                    class="badge badge-danger">Debe ingresar número de identificación de
                                                    sede proveedor</span>
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
                                            <span id="requeridoCodSedeProv" style="display:none"
                                                class="badge badge-danger">Debe seleccionar código de sede proveedor</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Código servicio o tecnología a entregar:</label>
                                            <div class="form-group">
                                                <input class="form-control" id="CodServTec" name="CodServTec" type="text">
                                                <span id="requeridoCodServ" style="display:none"
                                                    class="badge badge-danger">Debe ingresar el código servicio o tecnología
                                                    a entregar</span>
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
                                                <span id="requeridoCantEnt" style="display:none"
                                                    class="badge badge-danger">Debe ingresar la cantidad total a
                                                    entregar</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class='col-sm-12'>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" type="button"
                                                id="btn-prog">Registrar</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <style>
        .dataTables_filter input {
            border-radius: 10px;
        }
    
        .header-title {
                font-weight: bold;
                text-align: center;
            }
    
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" type="text/javascript">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="application/javascript">
        $(document).ready(function() {
            var d = new Date();
            var today = d.getFullYear() + '-' + ('0' + (d.getMonth() + 1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2);
            $("#fechaMaxima").val(today);
            $("#CodSedeProv").attr('disabled', 'disabled')
            $('#CodSedeProv option[value="S"]').prop('selected', 'selected').change();
        });

        $(document).on("click", "#btn-prog", function() {
            proccessData();
        });

        function proccessData() {
            if (!validField()) {
                var FechaMax = $("#fechaMaxima").val();
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
                    TipoDocProv: TipoDocProv,
                    CodServTec: CodServTec,
                    IdDireccionamiento: IdDireccionamiento,
                    CantidadTotalEntregar: CantidadTotalEntregar,
                    NodDocProv: NodDocProv,
                    CodSedeProv: CodSedeProv
                }
                sendData(formData);
            }
        }

        function validField() {
            var bndValidacion = false;
            var idDireccionamiento = $("#idDireccionamiento").val();
            var fechaMaxima = $('#fechaMaxima').val();
            var NoDocProv = $('#NoDocProv').val();
            var CodSedeProv = $('#CodSedeProv').val();
            var CodServTec = $('#CodServTec').val();
            var CantidadEntregar = $('#CantidadEntregar').val();

            if (idDireccionamiento.trim() == '') {
                $('#requeridoDireccionamiento').css('display', 'inline');
                $('#idDireccionamiento').css('border', '2px solid #dc3545');
                bndValidacion = true;
            } else {
                $('#requeridoDireccionamiento').css('display', 'none');
                $('#idDireccionamiento').css('border', '1px solid #D5CBCB');
            }

            if (fechaMaxima.trim() == '') {
                $('#requeridoFecha').css('display', 'inline');
                $('#fechaMaxima').css('border', '2px solid #dc3545');
                bndValidacion = true;
            } else {
                $('#requeridoFecha').css('display', 'none');
                $('#fechaMaxima').css('border', '1px solid #D5CBCB');
            }

            if (NoDocProv.trim() == '') {
                $('#requeridoNoSede').css('display', 'inline');
                $('#NoDocProv').css('border', '2px solid #dc3545');
                bndValidacion = true;
            } else {
                $('#requeridoNoSede').css('display', 'none');
                $('#NoDocProv').css('border', '1px solid #D5CBCB');
            }

            if (CodSedeProv == null) {
                $('#requeridoCodSedeProv').css('display', 'inline');
                $('#CodSedeProv').css('border', '2px solid #dc3545');
                bndValidacion = true;
            } else {
                $('#requeridoCodSedeProv').css('display', 'none');
                $('#CodSedeProv').css('border', '1px solid #D5CBCB');
            }

            if (CodServTec.trim() == '') {
                $('#requeridoCodServ').css('display', 'inline');
                $('#CodServTec').css('border', '2px solid #dc3545');
                bndValidacion = true;
            } else {
                $('#requeridoCodServ').css('display', 'none');
                $('#CodServTec').css('border', '1px solid #D5CBCB');
            }

            if (CantidadEntregar.trim() == '') {
                $('#requeridoCantEnt').css('display', 'inline');
                $('#CantidadEntregar').css('border', '2px solid #dc3545');
                bndValidacion = true;
            } else {
                $('#requeridoCantEnt').css('display', 'none');
                $('#CantidadEntregar').css('border', '1px solid #D5CBCB');
            }
        }

        function sendData(postData) {
            $.ajax({
                type: "PUT",
                url: '/ui/programacion/reportar',
                data: postData,
                cache: false,
                success: function(data) {
                    if (data.validate != null)
                    getResult(data.validate, data.error, 'error');
                else
                    getResult("Bien hecho", "Programación realizada exitosamente", 'success');
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
                allowEscapeKey: false
            });
        }      

    </script>
@endsection
