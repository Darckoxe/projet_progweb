<?php
require_once PATH_VUE."/vueAccueil.php";
require_once PATH_VUE."/vueErreur.php";
require_once PATH_VUE."/vuePartie.php";
require_once PATH_VUE."/vueResultat.php";
require_once PATH_VUE."/vueStats.php";
require_once 'modele/dao.php';


class ControleurStats{

private $vue_accueil;
private $vue_erreur;
private $vue_partie;
private $vue_resultat;
private $vue_stats;
private $dao;


function __construct(){
$this->vue_accueil=new VueAccueil();
$this->vue_erreur=new VueErreur();
$this->vue_partie=new VuePartie();
$this->vue_resultat=new VueResultat();
$this->vue_stats=new VueStats();
$this->dao = new Dao();
  }

function voirStats($pseudo){
  $stats = $this->dao->getStatsPerso($pseudo);
  $classement = $this->dao->getClassement();
  $this->vue_stats->voirStatsPerso($stats,$classement);
  return;
  }
}
?>
