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

function connexion(){
    $this->vue_accueil->formConnexion();
    return;
}

function inscription(){
    $this->vue_accueil->formInscription();
    return;
}

function confirmInscription($pseudo, $password){
  if($this->dao->getPseudo($pseudo) != null){ // si le pseudo existe déjà
    $this->vue_erreur->inscriptionExiste();
    return;
  }
  else{
    $password = crypt($password); // on crypte le mot de passe
    $this->dao->ajouterJoueur($pseudo,$password);
    $this->dao->ajouterJoueurPartie($pseudo);
    $this->vue_accueil->confirmInscription();
    return;
  }
}

function verif($pseudo, $password){
    $mdpBdd = $this->dao->getPassword($pseudo); // mot de passe crypté de la bdd

    if (crypt($password,$mdpBdd) == $mdpBdd) {
      $this->vue_partie->initPlateau();
      return;
    }
    else{
      $this->vue_erreur->erreurAuthentification();
      return;
    }

  }
}
