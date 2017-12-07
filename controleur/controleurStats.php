<?php
require_once PATH_VUE."/vueAccueil.php";
require_once PATH_VUE."/vueErreur.php";
require_once PATH_VUE."/vuePartie.php";
require_once PATH_VUE."/vueStats.php";
require_once 'modele/dao.php';


class ControleurStats{

private $vue_accueil;
private $vue_erreur;
private $vue_partie;
private $vue_stats;
private $dao;


function __construct(){
$this->vue_accueil=new VueAccueil();
$this->vue_erreur=new VueErreur();
$this->vue_partie=new VuePartie();
$this->vue_stats=new VueStats();
$this->dao = new Dao();
  }

/* Fonction qui permet de voir les statistiques personnelles et générales */
function voirStats($pseudo){
  $stats = $this->dao->getStatsPerso($pseudo);
  $classement = $this->dao->getClassement();
  $this->vue_stats->voirStatsPerso($stats,$classement);
  $this->vue_partie->formDeconnexion();
  echo "<br />";
  $this->vue_stats->formRetourJeu();
  return;
  }

/* Fonction qui augmente le nombre de partie jouées dans la base de données */
function incrementerPartieJouee($pseudo){
  $nbPartieJouee = $this->dao->getPartieJouee($pseudo);
  $nbPartieJouee = $nbPartieJouee+1;
  $this->dao->updatePartieJouee($nbPartieJouee,$pseudo);
  return;
  }

/* Fonction qui augmente le nombre de partie gagnées dans la base de données */
function incrementerPartieGagnee($pseudo){
  if($_SESSION['nb_bille'] == 1){
    $nbPartieGagnee = $this->dao->getPartieGagnee($pseudo);
    $nbPartieGagnee = $nbPartieGagnee+1;
    $this->dao->updatePartieGagnee($nbPartieGagnee,$pseudo);
    return;
  }
  else{
    return;
    }
  }
}
?>
