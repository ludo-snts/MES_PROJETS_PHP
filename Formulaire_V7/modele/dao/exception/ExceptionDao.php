<?php

// NAMESPACE
namespace modele\dao\exception;
//AUTOLOADER
require_once '../autoloader.php';

class ExceptionDao extends \Exception {

    public function __construct($message = NULL, $code = 0) {
        // Appel du constructeur de la classe mère (Exception)
        parent::__construct($message, $code);
        // $this->timestamp = time();

    }

    // Fonction getter pour la date à laquelle a eu lieu l’exception
    // public function getTimestamp() {
    //     return $this->timestamp;
    // }
}
