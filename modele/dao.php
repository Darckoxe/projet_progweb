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
ajouterJoueur($pseudo,$password)
ajouterJoueurPartie($pseudo) --> function qui permet d'ajouter une ligne dans la table parties
getStatsPerso($pseudo)
getPartieGagnee($pseudo)
getClassement()
*/


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
  public function ajouterJoueurPartie($pseudo){ // function qui permet d'ajouter une ligne dans la table parties
  try {
    $stmt= $this->connexion->prepare("insert into parties (partieGagnee,partieJouee,pseudo) values(0,0,?)");
    $stmt->bindParam(1, $pseudo);
    $stmt->execute();
  } catch (PDOException $e) {
    $this->deconnexion();
    }
  }

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

public function getPartieGagnee($pseudo){
  $stmt=$this->connexion->prepare("select * from parties where pseudo = ?");
  $stmt->bindParam(1, $pseudo);
  $stmt->execute();
  $res = $stmt->fetch();
  return $res['partieGagnee'];
  }

public function getClassement(){
  $stmt=$this->connexion->query("SELECT pseudo, (partieGagnee / partieJouee) AS ratio FROM parties where partieJouee > 0 order by ratio desc limit 3");
  $stmt->execute();
  $res = $stmt->fetchAll();
  return $res;
  }

public function getPartieJouee($pseudo){
  $stmt=$this->connexion->prepare("select * from parties where pseudo = ?");
  $stmt->bindParam(1, $pseudo);
  $stmt->execute();
  $res = $stmt->fetch();
  return $res['partieJouee'];
  }

public function updatePartieJouee($nbPartieJouee,$pseudo){
  $stmt=$this->connexion->prepare("UPDATE parties SET partieJouee = ? WHERE pseudo = ?");
  $stmt->bindParam(1, $nbPartieJouee);
  $stmt->bindParam(2, $pseudo);
  $stmt->execute();
  }
}
?>
