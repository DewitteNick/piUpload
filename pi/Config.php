<?php

/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 21/03/2017
 * Time: 22:04
 */
class Config
{

    private static $configInstance = null;

    private $server;
    private $database;
    private $username;
    private $password;

    private $mimetypes;
    private $uploadfolder;

    private function __construct() {
        $this->server = "localhost";
        $this->database = "upload";
        $this->username = "upload";
        $this->password = "upload";

        $this->mimetypes = array(
			"application/json",
        	"application/pdf",
        	"image/jpg",
        	"image/png",
			"text/css",
			"text/html",
			"text/plain",
			"text/xml"
		);
        $this->uploadfolder = "assets/media/upload";
    }

    public static function getConfigInstance() {
        if(is_null(self::$configInstance)) {
            self::$configInstance = new Config();
        }
        return self::$configInstance;
    }

    public function getServer()
    {
        return $this->server;
    }
    public function getDatabase()
    {
        return $this->database;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getUploadFolder()
    {
        return $this->uploadfolder;
    }
    public function getMimetypes()
    {
        return $this->mimetypes;
    }

}