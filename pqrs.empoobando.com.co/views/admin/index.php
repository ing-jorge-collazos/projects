<?php
session_start();
if (!isset($_SESSION['login_user'])) {
  header('Location: ../index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PQRS - Administración</title>

  <!-- CSS de Bootstrap -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="../../css/styles.css" rel="stylesheet" media="screen">
</head>

<body>
  <header>
    <div id="img-content">
      <img id="img-header" src="../../images/banner.png" class="img-fluid" alt="Header Image">
    </div>
  </header>
  <main>
    <div class="container">
      <div class="table-wrapper">
        <div class="table-title">
          <div class="row">
            <div class="col-sm-6">
              <h2>Administrar <b>PQRS</b></h2>
            </div>
            <div class="col-sm-6">
              <a id="btn-logout" href="#" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xe906;</i> <span>Cerrar Sesión</span></a>
              <a id="btn-stats" href="#" class="btn btn-info" data-toggle="modal"><i class="material-icons">&#xe8e5;</i> <span>Estadisticas</span></a>
              <a id="btn-pqrs" href="#" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xf1c3;</i> <span>PQRS</span></a>
            </div>
          </div>
        </div>
        <div class='clearfix'></div>
        <div class='col-sm-4 pull-right' id="search-content">
          <div id="custom-search-input">
            <div class="input-group col-md-12">
              <input type="text" class="form-control" placeholder="Buscar" id="q" onkeyup="load(1,0);" />
              <span class="input-group-btn">
                <button class="btn btn-info" type="button" onclick="load(1,0);">
                  <span class="glyphicon glyphicon-search">Buscar</span>
                </button>
              </span>
            </div>
          </div>
        </div>
        <div class='col-sm-8' id="date-content">
          <div id="custom-search-input">
            <div class="input-group col-md-12">
              <input type="date" class="form-control" placeholder="Fecha Inicial" id="dateStart"/>
              <input type="date" class="form-control" placeholder="Fecha Final" id="dateEnd"/>
              <span class="input-group-btn">
                <button class="btn btn-info" type="button" id="btn-filter">
                  <span class="glyphicon glyphicon-search">Filtrar</span>
                </button>
              </span>
            </div>
          </div>
          <div class='clearfix'></div>
        </div>      
        <div id="content-filter">
          <div id="loader"></div><!-- Carga de datos ajax aqui -->
          <div id="resultados"></div><!-- Carga de datos ajax aqui -->
          <div class='outer_div'></div><!-- Carga de datos ajax aqui -->
        </div> 
      </div>
    </div>
  </main>
  <footer></footer>
  <script src="../../js/jquery-3.5.1.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/sweetalert2.all.min.js"></script>
  <script src="../../js/scripts.js"></script>
</body>

</html>