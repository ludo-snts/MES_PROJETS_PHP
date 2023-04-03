<?php

require_once 'Genre.php';
require_once 'Role.php';

class Personne
{
    ////////***ATTRIBUT */
    private int $id = -1; /* id est creer dans la base de donné la valeur doit etre defini dans la construction */
    private string $prenom;
    private string $nom;
    private string $mail;
    private int $age;
    private Genre $genre ;
    private Role $role ;
    private string $username ; 
    private string $password ; 
    
    
    

    ///////*******CONSTRUCTION *******************///////////////////

    public function __construct($prenom, $nom, $mail, $age,$username,$password)
    {
        // $this->id;  /* la base de donnée va incrementer l' id */
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->mail = $mail;
        $this->age = $age;
        $this->username = $username;
        $this->password = $password;
        $this->genre = new Genre();
        $this->role = new Role();
        
        
    }
    //////////***********SETTER*****************////////////////////z


    public function setId($id)
    {
        $this->id = $id;
    }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    public function setMail($mail)
    {
        $this->mail = $mail;
    }
    public function setAge($age)
    {
        $this->age = $age;
    }
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    ////**************GETTER ******************************////////


    public function getId()
    {
        return $this->id;
    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function getMail()
    {
        return $this->mail;
    }
    public function getAge()
    {
        return $this->age;
    }
    public function getGenre()
    {
        return $this->genre;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    

///*****RETRANSCRIRE TOUT EN STRING  */

    public function __toString()
    {
        //  $this->id .
        $retour = "Personne : " . " - " .$this->nom . " - " .$this->prenom . " - " . $this->mail . " - " .$this->age . " - ". $this->username . " - " . 
        $this->password. " - " . $this->genre . " - " . $this->role;

        return $retour ;
    }
}
