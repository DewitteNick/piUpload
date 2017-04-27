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

    public function getPass($username) {
        $passCrypt = "";
        try {
			$sql = "select password from upload.users where username like :username";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			$login = $stmt->fetchAll(PDO::FETCH_COLUMN);
			if(!empty($login)) {
				$login = $login[0];
			} else {
				echo "<div class='error'><p>Failed to fetch login</p></div>";
				$login = "";
			}
			$passCrypt = $login;
		}catch(PDOException $e) {
        	die($e->getMessage());
		}
		return $passCrypt;
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
                $sql = "insert into upload.users (username, password) values (:username, :password);";
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
            $stmt->bindParam(":filecode",$file['type']);
            $stmt->bindParam(":filename",$file['name']);
            $stmt->execute();
        }catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllFiles($name) {
        $files = [];
        try{
            $sql = "select filename from upload.files where username like :username";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(":username", $name);
            $stmt->execute();
            $resultSet = $stmt->fetchAll(PDO::FETCH_COLUMN);
            foreach($resultSet as $file) {
                array_push($files, $file);
            }
        }catch(PDOException $e) {
            die($e->getMessage());
        }
        return $files;
    }

    public function checkValidity($file, $name) {
        $valid = false;
        try{
            $sql = "select username from upload.files where filename like :filename";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(":filename", $file);
            $stmt->execute();
            $resultSet = $stmt->fetchAll(PDO::FETCH_COLUMN);
            $resultSet = $resultSet[0];
            if($resultSet == $name) {
                $valid = true;
            }
        }catch(PDOException $e) {
            die($e->getMessage());
        }
        return $valid;
    }

    public function removeFile($file, $username) {
    	try {
    		$sql = "delete from upload.files where filename like :filename and username like :username";
    		$stmt = $this->dbh->prepare($sql);
    		$stmt->bindParam(":filename", $file);
    		$stmt->bindParam(":username", $username);
    		$stmt->execute();
		}catch(PDOException $e) {
    		die($e->getMessage());
		}
	}

	public function renameFile($file, $newfile, $username) {
    	//TODO
	}

	public function saveSetting($setting, $state, $username) {
//    	"select * from upload.settings where username like :username ";
	}

}


























