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

    if (isset($_GET['supprimerBille'])) {
      $this->ctrlPartie->supprimerBille($_GET['i'],$_GET['j']);
      $this->ctrlStats->incrementerPartieJouee($_SESSION['pseudo']);
      return;
    }

    if(isset($_GET['selectionnerBille'])) {
      $this->ctrlPartie->selectionnerBille($_GET['i'], $_GET['j']);
      return;
    }

    if(isset($_GET['selectionnerCase'])){ // On sélectionne la case où on veut déplacer la bille
      $this->ctrlPartie->selectionnerCase($_GET['i'], $_GET['j']);
      $this->ctrlStats->incrementerPartieGagnee($_SESSION['pseudo']);
      return;
    }

    if (isset($_POST['nouvelle_partie'])) {
      $this->ctrlPartie->nouvellePartie();
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

    if (isset($_POST['stats'])) {
      $this->ctrlStats->voirStats($_SESSION['pseudo']);
      return;
    }

    if (isset($_POST['retourJeu'])) {
      $this->ctrlPartie->nouvellePartie();
      return;
    }

    $this->ctrlAuthentification->connexion();
 }


 }




?>
