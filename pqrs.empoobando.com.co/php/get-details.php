<?php
    include('conexionDB.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];   
        
        $sql = "SELECT * FROM pqrs WHERE id ='$id'";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0){
            $rows = mysqli_fetch_row($result);
            $fileName = explode('/', $rows[16]);
            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Número de radicado: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>$rows[2]</span>";
            echo "</div>";
            echo "</div>";

            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Modo de radicado: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>$rows[3]</span>";
            echo "</div>";
            echo "</div>";

            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Tipo de radicado: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>$rows[4]</span>";
            echo "</div>";
            echo "</div>";

            $tipoDoc = $rows[5]==null?'N/A':$rows[5];
            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Tipo de Documento: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>$tipoDoc</span>";
            echo "</div>";
            echo "</div>";

            $ide = $rows[6]==null?'N/A':$rows[6];
            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Identificación: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>$ide</span>";
            echo "</div>";
            echo "</div>";

            $name = $rows[7]==null?'N/A':$rows[7].' '.$rows[8];
            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Nombre: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>$name</span>";
            echo "</div>";
            echo "</div>";

            $dir = $rows[9]==null?'N/A':$rows[9];
            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Dirección: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>$dir</span>";
            echo "</div>";
            echo "</div>";

            $tel = $rows[10]==null?'N/A':$rows[10];
            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Teléfono: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>$tel</span>";
            echo "</div>";
            echo "</div>";
           
            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Email: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>$rows[11]</span>";
            echo "</div>";
            echo "</div>";

            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Tipo de Solicitud: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>$rows[12]</span>";
            echo "</div>";
            echo "</div>";

            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Asunto: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>$rows[13]</span>";
            echo "</div>";
            echo "</div>";

            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Área: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>$rows[14]</span>";
            echo "</div>";
            echo "</div>";

            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Mensaje: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<p style='text-align:justify'>$rows[15]</p>";
            echo "</div>";
            echo "</div>";

            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Archivo: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>
                    <a target='_blank' href='../../$rows[16]'>
                    $fileName[1]
                    </a>
                  </span>";
            echo "</div>";
            echo "</div>";

            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Estado: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>$rows[17]</span>";
            echo "</div>";
            echo "</div>";

            echo "<div  class='row'>";
            echo "<div class='col-md-5'>";
            echo "<span class='pull-left'>Fecha de Solicitud: </span>";
            echo "</div>";
            echo "<div class='col-md-7'>";
            echo "<span class='pull-left'>$rows[19]</span>";
            echo "</div>";
            echo "</div>";
           
            //echo $rows[3];
        }else
            echo json_encode(array('status' => 0, 'message' => 'No se encuentra información del ID.','id'=>$id)); 
    }    
    else
        echo "Identificador no se ha enviado correctamente.";
?>