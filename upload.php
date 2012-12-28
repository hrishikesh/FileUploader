<?php
/**
 * Created by Hrishikesh
 * Date: 27/12/12
 * Time: 5:37 PM
 */

include_once "classes/fileuploader.php";

error_reporting(E_ALL);

ini_set("memory_limit", "1024M" );
define('ROOT', dirname(__FILE__));
define("DEFAULT_UPLOAD_DIR", 'uploads');


$fileUploader = new FileUploader($_FILES['mf_file_aupload']);
$response = $fileUploader->uploadFile(true);
echo json_encode($response);die;








