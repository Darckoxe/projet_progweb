<?php
require_once PATH_VUE."/vueAccueil.php";
require_once PATH_VUE."/vueErreur.php";
require_once PATH_VUE."/vuePartie.php";
require_once PATH_VUE."/vueResultat.php";
require_once 'modele/dao.php';


class ControleurAuthentification{

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

function accueil(){
    $this->vue_accueil->accueil();
}

function verif($pseudo, $password){
    $mdpBdd = $this->dao->getPassword($pseudo); // mot de passe crypté de la bdd
    // echo "Pass bdd = ".$mdpBdd."<br/>";
    // echo "Pass crypt = ".crypt($password, $mdpBdd);
    if (crypt($password,$mdpBdd) == $mdpBdd) {
      $this->vue_partie->accueil();
      return;
    }
    else{
      $this->vue_erreur->erreurAuthentification();
      return;
    }

}


//
// function ajoutMessage($message){
//   $this->modele->majSalon($_SESSION['pseudo'], $message);
//   $les10messages = $this->modele->get10RecentMessage();
//   $this->vue->salon($les10messages);
// }




}
