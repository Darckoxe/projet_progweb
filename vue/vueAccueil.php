<?php

class VueAccueil{
/* Fonction qui affiche le formulaire de connexion */
function formConnexion(){
// header("Content-type: text/html; charset=utf-8");
?>
<html>
  <body>
      <form method="post" action="index.php">
        <label for="pseudo"> Entrer votre pseudo </label> <input type="text" name="pseudo"/> <br />
        <label for="password"> Entrer votre mot de passe </label> <input type="password" name="password"/> <br /> <br />
        <input type="submit" name="connexion" value="Connexion"/> <input type="submit" name="inscription" value="S'inscrire">
      </form>
  </body>
</html>
<?php
  }

/* Fonction qui affiche le formulaire d'inscription*/
function formInscription(){?>
  <html>
    <body>
      <p> Vous êtes sur le point de vous inscrire, renseignez le formulaire ci-dessous </p>
        <form method="post" action="index.php">
          <label for="pseudo"> Entrer votre pseudo </label> <input type="text" name="pseudo_inscription"/> <br />
          <label for="password"> Entrer votre mot de passe </label> <input type="password" name="password_inscription"/> <br /> <br />
          <input type="submit" name="valider_inscription" value="Valider l'inscription">
        </form>
    </body>
  </html>
<?php  }

/* Fonction qui affiche la confirmation d'inscription */
function confirmInscription(){?>
  <html>
    <body>
      <p> Félicitations, votre inscription a été enregistrée </p>
      <?php $this->formConnexion(); ?>
    </body>
  </html>
<?php }
}
?>
