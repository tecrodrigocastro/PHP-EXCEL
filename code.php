<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if(isset($_POST[save_excel_data]))
{
    $file_name = $_FILES['import_file']['name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

    $allowed_ext = ['kls','csv','xlsx'];
    
    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $spreadsheet->getActiveSheet()->toArray();
    }
    else
    {
        $_SESSION['message'] = "Arquivo Invalido";
        header('Location: index.php');
        exit(0);
    }

}

?>