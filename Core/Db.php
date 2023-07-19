<?php
namespace App\Core;
use PDO;
use PDOException;

//Renommez le fichier cred_example en credentials.php puis remplissez les données correctement
require_once "credentials.php";



class Db extends PDO
{
    //Instance unique de la classse
    private static $instance;

    //Constante de connexion à la BDD
    private const DBHOST = db_host; //mac 127.0.0.1
    private const DBUSER = db_user;
    private const DBPASS = db_pass;
    private const DBNAME = db_name;

    private function __construct()
    {
        //DSN de connexion
        $dsn = "mysql:dbname=" . self::DBNAME . ";host=" . self::DBHOST;

        try {
            //On appelle le constructeur de la classe PDO
            parent::__construct($dsn, self::DBUSER, self::DBPASS);

            //On paramètre les infos que l'on transmet et reçoit de la BDD
            //et les retours d'erreurs
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e){
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


}
