<?php

namespace modele\dao;

class Connexion
{
    private $driver, $host, $user, $pass, $database, $charset;

    public function __construct()
    {
        $this->driver = 'mysql';
        $this->host = 'localhost';
        $this->user = 'root';
        $this->pass = '';
        $this->database = 'db_test_2';
        $this->charset = 'utf8';
    }

    public function getConnexion() {
        $dsn= $this->driver.':host='.$this->host.';dbname='.$this->database.';charset='.$this->charset;

        try {
            $connexion = new \PDO($dsn, $this->user, $this->pass);
            return $connexion;

        } catch (\PDOException $e) {
            throw new \Exception('Impossib de se connecter à la BDD');
        }
    }
}
