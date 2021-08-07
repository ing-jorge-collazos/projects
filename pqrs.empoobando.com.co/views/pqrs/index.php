<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PQRS - Entrada Web</title>

    <!-- CSS de Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../css/styles.css" rel="stylesheet" media="screen">
  </head>
  <body style="background: linear-gradient(rgba(255,255,255,1), rgba(224,224,224,1));">
    
    <header>
    
      <div id="img-content"> 
      <br></br>
          <a href="http://www.empoobando.com.co">
      <center><img id="img-header" src="../../images/banner.png" class="img-fluid" alt="Header Image"></center>
        </a>
        <br></br>
      </div>
    </header>
    <main>
      <div id="form-content">
        <form id="form" action="" method="POST">
          <div id="title-form">
            <span>Formulario de Ingresos de PQR</span>
          </div>
          <section>
            <div id="subtitle-form">
              <span>PQR ingresada por la página web</span>
            </div>
            <div class="form-group">
              <label for="modRadicado">Modo de radicado</label>
              <select class="form-control" id="modRadicado" disabled>
                <option>Página Web</option>              
              </select>
            </div>
          </section>
          <section>
            <div id="subtitle-form">
              <span>Para crear su solicitud, sírvase diligenciar los siguientes campos:</span>
            </div>
            <div class="form-group">
              <label for="tipoRadicado">Tipo de radicación</label>
              <select class="form-control" id="tipoRadicado">
                <option>Ciudadano</option>
                <option>Organización</option>
                <option>Anónimo</option>
              </select>
            </div>
          </section>
          <section>
            <div id="subtitle-form">
              <span>Diligencie sus datos personales</span>
            </div>
            <div class="form-group">
              <label for="tipoDoc">Tipo de documento</label>
              <select class="form-control" id="tipoDoc" name="tipoDoc">
                <option>Cédula de ciudadanía</option>
                <option>Cédula de extranjería</option>
                <option>Tarjeta de identidad</option>
                <option>Pasaporte</option>
                <option>Otro</option>
              </select>
            </div>          
            <div class="form-group">
              <label for="numDoc">Número de documento</label>
              <input type="text" class="form-control" id="numDoc" name="numDoc">
            </div>
            <div class="form-group">
              <label for="nombre">Nombres</label>
              <input type="text" class="form-control" id="nombre" name="name">
            </div>
            <div class="form-group">
              <label for="apellido">Apellidos</label>
              <input type="text" class="form-control" id="apellido" name="lastname">
            </div>
            <div class="form-group">
              <label for="direccion">Dirección de residencia</label>
              <textarea class="form-control" id="direccion" rows="3" name="address"></textarea>
            </div>   
            <div class="form-group">
              <label for="telefono">Teléfono</label>
              <input type="text" class="form-control" id="telefono" name="phone">
            </div>         
          </section>
          <section>
            <div id="subtitle-form">
              <span>El correo electrónico es el medio por donde se le notificara, el número de radicado, para que usted verifique el estado de su PQR, además recibirá la respuesta a su proceso.</span>
            </div>
            <div id="subtitle-form">
              <span>Para recibir una respuesta a su PQR ingrese su correo electrónico.</span>
            </div>
            <div class="form-group">
              <label for="email">Correo electrónico de notificación</label>
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
            </div>
          </section>
          <section>
            <div id="subtitle-form">
              <span>Petición: es el derecho fundamental que tiene toda persona a presentar solicitudes respetuosas a las autoridades por motivos de interés general o particular y a obtener su pronta resolución.</span>
            </div>
            <div id="subtitle-form">
              <span>Queja: es la manifestación de protesta, censura, descontento o inconformidad que formula una persona en relación con una conducta que considera irregular de uno o varios servidores públicos en desarrollo de sus funciones.</span>
            </div>
            <div id="subtitle-form">
              <span>Reclamo: es el derecho que tiene toda persona de exigir, reivindicar o demandar una solución, ya sea por motivo general o particular, referente a la prestación indebida de un servicio o a la falta de atención de una solicitud.</span>
            </div>
          </section>
          <section>
            <div id="subtitle-form">
              <span>Información de la solicitud</span>
            </div>
            <div class="form-group">
              <label for="tipoSolicitud">Tipo de solicitud</label>
              <select class="form-control" id="tipoSolicitud">
                <option>Petición</option>
                <option>Queja</option>
                <option>Reclamo</option>
                <option>Solicitud</option>   
              </select>
            </div>
            <div class="form-group">
              <label for="asunto">Asunto</label>
              <input type="text" class="form-control" id="asunto" name="subject">
            </div>
            <div class="form-group">
              <label for="exampleFormControarealSelect1">Área</label>
              <select class="form-control" id="area">
                <option>Proyectos</option>
                <option>Operación</option>
                <option>Atención al usuario</option>                
                <option>Daños</option>   
              </select>
            </div>
            <div class="form-group">
              <label for="mensaje">Formule su solicitud de forma clara, precisa, breve y respetuosa</label>
              <textarea class="form-control" id="mensaje" rows="3" name="message"></textarea>
            </div> 
            <div class="form-group">
              <label for="archivo">Anexar archivos (Opcional) Formatos: jpg,png,jpeg,doc,docx,pdf</label>
              <input type="file" class="form-control-file" id="archivo" name="file">
            </div>
          </section>
          <section>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="chbPoliticas" name="privacy">
                <label class="form-check-label" for="chbPoliticas">Acepto las politicas de privacidad <a href="https://www.empoobando.com.co/2108-2/" target="_blank">Leer</a></label>
            </div>
          </section>
          <br>
          <button class="btn btn-primary btn-block" id="btn-send" type="button">Enviar</button>
        </form>
      </div>
    </main>
    <footer></footer>
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/sweetalert2.all.min.js"></script>
    <script src="../../js/jquery.validate.min.js"></script>
    <script src="../../js/scripts.js"></script>
  </body>
  <div class="form-check">
   <br></br>
  </div>
</html>