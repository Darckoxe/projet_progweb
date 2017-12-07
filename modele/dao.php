<?php


// Classe generale de definition d'exception
class MonException extends Exception{
  private $chaine;
  public function __construct($chaine){
    $this->chaine=$chaine;
  }

  public function afficher(){
    return $this->chaine;
  }

}


// Exception relative à un probleme de connexion
class ConnexionException extends MonException{
}

// Exception relative à un probleme d'accès à une table
class TableAccesException extends MonException{
}


// Classe qui gère les accès à la base de données

class Dao{
private $connexion;

// Constructeur de la classe

public function __construct(){
 try{
  $chaine="mysql:host=".HOST.";dbname=".BD;
  $this->connexion = new PDO($chaine,LOGIN,PASSWORD);
  $this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   }
  catch(PDOException $e){
    $exception=new ConnexionException("problème de connexion à la base");
    throw $exception;
  }
}

// A développer
// méthode qui permet de se deconnecter de la base
public function deconnexion(){
   $this->connexion=null;
}

public function getPassword($pseudo){
  try {
    $statement = $this->connexion->prepare("select motDePasse from joueurs where pseudo = ?");
    $statement->bindParam(1, $pseudo);
    $statement->execute();
    $hashPass = $statement->fetch();
    return $hashPass['motDePasse'];
  }
  catch (PDOException $e) {
    $this->deconnexion();
  }
}

/* SOMMAIRE :
getPseudo($pseudo)
getStatsPerso($pseudo)
getPartieGagnee($pseudo)
getClassement()
getPartieJouee($pseudo)
ajouterJoueur($pseudo,$password)
ajouterJoueurPartie($pseudo)
updatePartieJouee($nbPartieJouee,$pseudo)
updatePartieGagnee($nbPartieJouee,$pseudo)
*/

/* Fonction qui permet de récupérer le pseudo de la base de données */
public function getPseudo($pseudo){
  try {
    $statement = $this->connexion->prepare("select pseudo from joueurs where pseudo = ?");
    $statement->bindParam(1, $pseudo);
    $statement->execute();
    $res = $statement->fetch();
    return $res['pseudo'];
  }
  catch (PDOException $e) {
    $this->deconnexion();
  }
}

/* Fonction qui permet de récupérer le pseudo, le nombre de parties jouées et
gagnées ainsi que le ratio d'un joueur */
public function getStatsPerso($pseudo){
  try {
    $stmt=$this->connexion->prepare("select * from parties where pseudo = ?");
    $stmt->bindParam(1, $pseudo);
    $stmt->execute();
    $res = $stmt->fetch();
    if ($res['partieGagnee'] == 0) {
      return "Connecté sous le pseudo de ".$res['pseudo']." vous avez joué ".$res['partieJouee']." parties et gagné ".$res['partieGagnee']." parties soit un ratio de victoire de 0";
    }
    return "Connecté sous le pseudo de ".$res['pseudo']." vous avez joué ".$res['partieJouee']." parties et gagné ".$res['partieGagnee']." parties soit un ratio de victoire de ".$res['partieGagnee']/$res['partieJouee'];
  } catch (PDOException $e) {
    $this->deconnexion();
    }
  }

/* Fonction qui permet de récupérer le nombre de parties gagnées d'un joueur */
public function getPartieGagnee($pseudo){
    $stmt=$this->connexion->prepare("select * from parties where pseudo = ?");
    $stmt->bindParam(1, $pseudo);
    $stmt->execute();
    $res = $stmt->fetch();
    return $res['partieGagnee'];
    }

/* Fonction qui permet de récupérer le pseudo et le ratio des 3 meilleurs joueurs
et de classer par ordre décroissant du ratio */
public function getClassement(){
    $stmt=$this->connexion->query("SELECT pseudo, (partieGagnee / partieJouee) AS ratio FROM parties where partieJouee > 0 order by ratio desc limit 3");
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
    }

/* Fonction qui permet de récupérer le nombre de parties jouées d'un joueur */
public function getPartieJouee($pseudo){
    $stmt=$this->connexion->prepare("select * from parties where pseudo = ?");
    $stmt->bindParam(1, $pseudo);
    $stmt->execute();
    $res = $stmt->fetch();
    return $res['partieJouee'];
    }
/* Fonction qui permet d'ajouter un joueur dans la table joueur */
public function ajouterJoueur($pseudo,$password){
  try {
    $statement = $this->connexion->prepare('insert into joueurs (pseudo,motDePasse) values (?,?)');
    $statement->bindParam(1, $pseudo);
    $statement->bindParam(2, $password);
    $statement->execute();
  }
  catch (PDOException $e) {
    $this->deconnexion();
    }
  }

/* Fonction qui permet d'ajouter un joueur dans la table parties */
public function ajouterJoueurPartie($pseudo){
  try {
    $stmt= $this->connexion->prepare("insert into parties (partieGagnee,partieJouee,pseudo) values(0,0,?)");
    $stmt->bindParam(1, $pseudo);
    $stmt->execute();
  } catch (PDOException $e) {
    $this->deconnexion();
    }
  }
/* Fonction qui permet de modifier le nombre de parties jouées d'un joueur dans la table parties */
public function updatePartieJouee($nbPartieJouee,$pseudo){
  $stmt=$this->connexion->prepare("UPDATE parties SET partieJouee = ? WHERE pseudo = ?");
  $stmt->bindParam(1, $nbPartieJouee);
  $stmt->bindParam(2, $pseudo);
  $stmt->execute();
  }

/* Fonction qui permet de modifier le nombre de parties gagnées d'un joueur dans la table parties */
public function updatePartieGagnee($nbPartieGagnee,$pseudo){
    $stmt=$this->connexion->prepare("UPDATE parties SET partieGagnee = ? WHERE pseudo = ?");
    $stmt->bindParam(1, $nbPartieGagnee);
    $stmt->bindParam(2, $pseudo);
    $stmt->execute();
    }
}
?>
