<?php

class VueAccueil{
/* Fonction qui affiche le formulaire de connexion */
function formConnexion(){
// header("Content-type: text/html; charset=utf-8");
?>
<html>
  <head>
  <link rel="stylesheet" href="css/sheet.css" />
  </head>
  <body>
    <div class="form">
      <form method="post" action="index.php">
       <label for="pseudo"> Entrez votre pseudo </label> <input type="text" name="pseudo"/> <br />
       <label for="password"> Entrez votre mot de passe </label> <input type="password" name="password"/> <br /> <br />
        <label class="bouton"> </label> <input type="submit" name="connexion" value="Connexion"/> <input type="submit" name="inscription" value="S'inscrire"> </div>
      </form>
    </div>
  </body>
</html>
<?php
  }

/* Fonction qui affiche le formulaire d'inscription*/
function formInscription(){?>
  <html>
  <head>
  <link rel="stylesheet" href="css/sheet.css" />
  </head>
    <body>
      <div class="form">
      <p> Vous êtes sur le point de vous inscrire, renseignez le formulaire ci-dessous </p>
        <form method="post" action="index.php">
          <label for="pseudo"> Entrez votre pseudo </label> <input type="text" name="pseudo_inscription"/> <br />
          <label for="password"> Entrez votre mot de passe </label> <input type="password" name="password_inscription"/> <br /> <br />
          <input type="submit" name="valider_inscription" value="Valider l'inscription">
        </form>
      </div>
    </body>
  </html>
<?php  }

/* Fonction qui affiche la confirmation d'inscription */
function confirmInscription(){?>
  <html>
  <head>
  <link rel="stylesheet" href="css/sheet.css" />
  </head>
    <body>
      <?php $this->formConnexion(); ?>
      <p> Félicitations, votre inscription a été enregistrée </p>
    </body>
  </html>
<?php }
}
?>
