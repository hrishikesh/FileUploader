<?php
/**
 * Created by Hrishikesh
 * Date: 28/12/12
 * Time: 1:03 PM
 */
class DBConnection
{
    const HOSTNAME = 'localhost';
    const USERNAME = 'root';
    const PASSWORD = 'root';
    const DBNAME = 'uploads';

    private $dbConnection;

    function __construct()
    {
        try {
            $this->dbConnection = new PDO("mysql:host=".self::HOSTNAME.";dbname=".self::DBNAME, self::USERNAME, self::PASSWORD);
            /*** echo a message saying we have connected ***/
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * @param $query
     */
    public function insertData($query)
    {
        $count = $this->dbConnection->exec($query);


        if($count > 0) {
            return $this->dbConnection->lastInsertId();
        }

        return false;
    }

    /**
     * To Close Connection
     */
    public function closeConnection()
    {
        $this->dbConnection = null;
    }
}
