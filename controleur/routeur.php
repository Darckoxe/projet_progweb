<?php

require_once 'controleurAuthentification.php';



class Routeur {

  private $ctrlAuthentification;


  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();
  }

  // Traite une requête entrante
  public function routerRequete() {
    if ((isset($_POST['pseudo'])) && $_POST['password']) {
      $this->ctrlAuthentification->verif($_POST['pseudo'], $_POST['password']);
      return;
    }
    $this->ctrlAuthentification->accueil();
 }


 }




?>
