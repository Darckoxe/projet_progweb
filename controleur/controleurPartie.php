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
  $_SESSION['plateau'][$x_del][$y_del] = "O";
  $_SESSION['nb_bille'] = $_SESSION['nb_bille']-1;
  $this->vue_partie->afficherPlateau();
  echo $_SESSION['nb_bille'];
  return;
  }

function selectionnerBille($x_sel,$y_sel){
  $_SESSION['x_sel'] = $x_sel;
  $_SESSION['y_sel'] = $y_sel;
  $_SESSION['plateau'][$x_sel][$y_sel] = "+"; // on sélectionne la bille
  $this->vue_partie->afficherPlateau();
  echo $_SESSION['nb_bille'];
  return;
  }

function selectionnerCase($x_case,$y_case){
  $_SESSION['plateau'][$_SESSION['x_sel']][$_SESSION['y_sel']] = "O"; // la case de la bille selectionnée devient vide
  $_SESSION['plateau'][$x_case][$y_case] = "X"; // la bille selectionné se place dans la case selectionnée

  /* Fonction qui supprime la bille sautée */

  if ($_SESSION['x_sel'] - $x_case == 0) { // La bille est déplacée sur la ligne
    if(($_SESSION['y_sel'] - $y_case) < 0){
      $x_saute = $_SESSION['x_sel'];
      $y_saute = $_SESSION['y_sel']+1;
    }
    else{
      $x_saute = $_SESSION['x_sel'];
      $y_saute = $_SESSION['y_sel']-1;
    }
  }

  if($_SESSION['y_sel'] - $y_case == 0) { // La bille est déplacée sur la colonne
    if(($_SESSION['x_sel'] - $x_case) < 0){
      $x_saute = $_SESSION['x_sel']+1;
      $y_saute = $_SESSION['y_sel'];
    }
    else{
      $x_saute = $_SESSION['x_sel']-1;
      $y_saute = $_SESSION['y_sel'];
    }
  }
  $_SESSION['plateau'][$x_saute][$y_saute] = "O";
  $_SESSION['nb_bille'] = $_SESSION['nb_bille'] -1;
  $this->vue_partie->afficherPlateau();
  if ($_SESSION['nb_bille'] == 1) {
    echo "Félicitations, vous avez gagné !";
    // incrémenter partieGagnee ici
  }
  echo $_SESSION['nb_bille'];
  return;
  }

}
?>
