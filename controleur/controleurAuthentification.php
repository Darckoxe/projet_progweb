<?php
require_once PATH_VUE."/vue.php";
require_once 'modele/modele.php';


class ControleurAuthentification{

private $vue;
private $modele;


function __construct(){
$this->vue=new Vue();
$this->modele = new Modele();
}

function accueil(){
    $this->vue->demandePseudo();
}

function verifLogin($pseudo){
  if ($this->modele->exists($pseudo)) {
    $_SESSION['pseudo'] = $_POST['pseudo'];
    $les10messages = $this->modele->get10RecentMessage();
    $this->vue->salon($les10messages);
  }
  else {
    $this->accueil();
  }
}

function ajoutMessage($message){
  $this->modele->majSalon($_SESSION['pseudo'], $message);
  $les10messages = $this->modele->get10RecentMessage();
  $this->vue->salon($les10messages);
}




}
