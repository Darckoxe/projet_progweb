<?php
Class VueErreur{
  function formErreurAuthentification(){ ?>
    <html>
      <body>
          <p> Erreur authentification, réessayez </p>
          <form method="post" action="index.php">
            <label for="pseudo"> Entrer votre pseudo </label> <input type="text" name="pseudo"/> <br />
            <label for="password"> Entrer votre mot de passe </label> <input type="password" name="password"/> <br /> <br />
            <input type="submit" name="soumettre" value="Envoyer"/>
          </form>
      </body>
    </html>
<?php
  }

  function inscriptionExiste(){ ?>
    <html>
      <body>
      <p> Il semblerait que le pseudo existe déjà </p>
          <form method="post" action="index.php">
            <label for="pseudo"> Entrer votre pseudo </label> <input type="text" name="pseudo"/> <br />
            <label for="password"> Entrer votre mot de passe </label> <input type="password" name="password"/> <br /> <br />
            <input type="submit" name="connexion" value="Connexion"/> <input type="submit" name="inscription" value="S'inscrire">
          </form>
      </body>
    </html>
  <?php }

  function erreurSuppression(){
    echo "Impossible de supprimer cette bille";
    echo "<br/>";
    echo "Il reste ".$_SESSION['nb_bille']." billes sur le plateau";
  }

  function erreurSelectionBille(){
    echo "Impossible de sélectionner cette bille";
    echo "<br/>";
    echo "Il reste ".$_SESSION['nb_bille']." billes sur le plateau";
  }

  function erreurSelectionCase(){
    echo "Impossible de déplacer la bille";
    echo "<br/>";
    echo "Il reste ".$_SESSION['nb_bille']." billes sur le plateau";
  }
}
?>
