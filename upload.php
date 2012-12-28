<?php
/**
 * Created by Hrishikesh
 * Date: 27/12/12
 * Time: 5:37 PM
 */

include_once "classes/fileuploader.php";

error_reporting(E_ALL);

$fileUploader = new FileUploader($_FILES['mf_file_aupload']);
$fileUploader->uploadFile();

//$fileUploader->getPdoAvailableDrivers();

/*ini_set("memory_limit", "1024M" );

define("UPLOAD_DIR", dirname(__FILE__) . '/uploads/');


$file = $_FILES['mf_file_aupload'];

$filePath = UPLOAD_DIR.$file['name'];




if(move_uploaded_file($file['tmp_name'], $filePath)) {
    echo json_encode(array('filename'=>$file['name'], 'filePath'=>$filePath,'message'=>'Upload Successful', 'size'=>filesize($filePath)));die;
}*/








