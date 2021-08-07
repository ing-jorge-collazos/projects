<?php
if (isset($_POST['data']) && isset($_POST['unit'])) {
    session_start();
    if ($ses = $_SESSION['usuario']) {
        $file = '../../files/answers/' . $ses . '/' . 'unit' . $_POST['unit'] . '.txt';
        $archivo = file($file);
        $insert = false;
        print_r($archivo);

        if ($archivo) {
            $lines = explode("|", file_get_contents($file));
            $test = $_POST['test'];
            //unset($lines[count($lines) - 1]);
            foreach ($lines as $key => $value) {
                $item = json_decode($value);
                if ($item[0]->id === $test) {
                    $insert = false;
                    $archivo[$key] = $_POST['data'] . '|';
                    break;
                } else {
                    $insert = true;
                }
            }

            if ($insert) {
                $abrir = fopen($file, 'a+');
                fwrite($abrir, PHP_EOL);
                fwrite($abrir, trim($_POST['data']) . '|');                
                fclose($abrir);
                echo 1;
            } else {
                $abrir = fopen($file, 'w');
                foreach ($archivo as $key => $value) {
                    fwrite($abrir, trim($value));
                    print_r($value);
                    fwrite($abrir, PHP_EOL);
                }
                file_put_contents($file, rtrim(file_get_contents($file)));
                fclose($abrir);
                echo 1;
            }
        } else {
            $abrir = fopen($file, 'w');
            fwrite($abrir, $_POST['data'] . '|');
            fclose($abrir);
            echo 1;
        }
    }
} else 
    echo 0;
