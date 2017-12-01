<?php
require_once PATH_VUE."/vueAccueil.php";
require_once PATH_VUE."/vueErreur.php";
require_once PATH_VUE."/vuePartie.php";
require_once PATH_VUE."/vueResultat.php";
require_once 'modele/dao.php';


class ControleurPartie{

private $vue_accueil;
private $vue_erreur;
private $vue_partie;
private $vue_resultat;
private $dao;


function __construct(){
$this->vue_accueil=new VueAccueil();
$this->vue_erreur=new VueErreur();
$this->vue_partie=new VuePartie();
$this->vue_resultat=new VueResultat();

$this->dao = new Dao();
}

function supprimerBille($x_del,$y_del){
  if ($x_del == null) {
    if ($y_del == null) {
      $this->vue_partie->initPlateau();
      return;
    }
  }

  if (($x_del<=2) || ($x_del >=6)){ // Si on sélectionne une case vide
    if (($y_del<=2) || ($y_del>=6)) {
      $this->vue_erreur->erreurSuppression();
      return;
    }
  }

  $x_del = $x_del-1;
  $y_del = $y_del-1;
  /* L'utilisateur ne sait pas qu'une matrice commence à 0
  Quand il rentre les coordonnées 1;1 il pense que c'est la
  case en haut a gauche. En réalité pour l'ordinateur c'est la coordonnée 0;0
  donc on soustrait 1 à x et y pour pouvoir travailler sur les tableaux de façon
  normal avec la case 0.
  */
  $this->vue_partie->supprimerBille($x_del,$y_del);
  return;
  }

function selectionnerBille($x_sel,$y_sel){
  if (($x_sel<=2) || ($x_sel >=6)){
    if (($y_sel<=2) || ($y_sel>=6)) {
      $x_sel = $x_sel-1;
      $y_sel = $y_sel-1;
      $this->vue_erreur->erreurSelection();
      return;
    }
  }

/* Gérer l'erreur où on sélectionne une case vide */
  if ($x_sel == $_SESSION['x_del']) {
    $this->vue_erreur->erreurSelection();
    return;
  }

    $x_sel = $x_sel-1;
    $y_sel = $y_sel-1;
    $this->vue_partie->selectionBille($x_sel,$y_sel);
    return;
  }

function deplacerBille($x_move,$y_move){
  $x_move = $x_move-1;
  $y_move = $y_move-1;
  $this->vue_partie->deplacerBille($x_move,$y_move);
  return;
  }
}
?>
