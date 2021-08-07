$(function() {
    load(1,0);
    $("#date-content").hide();
});

function load(page,report){
    var query=$("#q").val();
    var area;
    var per_page=10;
    var dateStart = 0;
    var dateEnd = 0;

    if($("#dateStart").val() != "" || 
        $("#dateEnd").val() != "")
    {
        dateStart = $("#dateStart").val();
        dateEnd = $("#dateEnd").val();
    }

    var parametros = {
                        "action":"ajax",
                        "page":page,
                        'query':query,
                        'per_page':per_page,
                        'report':report,
                        'dateStart':dateStart,
                        'dateEnd':dateEnd
                    };
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'../../php/list-requests.php',
        data: parametros,
        beforeSend: function(objeto){
            $("#loader").html("Cargando...");
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $("#loader").html("");
        }
    });
}  

$(document).on('click', '#btn-stats', function() {
    load(1,1);
    $("#date-content").show();
    $("#search-content").hide();
});

$(document).on('click', '#btn-pqrs', function() {
    load(1,0);
    $("#date-content").hide();
    $("#search-content").show();
    $("#dateStart").val('');
    $("#dateEnd").val('');
});

$(document).on('click', '#btn-filter', function() {
    if(($("#dateStart").val() != "" &&
        $("#dateEnd").val() == "") ||
        $("#dateStart").val() == "" &&
        $("#dateEnd").val() != "")
    {
        getResult("Error de información", "Campo de fecha para filtro se encuentra vacío");
    }else{
        load(1,1);
    }
});

$(document).on('click', '#btn-send', function() {
    var modRad = $("#modRadicado").val();
    var tipoRadicado = $("#tipoRadicado").val();
    var tipoDoc = $("#tipoDoc").val();
    var numDoc = $("#numDoc").val();
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var name = $("#nombre").val()+' '+$("#apellido").val(); 
    var direccion = $("#direccion").val();
    var telefono = $("#telefono").val();
    var email = $("#email").val();
    var tipoSolicitud = $("#tipoSolicitud").val();
    var asunto = $("#asunto").val();
    var area = $("#area").val();
    var mensaje = $("#mensaje").val();   
    var date = new Date().getFullYear(); 
    var validExt = false;
    var register = false;

    $('#form').validate({
        rules: {
            numDoc:{ 
                required:true,
                minlength: 7,
                maxlength: 15,
                number:true
            },
            name:{ required:true},
            lastname:{required:true},
            address:{required:true},
            phone:{
                required:true,
                minlength: 7,
                maxlength: 15,
                number:true},
            email:{
                required:true,
                email: true
            },
            subject:{required:true},
            message:{required:true},
            privacy:{required:true}
        },
        messages:{
            numDoc: {
                required:"Número de documento es obligatorio",
                minlength:"Debe tener al menos 7 dígitos",
                maxlength:"Deben ser máximo 15 dígitos",
                number:"El campo es numérico"
            },
            name:{
                required:"Nombre es obligatorio"
            },
            lastname:{required:"Apellido es obligatorio"},
            address:{required:"Dirección es obligatorio"},
            phone:{
                required:"Teléfono es obligatorio",
                minlength:"Debe tener al menos 7 dígitos",
                maxlength:"Deben ser máximo 15 dígitos",
                number:"El campo es numérico"
            },
            email:{
                required:"Email es obligatorio",
                email:"El campo es formato email"
            },
            subject:{required:"Asunto es obligatorio"},
            message:{required:"Mensaje es obligatorio"},
            privacy:{required:"Términos y condiciones es obligatorio"}
            //file:{
                //accept:"El documento debe contener formato",
                //filesize:"El archivo debe ser menor a 5MB"
            //}
        }
    });

    if($('input[name="privacy"]').valid()){
        if($('#tipoRadicado').val() != 'Anónimo'){
            $('input[name="numDoc"]').valid();
            $('input[name="name"]').valid();
            $('input[name="lastname"]').valid();
            $('textarea[name="address"]').valid();
            $('input[name="phone"]').valid();
        }    
        
        $('input[name="email"]').valid();
        $('input[name="subject"]').valid();
        $('textarea[name="message"]').valid();
        
        if($('#archivo').val() !== ''){
            var archivo = $('#archivo')[0].files[0];
            var type = ($('#archivo')[0].files[0]['name']).replace(/^.*\./, '');
            var size = (archivo.size/1024/1024).toFixed(2);
            switch (type) { 
                case 'jpg': 
                    validExt = true;
                    break;
                case 'jpeg': 
                    validExt = true;
                    break;
                case 'png': 
                    validExt = true;
                    break;
                case 'pdf': 
                    validExt = true;
                    break;
                case 'doc': 
                    validExt = true;
                    break;
                case 'docx': 
                    validExt = true;            
                    break;
            }
        }
           
            $.ajax({  
                type: "POST",
                url: "../../php/last-numRad.php",             
                dataType: "html", 
                success: function(response){
                    var num = parseInt(response) + 1;
                    var consecutivo = pad(num, 4);
                    var numRad = 'PQR_'+consecutivo+'_'+date;
                    var formData = new FormData();
                    formData.append('numRad',numRad);
                    formData.append('modRad',modRad);
                    formData.append('tipoRadicado',tipoRadicado);
                    if($('input[name="numDoc"]').valid() && $('input[name="name"]').valid() &&
                        $('input[name="lastname"]').valid() && $('textarea[name="address"]').valid() &&
                        $('input[name="phone"]').valid() && $('input[name="email"]').valid() &&
                        $('input[name="subject"]').valid() && $('textarea[name="message"]').valid() && 
                        $('#tipoRadicado').val() != 'Anónimo'){
                            formData.append('tipoDoc',tipoDoc);                
                            formData.append('numDoc',numDoc);
                            formData.append('nombre',nombre);
                            formData.append('apellido',apellido);
                            formData.append('direccion',direccion);
                            formData.append('telefono',telefono);
                            formData.append('email',email);
                            formData.append('tipoSolicitud',tipoSolicitud);
                            formData.append('asunto',asunto);
                            formData.append('area',area);
                            formData.append('mensaje',mensaje);   
                            formData.append('privacy',1); 
                            register = true;
                            
                            if(validExt){
                                if(size>=5000000)
                                {
                                    register = false;
                                    getResult('Error al cargar archivo','El archivo debe ser menor a 5MB')
                                }else if(numRad!==""){
                                    console.log('1');
                                    console.log(type);
                                    formData.append('archivo', archivo);
                                    formData.append('type', type);
                                    register = true;
                                }
                            }else if(!validExt && $('#archivo').val() !== ''){
                                register = false;
                                getResult('Error al cargar archivo','Solo se permiten extensiones (.jpg .png .jpeg .pdf .doc .docx)')
                            }
                        }else if($('input[name="email"]').valid() &&
                            $('input[name="subject"]').valid() && $('textarea[name="message"]').valid() && 
                            $('#tipoRadicado').val() == 'Anónimo'){
                                formData.append('email',email);
                                formData.append('tipoSolicitud',tipoSolicitud);
                                formData.append('asunto',asunto);
                                formData.append('area',area);
                                formData.append('mensaje',mensaje);   
                                formData.append('privacy',1); 
                                register = true;
                                if(validExt){
                                    if(size>=5000000)
                                    {
                                        register = false;
                                        getResult('Error al cargar archivo','El archivo debe ser menor a 5MB')
                                    }else if(numRad!==""){
                                        console.log('2');
                                        console.log(type);
                                        formData.append('archivo', archivo);
                                        formData.append('type', type);
                                        register = true;
                                    }
                                }else if(!validExt && $('#archivo').val() !== ''){
                                    register = false;
                                    getResult('Error al cargar archivo','Solo se permiten extensiones (.jpg .png .jpeg .pdf .doc .docx)')
                                }
                        }
                        else{
                            getResult('Error al registrar PQR','Existen campos vacíos')
                        }
    
                    
                    if(register){
                        $.ajax({  
                            type: "POST",
                            url: "../../php/register-pqr.php",             
                            dataType: "html",   
                            data: formData,
                            contentType: false,       
                            cache: false,            
                            processData:false, 
                            success: function(response){
                                if(response != 0){
                                    clearForm();
                                    var msg = '<html><body>';
                                    msg += '<p>Cordial saludo</p>';
                                    msg += '<p>Gracias por utilizar nuestro canal de PQR.</p>';
                                    msg += '<p> Su solicitud con número de radicado '+ numRad+ ' se presentó correctamente, se notificará por este medio cuando cambie de estado.</p>';
                                    msg += '<p>Estado: <strong>Pendiente</strong></p>';
                                    msg += '<p>Cordialmente,</p>';
                                    msg += '<p>Empoobando E.S.P.</p>';
                                    msg += '</body></html>';
                                    sendEmail(area,email,msg);
                                    Swal.fire({
                                        title: 'Solicitud enviada',
                                        html: `
                                            <hr>            
                                            <center>Tenga en cuenta que su solicitud tiene el Número de Radicado ${response}</center>
                                            <hr>`,
                                        width: '80%',
                                        confirmButtonText: "Continuar",  
                                        showCancelButton: false,
                                        allowEscapeKey: false,
                                    });
                                }
                                else
                                {
                                        getResult("Error petición","No es posbile procesar esta solicitud.")
                                }
                            }
                        });
                    }
                }
            });
    }
    else
        getResult('Error al registrar PQR','Es necesario aceptar los términos y condiciones');
    
});


function clearForm(){  
    //$("#form")[0].reset();
}

function pad (str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
}

/** Eventos Opciones Lista */
var id, email, num_rad, area;
$(document).on('click', '.details', function() {   
    id = $(this).attr("data-id");     
    email = $(this).attr("data-email");
    area = $(this).attr("data-area");  
    num_rad = $(this).attr("data-num");   
    $.ajax({  
        type: "POST",
        url: "../../php/get-details.php",             
        dataType: "html",              
        data: {id:id},
        success: function(response)
        {
            Swal.fire({
                    title: 'Detalle de la solicitud',
                    html: `
                        <hr>            
                        <center>${response}</center>
                        <hr>
                        <button class='btn btn-primary' id='btn-request' style='width:100%'>Atender Solicitud</button>`,
                    width: '80%',
                    confirmButtonText: "Continuar",  
                    showCancelButton: false,
                    showConfirmButton: false,
                    allowEscapeKey: false,
                });
        }
    });
  });

$(document).on('click', '#btn-request', function() { 
    var text = 'La solicitud con número de radicado '+num_rad +' se encuentra en proceso.'; 
    var msg = '<html><body>';
    msg += '<p>Cordial saludo</p>';
    msg += '<p>Gracias por utilizar nuestro canal de PQR.</p>';
    msg += '<p>Su solicitud con número de radicado '+num_rad+' se encuentra en      Estado: <strong>En Proceso</strong></p>';
    msg += '<p>Cordialmente,</p>';
    msg += '<p>Empoobando E.S.P.</p>';
    msg += '</body></html>';
    changeStateRequest(text, 'En Proceso', area, email, msg);
});

$(document).on('click', '#progress', function() {  
    id = $(this).attr("data-id");     
    email = $(this).attr("data-email");
    area = $(this).attr("data-area");  
    num_rad = $(this).attr("data-num");
    var text = 'La solicitud con número de radicado '+num_rad +' se encuentra en proceso.'; 
    var msg = '<html><body>';
    msg += '<p>Cordial saludo</p>';
    msg += '<p>Gracias por utilizar nuestro canal de PQR.</p>';
    msg += '<p>Su solicitud con número de radicado '+num_rad+' se encuentra en Estado: <strong>En Proceso</strong></p>';
    msg += '<p>Cordialmente,</p>';
    msg += '<p>Empoobando E.S.P.</p>';
    msg += '</body></html>';
    changeStateRequest(text, 'En Proceso', area, email, msg);
});

$(document).on('click', '#finish', function() {  
    id = $(this).attr("data-id");     
    email = $(this).attr("data-email");
    area = $(this).attr("data-area");  
    num_rad = $(this).attr("data-num");    
    Swal.fire({
        title: 'Detalle de la solicitud',
        html: `
            <hr>            
            <center><div class="form-group">
            <textarea class="form-control" id="msg-answer" rows="3"></textarea>
          </div></textarea></center>
            <hr>
            <button class='btn btn-primary' id='btn-answer' style='width:100%'>Responder Solicitud</button>`,
        width: '80%',
        confirmButtonText: "Continuar",  
        showCancelButton: false,
        showConfirmButton: false,
        allowEscapeKey: false,
    });
}); 

$(document).on('click', '#btn-answer', function() {     
    var text = 'La solicitud con número de radicado '+num_rad +' se encuentra finalizada.';
    var answer = $("#msg-answer").val();
    var msg = '<html><body>';
    msg += '<p>Cordial saludo</p>';
    msg += '<p>Gracias por utilizar nuestro canal de PQR. </p>';
    msg += '<p>Se informa que su solicitud con número de radicado ' +num_rad+ ' se encuentra Estado: <strong>Finalizado</strong>, y su respuesta es: \n</p>';
    msg += '<p>'+answer+'</p>';
    msg += '<p>Cordialmente,</p>';
    msg += '<p>Empoobando E.S.P.</p>';
    msg += '</body></html>';
    changeStateRequest(text, 'Finalizada', area, email, msg);
});
  
function changeStateRequest(text, state, area, email, msg){
    $.ajax({    
        type: "POST",
        url: "../../php/change-state.php",             
        dataType: "html",                
        data: {id:id,state:state},
        success: function(response){
            if(response)
            {
                load(1,0);
                sendEmail(area, email,msg);
                getResult('Trámite de solicitud', text);
            }
            else
                getResult("Error petición","No es posbile procesar respuesta de solicitud.")
        }
    });
}

function sendEmail(area, email, msg){
    $.ajax({   
        type: "POST",
        url: "../../php/send-email.php", 
        data: {area:area,email:email,msg:msg},
        success: function(response){
            console.log(response);
        },
        error: function(errormessage) {
             alert('El correo no ha sido enviado: ' + errormessage);
        }
    });
}

function getResult(title, text) {
    Swal.fire({
        title: title,
        html: `
            <hr>
            <p>${text}</p>
            <hr>`,
        width: '40%',
        confirmButtonText: "Continuar",
        allowOutsideClick: false,
        allowEscapeKey: false,
    });
}
$(document).on('change', '#tipoRadicado', function() { 
    if($(this).val() == 'Anónimo'){
        $("#numDoc").val('');
        $("#nombre").val('');
        $("#apellido").val('');
        $("#direccion").val('');
        $("#telefono").val('');
        document.getElementById('tipoDoc').selectedIndex = 0;       
        $("#tipoDoc").attr('disabled', 'disabled');
        $("#numDoc").attr('disabled', 'disabled');
        $("#nombre").attr('disabled', 'disabled');
        $("#apellido").attr('disabled', 'disabled');
        $("#direccion").attr('disabled', 'disabled');
        $("#telefono").attr('disabled', 'disabled');
    }else{
        $("#tipoDoc").removeAttr('disabled');
        $("#numDoc").removeAttr('disabled');
        $("#nombre").removeAttr('disabled');
        $("#apellido").removeAttr('disabled');
        $("#direccion").removeAttr('disabled');
        $("#telefono").removeAttr('disabled');
    }
});

$(document).on('click', '#btn-logout', function() { 
    $.ajax({
        type: "POST",
        url: "../../php/logout.php",
        success: function(data){
            window.location.href = "../../index.php";
        }        
    });
});