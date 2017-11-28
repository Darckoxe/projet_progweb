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

    if ((isset($_POST['coordonnees_remove_x'])) && (isset($_POST['coordonnees_remove_y']))) {
      $this->ctrlPartie->supprimerBille($_POST['coordonnees_remove_x'],$_POST['coordonnees_remove_y']);
      return;
    }



    if(isset($_POST['coordonnees_tomove_x']) && isset($_POST['coordonnees_tomove_y'])){
      $this->ctrlPartie->selectionnerBille($_POST['coordonnees_tomove_x'], $_POST['coordonnees_tomove_y']);
      return;
    }

    if (isset($_POST['coordonnees_moved_x']) && isset($_POST['coordonnees_moved_y'])) {
      $this->ctrlPartie->deplacerBille($_POST['coordonnees_moved_x'],$_POST['coordonnees_moved_y']);
      $this->ctrlPartie->testVictoire();
      return;
    }

    $this->ctrlAuthentification->accueil();
 }


 }




?>
