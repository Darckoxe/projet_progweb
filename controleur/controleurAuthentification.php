<?php
require_once PATH_VUE."/vueAccueil.php";
require_once 'modele/dao.php';


class ControleurAuthentification{

private $vue_accueil;
private $dao;


function __construct(){
$this->vue_accueil=new VueAccueil();
$this->dao = new Dao();
}

function accueil(){
    $this->vue_accueil->accueil();
}

function verif($pseudo, $password){
    $mdpBdd = $this->dao->getPassword($pseudo); // mot de passe crypté de la bdd
    echo "Pass bdd = ".$mdpBdd."<br/>";
    echo "Pass crypt = ".crypt($password, $mdpBdd);

}

function verifLogin($pseudo){
  if ($this->modele->exists($pseudo)) {
    $_SESSION['pseudo'] = $_POST['pseudo'];
    $this->vue->salon();
  }
  else {
    $this->accueil();
  }
}

//
// function ajoutMessage($message){
//   $this->modele->majSalon($_SESSION['pseudo'], $message);
//   $les10messages = $this->modele->get10RecentMessage();
//   $this->vue->salon($les10messages);
// }




}
