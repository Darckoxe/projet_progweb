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

function nouvellePartie(){
  $this->vue_partie->initPlateau();
  $this->vue_partie->formStats();
  return;
}

function supprimerBille($x_del,$y_del){
  if (($x_del < 2) || ($x_del > 4)) {
    if(($y_del < 2) || ($y_del > 4)){
      $this->vue_partie->afficherPlateau();
      $this->vue_erreur->erreurSuppression();
      return;
    }
  }
  else{
    $_SESSION['plateau'][$x_del][$y_del] = "O";
    $_SESSION['nb_bille'] = $_SESSION['nb_bille']-1;
    $this->vue_partie->afficherPlateau();
    echo "Il reste ".$_SESSION['nb_bille']." billes sur le plateau";
    $this->vue_partie->formNouvellePartie();
    return;
  }
}

function selectionnerBille($x_sel,$y_sel){
  if (($x_sel < 2) || ($x_sel > 4)) {
    if(($y_sel < 2) || ($y_sel > 4)){
      $_SESSION['error'] = true;
      $this->vue_partie->afficherPlateau();
      $this->vue_erreur->erreurSelectionBille();
      $this->vue_partie->formNouvellePartie();
      return;
    }
  }
  if (($_SESSION['plateau'][$x_sel][$y_sel]) == "O") {
    $_SESSION['error'] = true;
    $this->vue_partie->afficherPlateau();
    $this->vue_erreur->erreurSelectionBille();
    $this->vue_partie->formNouvellePartie();
    return;
  }
  else{
    $_SESSION['error'] = false;
    $_SESSION['x_sel'] = $x_sel;
    $_SESSION['y_sel'] = $y_sel;
    $_SESSION['plateau'][$x_sel][$y_sel] = "+"; // on sélectionne la bille
    $this->vue_partie->afficherPlateau();
    echo "Il reste ".$_SESSION['nb_bille']." billes sur le plateau";
    $this->vue_partie->formNouvellePartie();
    return;
  }
}

function selectionnerCase($x_case,$y_case){
  if (($x_case < 2) || ($x_case > 4)) {
    if(($y_case < 2) || ($y_case > 4)){
      $_SESSION['error'] = true;
      $_SESSION['plateau'][$_SESSION['x_sel']][$_SESSION['y_sel']] = "X";
      $this->vue_partie->afficherPlateau();
      $this->vue_erreur->erreurSelectionCase();
      $this->vue_partie->formNouvellePartie();
      return;
    }
  }
// on se déplace vers le haut
  if($x_case - $_SESSION['x_sel'] == -2){
    if ($y_case - $_SESSION['y_sel'] == 0) {
      if ($_SESSION['plateau'][$x_case][$y_case] == "O") {
        if ($_SESSION['plateau'][$x_case+1][$y_case] == "X") {
          $_SESSION['x_case'] = $x_case;
          $_SESSION['y_case'] = $y_case;
          $_SESSION['error'] = false;
          $this->supprimerBilleSautee($x_case,$y_case);
          $this->perdu();
          $this->vue_partie->formNouvellePartie();
          return;
        }
      }
    }
  }

// on se déplace à droite
  if($y_case - $_SESSION['y_sel'] == 2){
    if ($x_case - $_SESSION['x_sel'] == 0) {
      if ($_SESSION['plateau'][$x_case][$y_case] == "O") {
        if ($_SESSION['plateau'][$x_case][$y_case-1] == "X") {
          $_SESSION['x_case'] = $x_case;
          $_SESSION['y_case'] = $y_case;
          $_SESSION['error'] = false;
          $this->supprimerBilleSautee($x_case,$y_case);
          $this->perdu();
          $this->vue_partie->formNouvellePartie();
          return;
        }
      }
    }
  }

// on se déplace en bas
  if($x_case - $_SESSION['x_sel'] == 2){
    if ($y_case - $_SESSION['y_sel'] == 0) {
      if ($_SESSION['plateau'][$x_case][$y_case] == "O") {
        if ($_SESSION['plateau'][$x_case-1][$y_case] == "X") {
          $_SESSION['x_case'] = $x_case;
          $_SESSION['y_case'] = $y_case;
          $_SESSION['error'] = false;
          $this->supprimerBilleSautee($x_case,$y_case);
          $this->perdu();
          $this->vue_partie->formNouvellePartie();
          return;
        }
      }
    }
  }


// on se déplace à gauche
  if($y_case - $_SESSION['y_sel'] == -2){
    if ($x_case - $_SESSION['x_sel'] == 0) {
      if ($_SESSION['plateau'][$x_case][$y_case] == "O") {
        if ($_SESSION['plateau'][$x_case][$y_case+1] == "X") {
          $_SESSION['error'] = false;
          $_SESSION['x_case'] = $x_case;
          $_SESSION['y_case'] = $y_case;
          $this->supprimerBilleSautee($x_case,$y_case);
          $this->perdu();
          $this->gagne();
          $this->vue_partie->formNouvellePartie();
          return;
        }
      }
    }
  }
  $_SESSION['error'] = true;
  $_SESSION['plateau'][$_SESSION['x_sel']][$_SESSION['y_sel']] = "X";
  $this->vue_partie->afficherPlateau();
  $this->vue_erreur->erreurSelectionCase();
  $this->vue_partie->formNouvellePartie();
  return;
}

  function supprimerBilleSautee($x_case,$y_case){
    $_SESSION['error'] = false;
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
    echo "Il reste ".$_SESSION['nb_bille']." billes sur le plateau";
    return;
  }

  function perdu(){ //Cette fonction vérifie qu'on ne peut plus se déplacer dans n'importe qelle direction
    // on parcours l'ensemble du tableau
    for ($i=0; $i < 7; $i++) {
      for ($j=0; $j <7 ; $j++) {
        /* si aux coordonnées courants on a une bille on regarde si il y a une bille à côté
        S'il y a une bille à côté, on regarde s'il y a une case libre à côté de cette bille
        dans ce cas on return; sinon on lève l'erreur*/
          if ($_SESSION['plateau'][$i][$j] == "X") {
            if ($_SESSION['plateau'][$i+1][$j] == "X") { // il y a une bille en bas
              if ($_SESSION['plateau'][$i+2][$j] == "O") {
                return;
              }
            }
            if ($_SESSION['plateau'][$i][$j-1] == "X") { // il y a une bille à gauche
              if ($_SESSION['plateau'][$i][$j-2] == "O") {
                return;
              }
            }
            if ($_SESSION['plateau'][$i-1][$j] == "X") { // il y a une bille en haut
              if ($_SESSION['plateau'][$i-2][$j] == "O") {
                return;
              }
            }
            if ($_SESSION['plateau'][$i][$j+1] == "X") { // il y a une bille  à droite
              if ($_SESSION['plateau'][$i][$j+2] == "O") {
                return;
            }
          }
        }
      }
    }
      echo "Dommage, vous avez perdu !";
      return;
  }

  function gagne(){
    if ($_SESSION['nb_bille'] == 1) {
      echo "Félicitations, vous avez gagné !";
      return;
    }
  }
}
?>
