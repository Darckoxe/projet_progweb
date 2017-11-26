<?php

class VueErreur{

function erreurAuthentification(){
header("Content-type: text/html; charset=utf-8");
?>

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

function erreurSuppression(){
header("Content-type: text/html; charset=utf-8");
?>
  <html>
    <body>
        <?php
        $plateau = array(); // On crée une matrice
        $plateau[0] = array("O","O","X","X","X","O","O");
        $plateau[1] = array("O","O","X","X","X","O","O");
        $plateau[2] = array("X","X","X","X","X","X","X");
        $plateau[3] = array("X","X","X","X","X","X","X");
        $plateau[4] = array("X","X","X","X","X","X","X");
        $plateau[5] = array("O","O","X","X","X","O","O");
        $plateau[6] = array("O","O","X","X","X","O","O");

        for ($i=0; $i <7; $i++) {
          echo "<br/>";
          for ($j=0; $j <7 ; $j++) {
            if($plateau[$i][$j] == "X"){
              $plateau[$i][$j] = "<img src='css/img/bille.png' alt='bille'>";
            }
            if($plateau[$i][$j] == "O"){
              $plateau[$i][$j] = "<img src='css/img/vide.png' alt='vide'>";
            }
            echo $plateau[$i][$j];
          }
        }
        ?>

        <form action="index.php" method="post">
          <br/>
          <p> La ligne ou la colonne que vous avez choisi est invalide, recommencez. </p>
          <label for="coordonnees_remove_x">Indiquer la ligne du pion à supprimer</label>
          <input type="number" name="coordonnees_remove_x" value="1" min="1" max="7"> <br/>
          <label for="coordonnees_remove_y">Indiquer la colonne du pion à supprimer</label>
          <input type="number" name="coordonnees_remove_y" value="1" min="1" max="7"><br/>

          <input type="submit" name="jouer" value="Jouer">
        </form>
    </body>
  </html>
<?php
  }

function erreurSelection(){
  header("Content-type: text/html; charset=utf-8");
  ?>
  <html>
      <body>
        <?php
        // $_SESSION['pion_supprime_x'] = $x;
        // $_SESSION['pion_supprime_y'] = $y;

        $plateau = array(); // On crée une matrice
        $plateau[0] = array("O","O","X","X","X","O","O");
        $plateau[1] = array("O","O","X","X","X","O","O");
        $plateau[2] = array("X","X","X","X","X","X","X");
        $plateau[3] = array("X","X","X","X","X","X","X");
        $plateau[4] = array("X","X","X","X","X","X","X");
        $plateau[5] = array("O","O","X","X","X","O","O");
        $plateau[6] = array("O","O","X","X","X","O","O");

        $plateau[$_SESSION['pion_supprime_x']][$_SESSION['pion_supprime_y']] = "O";

        for ($i=0; $i <7; $i++) {
          echo "<br/>";
          for ($j=0; $j <7 ; $j++) {
            if($plateau[$i][$j] == "X"){
              $plateau[$i][$j] = "<img src='css/img/bille.png' alt='bille'>";
            }
            if($plateau[$i][$j] == "O"){
              $plateau[$i][$j] = "<img src='css/img/vide.png' alt='vide'>";
            }
            echo $plateau[$i][$j];
          }
        }
        ?>

        <form action="index.php" method="post">
          <br/>
          <p> Impossible de selectionner cette bille ! </p>
          <label for="coordonnees_tomove_x">Indiquer la ligne du pion à déplacer</label>
          <input type="number" name="coordonnees_tomove_x" value="1" min="1" max="7"> <br/>
          <label for="coordonnees_tomove_y">Indiquer la colonne du pion à déplacer</label>
          <input type="number" name="coordonnees_tomove_y" value="1" min="1" max="7"><br/>

          <input type="submit" name="selection_pion" value="Selectionner le pion">
        </form>

      </body>
  </html>
  <?php
  }
}
?>
