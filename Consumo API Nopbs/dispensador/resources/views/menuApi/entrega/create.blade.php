@extends('adminlte::page')

@section('title', 'Suministro API')

@section('content_header')
    <h1 class="header-title">Entrega</h1>
    <hr>
@stop

@section('content')
<form>
    {{ csrf_field() }}

    <div class="container-fluid bg-light py-3">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card card-body">
                    <div class="container">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#entrega" role="tab">Entrega</a></li>                           
                        </ul>
                        <div class="tab-content">
                            <div id="entrega" class="tab-pane active">                               
                                <hr>
                                <fieldset>
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
                                                    <option value="S">Si</option>
                                                    <option value="N">No</option>
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
                                                <button class="btn btn-primary btn-block" type="button" id="btn-send1">Registrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>                            
                        </div>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).on("click", "#btn-send1", function() {
        proccessData();
    });

    function proccessData() {
        if (!validField1()) {
            var IdEntrega = $('#Identificador').val();
            var CodServTec = $('#CodServTec').val();
            var CantTotEntrega = $('#CantTotEntrega').val();
            var EntregaTotal = $('#EntregaTotal').val();
            var CausaNoEntrega = $('#CausaNoEntrega').val();
            var FechaEntrega = $('#FechaEntrega').val();
            var LoteEntregado = $('#LoteEntregado').val();
            var TipoIDRecibe = $('#TipoIDRecibe').val();
            var NoIDRecibe = $('#NoIDRecibe').val();

            var postData = new FormData();
            postData = {
                "_token": "{{ csrf_token() }}"
                , ID: IdEntrega
                , CodSerTecEntregado: CodServTec
                , CantTotEntregada: CantTotEntrega
                , EntTotal: EntregaTotal
                , CausaNoEntrega: CausaNoEntrega
                , FecEntrega: FechaEntrega
                , NoLote: LoteEntregado
                , TipoIDRecibe: TipoIDRecibe
                , NoIDRecibe: NoIDRecibe
                , Form: 1
            }
            sendData(postData);
        }
    }    

    function validField() {
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
        }

        /*if (CausaNoEntrega.trim() == '') {
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
        }*/

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

    function getResult(title, text, icon) {
        Swal.fire({
            title: title
            , icon: icon
            , html: `
            <hr>
            <p>${text}</p>
            <hr>`
            , width: '40%'
            , confirmButtonText: "Continuar"
            , allowOutsideClick: false
            , allowEscapeKey: false
        , });
    }

    function sendData(postData) {
        $.ajax({
            type: "PUT"
            , url: './reportar'
            , data: postData
            , cache: false
            , success: function(data) {
                if (data.validate != null)
                    getResult(data.validate, data.error, 'error');
                else
                    getResult("Bien hecho", "Entrega realizada exitosamente", 'success');
            }
        });
    }

</script>
@endsection
