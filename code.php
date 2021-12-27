<?php
session_start();
include_once("conection.php");
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if(isset($_POST['save_excel_data']))
{
    $file_name = $_FILES['import_file']['name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

    $allowed_ext = ['kls','csv','xlsx'];
    
    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count ="0";

        foreach($data as $row)
        {
            if($count > 0)
            {

            
            $fullname = $row['0'];
            $email = $row['1'];
            $phone = $row['2'];
            $course = $row['3'];

            $studentQuery = "INSERT INTO students (fullname,email,phone,course)
             VALUES ('$fullname','$email','$phone','$couse')";

             $result = mysqli_query($conn, $studentQuery);
             $msg = true;
            }
            else
            {
                $count = "1";
            }
        }

        if(isset($msg))
        {
        $_SESSION['message'] = "Importado com sucesso";
        header('Location: index.php');
        exit(0);
        }
        else
        {
            $_SESSION['message'] = "Não Importado";
            header('Location: index.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['message'] = "Arquivo Invalido";
        header('Location: index.php');
        exit(0);
    }

}

?>