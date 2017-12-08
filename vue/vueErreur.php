<?php
Class VueErreur{

/* Fonction qui affiche un erreur quand le mot de passe ou le pseudo sont
incorrectes */
  function formErreurAuthentification(){
    ?>
    <html>
    <head>
    <link rel="stylesheet" href="css/sheet.css" />
    </head>
      <body>
      <p> Erreur authentification, réessayez </p>
          <form method="post" action="index.php">
            <label for="pseudo"> Entrer votre pseudo </label> <input type="text" name="pseudo"/> <br />
            <label for="password"> Entrer votre mot de passe </label> <input type="password" name="password"/> <br /> <br />
            <input type="submit" name="connexion" value="Connexion"/> <input type="submit" name="inscription" value="S'inscrire">
          </form>
      </body>
    </html>
    <?php
      }

/* Fonction qui affiche une erreur lors de l'inscription si le pseudo existe déjà
dans la base de données */
  function inscriptionExiste(){ ?>
    <html>
    <head>
    <link rel="stylesheet" href="css/sheet.css" />
    </head>
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

/* Fonction qui affcihe une erreur si on sélectionne une bille impossible */
  function erreurSelectionBille(){ ?>
    <html>
    <head>
    <link rel="stylesheet" href="css/sheet.css" />
    </head>
      <body>
        <p> Impossible de sélectionner cette bille </p>
      </body>
    </html>
  <?php
}

/* Fonction qui affiche une erreur si on veut déplacer une bille de facon illégale */
  function erreurSelectionCase(){?>
    <html>
    <head>
    <link rel="stylesheet" href="css/sheet.css" />
    </head>
      <body>
        <p> Impossible de déplacer la bille </p>
      </body>
    </html>
    <?php
  }
}
?>
