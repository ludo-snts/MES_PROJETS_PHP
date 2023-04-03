<?php

require_once 'Genre.php';
require_once 'Role.php';


class Personne {
    private int $id = -1;
    private string $prenom;
    private string $nom;
    private string $mail;
    private int $age;
    private Genre $genre;
    private Role $role;

    // GETTER ID
    public function getId() {
        return $this->id;
    }

    // SETTER ID
    public function setID($id) {
        $this->id = $id;
    }

    // GETTER PRENOM
    public function getPrenom() {
        return $this->prenom;
    }
    // SETTER PRENOM
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    // GETTER NOM
    public function getNom() {
        return $this->nom;
    }
    // SETTER NOM
    public function setNom($nom) {
        $this->nom = $nom;
    }

    // GETTER MAIL
    public function getMail() {
        return $this->mail;
    }
    // SETTER MAIL
    public function setMail($mail) {
        $this->mail = $mail;
    }

    // GETTER AGE
    public function getAge() {
        return $this->age;
    }
    // SETTER AGE
    public function setAge($age) {
        $this->age = $age;
    }

    // GETTER GENRE
    public function getGenre(): Genre {
        return $this->genre;
    }
    // SETTER GENRE
    public function setGenre(Genre $genre) {
        $this->genre = $genre;
    }

    // GETTER GENRE
    public function getRole(): Role {
        return $this->role;
    }
    // SETTER GENRE
    public function setRole(Role $role) {
        $this->role = $role;
    }

    // CONSTRUCTEUR
    public function __construct() {
        $this->genre = new Genre();
        $this->role = new Role();
    }

    // TOSTRING
    public function __toString() {
        $str = 
        " - Id: " . $this->id . 
        " - Prenom: " . $this->prenom . 
        "-  Nom: " . $this->nom . 
        " - Mail: " . $this->mail . 
        " - Age: " . $this->age . 
        " - Genre: " . $this->genre;
        " - Role: " . $this->role;
        return $str;
    }

}