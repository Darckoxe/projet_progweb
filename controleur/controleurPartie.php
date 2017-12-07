<?php
require_once PATH_VUE."/vueAccueil.php";
require_once PATH_VUE."/vueErreur.php";
require_once PATH_VUE."/vuePartie.php";
require_once PATH_VUE."/vueStats.php";
require_once PATH_VUE."/vueResultat.php";

require_once 'modele/dao.php';

class ControleurPartie{

private $vue_accueil;
private $vue_erreur;
private $vue_partie;
private $vue_stats;
private $vue_resultat;
private $dao;

function __construct(){
$this->vue_accueil=new VueAccueil();
$this->vue_erreur=new VueErreur();
$this->vue_partie=new VuePartie();
$this->vue_stats=new VueStats();
$this->vue_resultat=new VueResultat();
$this->dao = new Dao();
  }

function nouvellePartie(){
  /* Fonction qui permet de créer le plateau de jeu. C'est une matrice à deux
  dimensions. Les cases avec un "/" sont les cases interdites. Les cases avec un
  "X" sont les cases où il y a une bille et les cases avec un "O" sont les
  cases vides. Le plateau est stocké dans une variable de session pour
  pouvoir le réutiliser partout */
    $plateau = array();
    $plateau[0] = array("/","/","X","X","X","/","/");
    $plateau[1] = array("/","/","X","X","X","/","/");
    $plateau[2] = array("X","X","X","X","X","X","X");
    $plateau[3] = array("X","X","X","X","X","X","X");
    $plateau[4] = array("X","X","X","X","X","X","X");
    $plateau[5] = array("/","/","X","X","X","/","/");
    $plateau[6] = array("/","/","X","X","X","/","/");

    $_SESSION['plateau'] = $plateau;
    $_SESSION['nb_bille']= 33;

  $this->vue_partie->afficherPlateau();
  $this->vue_partie->formTexteDebut();
  $this->vue_partie->formStats();
  $this->vue_partie->formDeconnexion();
  return;
}

/* Fonction qui permet de supprimer une bille aux coordonnées (x_del;y_del).
La case en question passe à vide ("O") et le nombre de billes est décrémenté*/
function supprimerBille($x_del,$y_del){
    $_SESSION['plateau'][$x_del][$y_del] = "O";
    $_SESSION['nb_bille'] = $_SESSION['nb_bille']-1;
    $this->testVictoire();
    $this->vue_partie->afficherPlateau();
    $this->vue_partie->formNouvellePartie();
    $this->vue_partie->formDeconnexion();
    return;
  }

/* Fonction qui permet de sélectionner la bille à déplacer aux coordonnées
(x_sel;y_sel).Si la case selectionnée est vide alors on lève une erreur
sinon la case passe à sélectionnée ("+") et on stocke les coordonnées dans
des variables de session */
function selectionnerBille($x_sel,$y_sel){
  if (($_SESSION['plateau'][$x_sel][$y_sel]) == "O") {
    $_SESSION['error'] = true;
    $this->vue_partie->afficherPlateau();
    $this->vue_erreur->erreurSelectionBille();
    $this->vue_partie->formNouvellePartie();
    $this->vue_partie->formDeconnexion();
    return;
  }
  else{
    $_SESSION['error'] = false;
    $_SESSION['x_sel'] = $x_sel;
    $_SESSION['y_sel'] = $y_sel;
    $_SESSION['plateau'][$x_sel][$y_sel] = "+"; // on sélectionne la bille
    $this->vue_partie->afficherPlateau();
    $this->vue_partie->formNouvellePartie();
    $this->vue_partie->formDeconnexion();
    return;
  }
}
/* Fonction qui permet de sélectionner la case où on souhaite déplacer la bille
selectionnée aux coordonnées (x_case;y_case). La fonction vérifie qu'il existe
bien une bille a la case courante +1 et que la case courante +2 est vide.
Si c'est le cas, le mouvement est possible. Sinon, on lève une erreur de sélection */

function selectionnerCase($x_case,$y_case){
// on se déplace vers le haut
  if($x_case - $_SESSION['x_sel'] == -2){
    if ($y_case - $_SESSION['y_sel'] == 0) {
      if ($_SESSION['plateau'][$x_case][$y_case] == "O") {
        if ($_SESSION['plateau'][$x_case+1][$y_case] == "X") {
          $_SESSION['plateau'][$_SESSION['x_sel']][$_SESSION['y_sel']] = "O";
          $_SESSION['plateau'][$x_case][$y_case] = "X";
          $_SESSION['error'] = false;
          $this->supprimerBille($x_case+1,$y_case);
          // $this->testVictoire();
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
          $_SESSION['plateau'][$_SESSION['x_sel']][$_SESSION['y_sel']] = "O";
          $_SESSION['plateau'][$x_case][$y_case] = "X";
          $_SESSION['error'] = false;
          $this->supprimerBille($x_case,$y_case-1);
          // $this->testVictoire();
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
          $_SESSION['plateau'][$_SESSION['x_sel']][$_SESSION['y_sel']] = "O";
          $_SESSION['plateau'][$x_case][$y_case] = "X";
          $_SESSION['error'] = false;
          $this->supprimerBille($x_case-1,$y_case);
          // $this->testVictoire();
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
          $_SESSION['plateau'][$_SESSION['x_sel']][$_SESSION['y_sel']] = "O";
          $_SESSION['plateau'][$x_case][$y_case] = "X";
          $_SESSION['error'] = false;
          $this->supprimerBille($x_case,$y_case+1);
          // $this->testVictoire();
          return;
        }
      }
    }
  }
  $_SESSION['error'] = true;
  $_SESSION['plateau'][$_SESSION['x_sel']][$_SESSION['y_sel']] = "X";
  // $this->testVictoire();
  $this->vue_partie->afficherPlateau();
  $this->vue_erreur->erreurSelectionCase();
  $this->vue_partie->formNouvellePartie();
  $this->vue_partie->formDeconnexion();
  return;
}

/* Fonction qui vérifie si le joueur a perdu en parcourant la totalité du tableau
et en vérifiant qu'au moins une bille peut se déplacer en sautant par dessus une
autre. Sinon on affiche perdu */
  function testVictoire(){
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
    if ($_SESSION['nb_bille'] == 1) {
      $_SESSION['resultat'] = true;
      header('Location: index.php?fin');
      exit();
    }
    else{
      $_SESSION['resultat'] = false;
      header('Location: index.php?fin');
      exit();
    }
  }

/* On se redirige */
  function afficherFin(){
    $this->vue_resultat->afficherTestVictoire();
  }
}
?>
