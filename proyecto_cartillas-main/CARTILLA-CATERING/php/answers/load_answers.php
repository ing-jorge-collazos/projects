<?php
if (isset($_POST['unit'])){    
    session_start();
    if($ses=$_SESSION['usuario']){
        $file = '../../content/files/answers/'.$ses.'/'.'unit'.$_POST['unit'].'.txt';
        $abrir = fopen($file,'r');
        if ($abrir) {
            $data = null; 
            $test = $_POST['test'];
            $lines = explode("|", file_get_contents($file));        
            unset($lines[count($lines)-1]);
            foreach ($lines as $key => $value) {
                $item = json_decode($value,true);
                if($item['id']===$test)
                {
                    $data = $value;
                    break;
                }                           
            }  
            fclose($abrir);
            echo json_encode(array('success' => 1,'jsonData'=>$data));
        }
    }
} else {
    echo json_encode(array('success' => 0));
}