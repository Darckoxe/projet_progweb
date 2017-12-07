<?php
require_once PATH_VUE."/vueAccueil.php";
require_once PATH_VUE."/vueErreur.php";
require_once PATH_VUE."/vuePartie.php";
require_once PATH_VUE."/vueResultat.php";
require_once PATH_VUE."/vueStats.php";
require_once 'modele/dao.php';


class ControleurAuthentification{

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
// Fonction qui affiche le formulaire de connexion de l'accueil
function connexion(){
    $this->vue_accueil->formConnexion();
    return;
}

// Fonction qui affiche le formulaire d'inscription
function inscription(){
    $this->vue_accueil->formInscription();
    return;
}

/* Fonction valide l'inscription si le pseudo n'existe pas déjà dans la base de données
en cryptant le mot de passe et qui ajoute un enregistrement dans la table joueurs et
la table parties en initialisant les parties à 0 */
function confirmInscription($pseudo, $password){
  if($this->dao->getPseudo($pseudo) != null){ // Si le pseudo existe déjà
    $this->vue_erreur->inscriptionExiste(); // On lève l'erreur que le pseudo existe
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

/* Fonction qui vérifie le mot de passe de connexion du formulaire de connexion
de l'accueil. S'il est bon on initialise le jeu sinon on lève une erreur */
function verif($pseudo, $password){
    $mdpBdd = $this->dao->getPassword($pseudo); // Mot de passe crypté de la bdd
    if (crypt($password,$mdpBdd) == $mdpBdd) {
      $this->vue_partie->initPlateau();
      $this->vue_partie->formStats();
      $this->vue_partie->formDeconnexion();
      return;
    }
    else{
      $this->vue_erreur->formErreurAuthentification();
      return;
    }

  }
}
