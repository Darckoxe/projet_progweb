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
      if ($this->ctrlAuthentification->verif($_POST['pseudo'], $_POST['password']) == true) {
        $_SESSION['pseudo'] = $_POST['pseudo'];
        $this->ctrlPartie->nouvellePartie();
        return;
      }
    }

    if (isset($_GET['supprimerBille']) && $_SESSION['pseudo'] != null) {
      $this->ctrlPartie->supprimerBille($_GET['i'],$_GET['j']);
      $this->ctrlStats->incrementerPartieJouee($_SESSION['pseudo']);
      return;
    }

    if(isset($_GET['selectionnerBille']) && $_SESSION['pseudo'] != null) {
      $this->ctrlPartie->selectionnerBille($_GET['i'], $_GET['j']);
      return;
    }

    if(isset($_GET['selectionnerCase'])  && $_SESSION['pseudo'] != null){ // On sélectionne la case où on veut déplacer la bille
      $this->ctrlPartie->selectionnerCase($_GET['i'], $_GET['j']);
      $this->ctrlStats->incrementerPartieGagnee($_SESSION['pseudo']);
      return;
    }

    if (isset($_GET['nouvelle_partie']) && $_SESSION['pseudo'] != null) {
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

    if (isset($_GET['statistiques']) && $_SESSION['pseudo'] != null) {
      $this->ctrlStats->voirStats($_SESSION['pseudo']);
      return;
    }

    if (isset($_GET['retour_jeu']) && $_SESSION['pseudo'] != null) {
      $this->ctrlPartie->nouvellePartie();
      return;
    }

    if (isset($_GET['disconnect']) && $_SESSION['pseudo'] != null) {
      $_SESSION['pseudo'] = null;
      $this->ctrlAuthentification->connexion();
      return;
    }

    if (isset($_GET['fin']) && $_SESSION['pseudo'] != null) {
      $this->ctrlPartie->afficherFin();
      return;
    }

    $this->ctrlAuthentification->connexion();
 }


 }




?>
