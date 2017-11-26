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

function nouvellePartie($x, $y){

  if (($x<=2) || ($x >=6)){
    if (($y<=2) || ($y>=6)) {
      $this->vue_erreur->erreurSuppression();
      return;
    }
  }
  $x = $x-1;
  $y = $y-1;
  /* L'utilisateur ne sait pas qu'une matrice commence à 0
  Quand il rentre les coordonnées 1;1 il pense que c'est la
  case en haut a gauche. En réalité pour l'ordinateur c'est la coordonnée 0;0
  donc on soustrait 1 à x et y pour pouvoir travailler sur les tableaux de façon
  normal avec la case 0.
  */
  $this->vue_partie->supprimerPion($x,$y);
  return;
  }

function selectionnerPion($x,$y){
  if (($x<=2) || ($x >=6)){
    if (($y<=2) || ($y>=6)) {
      $x = $x-1;
      $y = $y-1;
      $this->vue_erreur->erreurSelection();
      return;
    }
  }

  if (($_SESSION['pion_supprime_x']+1 == $x) && ($_SESSION['pion_supprime_y']+1 == $y)) {
    $this->vue_erreur->erreurSelection();
    return;
  }
    $x = $x-1;
    $y = $y-1;
    $this->vue_partie->selectionnerPion($x,$y);
    return;
  }

function deplacerPion($x,$y){
  $x = $x-1;
  $y = $y-1;
  $this->vue_partie->deplacerPion($x,$y);
  return;
  }
}
?>
