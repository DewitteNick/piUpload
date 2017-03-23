<?php

/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 21/03/2017
 * Time: 22:11
 */
class Upload_db
{

    private static $upload_dbInstance = null;

    private $dbh;

    private function __construct() {
        try{
            $config = Config::getConfigInstance();
            $server = $config->getServer();
            $database = $config->getDatabase();
            $username = $config->getUsername();
            $password = $config->getPassword();

            $this->dbh = new PDO("mysql:host=$server; dbname=$database", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $_SESSION['sql'] = "set";   //TODO remove this
        }catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getUploadInstance() {
        if(is_null(self::$upload_dbInstance)) {
            self::$upload_dbInstance = new Upload_db();
        }
        return self::$upload_dbInstance;
    }

    public function closeConnection() {
        $this->dbh = null;
    }

    //TODO sql functions here

    public function checkLogin($username, $password) {
        $valid = false;
        try {
            $sql = "select * from upload.users where username like :username";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $login = $stmt->fetchAll(PDO::FETCH_OBJ);
            if(!empty($login)) {
                $login = $login[0];
                if ($login->password == $password) {
                    $valid = true;
                }
            }
        }catch(PDOException $e){
            die($e->getMessage());
        }
        return $valid;
    }

    public function registerUser($username, $password) {
        $success = false;
        try{
            $sql = "select * from upload.users where username like :username";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $resultset = $stmt->fetchAll(PDO::FETCH_OBJ);
            if(empty($resultset)) {
                $sql = "insert into upload.users values (:username, :password);";
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $password);
                $stmt->execute();
                $success = true;
            }
        }catch(PDOException $e) {
            die($e->getMessage());
        }
        return $success;
    }

    public function addFile($file) {
        try{
            $sql = " insert into upload.files(username, filecode, filename) values (:username,:filecode,:filename)";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(":username",$_SESSION['name']);
            $stmt->bindParam(":filecode",$file['name']);
            $stmt->bindParam(":filename",$file['name']);
            $stmt->execute();
        }catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllFiles($user) {
        $files = null;

        return $files;
    }

}

























