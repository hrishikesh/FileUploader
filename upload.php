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








