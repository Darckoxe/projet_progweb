<?php

class VuePartie{

function accueil(){
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
          echo $plateau[$i][$j];
        }
      }
      ?>

      <form action="index.php" method="post">
        <br/>
        <label for="coordonnees_remove_x">Indiquer l'abscisse du pion à supprimer</label>
        <input type="number" name="coordonnees_remove_x" value="1" min="1" max="7"> <br/>
        <label for="coordonnees_remove_y">Indiquer l'ordonnée du pion à supprimer</label>
        <input type="number" name="coordonnees_remove_y" value="1" min="1" max="7"><br/>

        <input type="submit" name="jouer" value="Jouer">
      </form>
  </body>
</html>
<?php
  }

function supprimerPion($x,$y){
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

      $plateau[$x][$y] = "O";

      for ($i=0; $i <7; $i++) {
        echo "<br/>";
        for ($j=0; $j <7 ; $j++) {
          echo $plateau[$i][$j];
        }
      }
      ?>

      <form action="index.php" method="post">
        <br/>
        <label for="coordonnees_tomove_x">Indiquer l'abscisse du pion à déplacer</label>
        <input type="number" name="coordonnees_tomove_x" value="1" min="1" max="7"> <br/>
        <label for="coordonnees_tomove_y">Indiquer l'ordonnée du pion à déplacer</label>
        <input type="number" name="coordonnees_tomove_y" value="1" min="1" max="7"><br/>
        <br/>
        <label for="coordonnees_moved_x">Indiquer l'abscisse de la case à atteindre</label>
        <input type="number" name="coordonnees_moved_x" value="1" min="1" max="7"> <br/>
        <label for="coordonnees_moved_y">Indiquer l'ordonnée de la case à atteindre</label>
        <input type="number" name="coordonnees_moved_y" value="1" min="1" max="7"><br/>

        <input type="submit" name="jouer" value="Déplacer le pion">
      </form>

    </body>
</html>
<?php
  }
}
?>
