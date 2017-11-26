<?php

require_once 'controleurAuthentification.php';
require_once 'controleurPartie.php';




class Routeur {

  private $ctrlAuthentification;
  private $ctrlPartie;



  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();
    $this->ctrlPartie = new ControleurPartie();

  }

  // Traite une requête entrante
  public function routerRequete() {
    if ((isset($_POST['pseudo'])) && $_POST['password']) {
      $this->ctrlAuthentification->verif($_POST['pseudo'], $_POST['password']);
      return;
    }

    if (isset($_POST['jouer'])) {
      $this->ctrlPartie->nouvellePartie($_POST['coordonnees_remove_x'],$_POST['coordonnees_remove_x']);
      return;
    }

    $this->ctrlAuthentification->accueil();
 }


 }




?>
