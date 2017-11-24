<?php

class VueAccueil{

function accueil(){
header("Content-type: text/html; charset=utf-8");
?>

<html>
  <body>
    <br/>
    <br/>
      <form method="post" action="index.php">
        <label for="pseudo"> Entrer votre pseudo </label> <input type="text" name="pseudo"/> <br />
        <label for="password"> Entrer votre mot de passe </label> <input type="text" name="password"/> <br /> <br />
        <input type="submit" name="soumettre" value="Envoyer"/>
      </form>
  </body>
</html>


<?php
}

}
?>
