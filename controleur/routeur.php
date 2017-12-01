<?php

require_once 'controleurAuthentification.php';
require_once 'controleurPartie.php';
require_once 'controleurStats.php';




class Routeur {

  private $ctrlAuthentification;
  private $ctrlPartie;
  private $ctrlStats;

  public function __construct() {
    $this->ctrlAuthentification= new ControleurAuthentification();
    $this->ctrlPartie = new ControleurPartie();
    $this->ctrlStats = new ControleurStats();
  }

  // Traite une requête entrante
  public function routerRequete() {
    if ((isset($_POST['pseudo'])) && $_POST['password']) {
      $this->ctrlAuthentification->verif($_POST['pseudo'], $_POST['password']);
      $_SESSION['pseudo'] = $_POST['pseudo'];
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
      // $this->ctrlPartie->testVictoire();
      return;
    }

    if (isset($_POST['nouvelle_partie'])) {
      $this->ctrlPartie->supprimerBille(null,null);
      return;
    }

    if (isset($_POST['inscription'])) {
      $this->ctrlAuthentification->inscription();
      return;
    }

    if((isset($_POST['pseudo_inscription'])) && isset($_POST['password_inscription'])){
      $this->ctrlAuthentification->confirmInscription($_POST['pseudo_inscription'],$_POST['password_inscription']);
      return;
    }

    if (isset($_GET['stats'])) {
      $this->ctrlStats->voirStats($_SESSION['pseudo']);
      return;
    }

    $this->ctrlAuthentification->connexion();
 }


 }




?>
