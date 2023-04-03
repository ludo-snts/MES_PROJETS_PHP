<?php
class Connexion {
private $driver, $host, $user, $pass, $database, $charset;

    public function __construct()
    {
        $this->driver="mysql";
        $this->host="localhost";
        $this->user="root";
        $this->pass="";
        $this->database="db_testv4";
        $this->charset="utf8";
    }

    public function getConnection(){
        $dsn= $this->driver.':host='.$this->host.';dbname='.$this->database.';charset='.$this->charset ;

        try{
            $connection= new PDO($dsn,$this->user,$this->pass);
            return $connection;
        } catch (PDOException $e) {
            throw new Exception ("Impossible d'etablir la connection à la BD");
        }
    }
}