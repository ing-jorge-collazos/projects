$(function() {
    $("#username").focus();
});

$('#password').on('keypress', function (e) {
    if(e.which === 13){
        sendForm();
    }
});

$(document).on('click', '#btn-login', function() { 
    sendForm();
});

function sendForm()
{
    var username=$("#username").val();
    var password=$("#password").val();
    var dataString = 'user='+username+'&pass='+password;
    var formData = new FormData();

    $("#error-pass").css('color','red');
    $("#error-user").css('color','red');

    if($.trim(username).length==0 && $.trim(password).length==0){
        $("#error-user").text('Campo obligatorio');       
        $("#error-pass").text('Campo obligatorio');        
    }else if($.trim(username).length==0){
        $("#error-user").text('Campo obligatorio');
    }
    else if($.trim(password).length==0){
        $("#error-user").text('');
        $("#error-pass").text('Campo obligatorio');
    }else
    //if($.trim(username).length>0 && $.trim(password).length>0)
    {
        $("#error-user").text('');
        $("#error-pass").text('');

        formData.append('user',username);
        formData.append('pass',password);

        $.ajax({
            type: "POST",
            url: "php/login.php",
            dataType: "html", 
            data: formData,              
            contentType: false,       
		    cache: false,            
			processData:false,  
            //beforeSend: function(){ $("#btn-login").val('Conectando...');},
            success: function(data){
                console.log(data);
                if(data)
                {
                    console.log('2');
                    $("body").load("./views/admin/").hide().fadeIn(1500).delay(6000);
                    //or
                    $("#error-pass").text('');
                    window.location.href = "./views/admin/";
                }
                else
                {
                    console.log('3');
                    $("#error-pass").text('Usuario y/o contraseña incorrecto.');                              
                    //alert('Usuario y/o contraseña incorrecto.');
                }
            }
        });
    }
}