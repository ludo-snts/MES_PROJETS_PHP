<?php

require_once("Voiture.php");
require_once("Garage.php");

$voiture1 = new Voiture("Peugeot", "107");
// echo  "Véhicule de marque ".$voiture1->marque." et de modèle ".$voiture1->modele.PHP_EOL;
// echo  "Véhicule de marque ".$voiture1->getMarque()." et de modèle ".$voiture1->getModele().PHP_EOL;
// echo $voiture1;

$voiture2 = new Voiture("Ferrari", "Rouge");
// echo  "Véhicule de marque ".$voiture2->marque." et de modèle ".$voiture2->modele.PHP_EOL;
// echo  "Véhicule de marque ".$voiture2->getMarque()." et de modèle ".$voiture2->getModele().PHP_EOL;
// echo $voiture2;


$voiture3 = new Voiture("Ford", "Mustang");
// echo  "Véhicule de marque ".$voiture3->marque." et de modèle ".$voiture3->modele.PHP_EOL;
// echo  "Véhicule de marque ".$voiture3->getMarque()." et de modèle ".$voiture3->getModele().PHP_EOL;
// echo $voiture3;

// $voiture3->setMarque("Wolkswagen");
// $voiture3->setModele("Coccinelle");

// echo  "SET : Véhicule de marque ".$voiture3->getMarque()." et de modèle ".$voiture3->getModele().PHP_EOL;

// // Déclaration d'un tableau vide
// $garage = array();

// $garage[$voiture1];
// $garage[$voiture2];
// $garage[$voiture3];

// foreach ($garage as $voiture) {
//     echo $voiture;
// };

$garage = new Garage();
$garage->ajouterVoiture($voiture1);
$garage->ajouterVoiture($voiture2);
$garage->ajouterVoiture($voiture3);

// print_r($garage);
echo $garage;
