<?php
/**
 * Created by Hrishikesh
 * Date: 28/12/12
 * Time: 11:00 AM
 */


include_once "dbconnection.php";
/**
 * File Uploader Class
 */
class FileUploader
{
    /**
     * @var string
     */
    private  $uploadPath;

    /**
     * @var string
     */
    private $fileName;

    /**
     *@var string
     */
    private $actualFileName;

    /**
     * @var float
     */
    private $fileSize;
    /**
     * @var string
     */
    private $tmpFilePath;

    /**
     * @var DBConnection
     */
    private $dbConnect;

    /**
     * @param array $filesData
     * @param string $uploadDir
     */
    function __construct(array $filesData, $uploadDir = DEFAULT_UPLOAD_DIR)
    {
        $this->fileName = $filesData['name'];
        $this->uploadPath = ROOT . '/' . $uploadDir . '/';
        $this->tmpFilePath = $filesData['tmp_name'];
        $this->dbConnect = new DBConnection();
    }

    /**
     * @param  $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }



    /**
     * @return float
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * @param string $uploadPath
     */
    public function setUploadPath($uploadPath)
    {
        $this->uploadPath = $uploadPath;
    }

    /**
     * @return string
     */
    public function getUploadPath()
    {
        return $this->uploadPath;
    }


    /**
     * @return mixed
     */
    public function getTmpFilePath()
    {
        return $this->tmpFilePath;
    }


    /**
     * Returns actual name of file
     * @return string
     */
    private function setActualFileName()
    {
        if(!is_dir($this->getUploadPath())) {
            mkdir($this->getUploadPath(), 0755);
        }
        $actualFileName = $this->getFileName();
        if(file_exists($this->getUploadPath() . $this->getFileName())) {
            $actualFileName = $this->getFileName() . '_' . time();
        }

        $this->actualFileName = $actualFileName;
    }

    /**
     * @return string
     */
    public function getActualFileName()
    {
        return $this->actualFileName;
    }

    /**
     * @return string
     */
    public function getUploadFilePath()
    {
        $this->setActualFileName();
        return $this->getUploadPath() . $this->getActualFileName();
    }


    /**
     * Uploads file on server
     * @param bool $saveMetaInfo
     * @return array
     */
    public function uploadFile($saveMetaInfo = false)
    {
        $uploadFilePath = $this->getUploadFilePath();
        if(move_uploaded_file($this->getTmpFilePath(), $uploadFilePath))
        {
            $this->fileSize = filesize($uploadFilePath);

            $response = array(
                'filename'=> $this->getFileName(),
                'actualFileName'=> $this->getActualFileName(),
                'filePath'=> $uploadFilePath,
                'message'=> 'Upload Successful',
                'size' => $this->fileSize,
                'response'=> true
            );
            if($saveMetaInfo) {
                if($id = $this->saveMetaInfo()) {
                   $response['id']= $id;
                }
            }
        } else {
            $response = array(
                'filename'=> $this->getFileName(),
                'message'=> 'Error While Uploading',
                'response'=> false
            );
        }

        return $response;
    }

    /**
     * Saves meta info of file in Database
     * @return bool|string
     */
    private function saveMetaInfo()
    {
        $query = sprintf('INSERT INTO uploads_meta(file_name, file_actual_name, file_path, file_size) VALUES("%s","%s","%s",%f)',
            $this->getFileName(),$this->getActualFileName(),$this->getUploadFilePath(),$this->getFileSize());
        
        if($lastInsertId = $this->dbConnect->insertData($query)) {
            return $lastInsertId;
        }
        return false;
    }


    /**
     * To get the list of available drivers
     * This is the test function not used in functionality
     */
    public function getPdoAvailableDrivers()
    {
        foreach(PDO::getAvailableDrivers() as $driver)
        {
            echo $driver.'\n';
        }
    }


}
