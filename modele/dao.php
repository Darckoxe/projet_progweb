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
    $statement = $this->connexion->prepare("select motDePasse from joueurs where pseudo = ?");
    $statement->bindParam(1, $pseudo);
    $statement->execute();
    $hashPass = $statement->fetch();
    $this->deconnexion();

    return $hashPass['motDePasse'];
  }
}

?>
