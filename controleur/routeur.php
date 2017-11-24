<?php

require_once 'controleurAuthentification.php';



class Routeur {

  private $ctrlAuthentification;


  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();
  }

  // Traite une requête entrante
  public function routerRequete() {
    $this->ctrlAuthentification->accueil();

    if ((isset($_POST['pseudo'])) && $_POST['password']) {
      $this->ctrlAuthentification->verif($_POST['pseudo'], $_POST['password']);
    }
 }


 }




?>
