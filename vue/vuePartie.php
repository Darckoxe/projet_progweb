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
        <label for="coordonnees_remove_x">Indiquer la ligne de la bille à supprimer</label>
        <input type="number" name="coordonnees_remove_x" value="1" min="1" max="6"> <br/>
        <label for="coordonnees_remove_y">Indiquer la colonne de la bille à supprimer</label>
        <input type="number" name="coordonnees_remove_y" value="1" min="1" max="6"><br/>

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
      $_SESSION['pion_supprime_x'] = $x;
      $_SESSION['pion_supprime_y'] = $y;

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

function selectionnerPion($x,$y){

$x_del = $_SESSION['pion_supprime_x'];
$y_del =  $_SESSION['pion_supprime_y'];
$_SESSION['pion_selection_x'] = $x;
$_SESSION['pion_selection_y'] = $y;


  $plateau = array();
  $plateau[0] = array("O","O","X","X","X","O","O");
  $plateau[1] = array("O","O","X","X","X","O","O");
  $plateau[2] = array("X","X","X","X","X","X","X");
  $plateau[3] = array("X","X","X","X","X","X","X");
  $plateau[4] = array("X","X","X","X","X","X","X");
  $plateau[5] = array("O","O","X","X","X","O","O");
  $plateau[6] = array("O","O","X","X","X","O","O");

  $plateau[$x][$y] = "+";
  $plateau[$x_del][$y_del] = "O";

    for ($i=0; $i <7; $i++) {
      echo "<br/>";
      for ($j=0; $j <7 ; $j++) {
        if($plateau[$i][$j] == "X"){
          $plateau[$i][$j] = "<img src='css/img/bille.png' alt='bille'>";
        }
        if($plateau[$i][$j] == "O"){
          $plateau[$i][$j] = "<img src='css/img/vide.png' alt='vide'>";
        }
        if($plateau[$i][$j] == "+"){
          $plateau[$i][$j] = "<img src='css/img/bille_selection.png' alt='bille_selectionee'>";
        }
        echo $plateau[$i][$j];
      }
    }
?>
    <form action="index.php" method="post">
      <br/>
      <label for="coordonnees_moved_x">Indiquer la ligne de la case à atteindre</label>
      <input type="number" name="coordonnees_moved_x" value="1" min="1" max="7"> <br/>
      <label for="coordonnees_moved_y">Indiquer la colonne de la case à atteindre</label>
      <input type="number" name="coordonnees_moved_y" value="1" min="1" max="7"><br/>

      <input type="submit" name="deplacer" value="Déplacer le pion">
    </form>
<?php
  }
function deplacerPion($x,$y){
  $x_del = $_SESSION['pion_supprime_x'];
  $y_del =  $_SESSION['pion_supprime_y'];
  $x_sel = $_SESSION['pion_selection_x'];
  $y_sel = $_SESSION['pion_selection_y'];

    $plateau = array();
    $plateau[0] = array("O","O","X","X","X","O","O");
    $plateau[1] = array("O","O","X","X","X","O","O");
    $plateau[2] = array("X","X","X","X","X","X","X");
    $plateau[3] = array("X","X","X","X","X","X","X");
    $plateau[4] = array("X","X","X","X","X","X","X");
    $plateau[5] = array("O","O","X","X","X","O","O");
    $plateau[6] = array("O","O","X","X","X","O","O");

    /* On regarde les coordonnées passés en paramètre. Si elles ont un "X" alors
    on peut bouger. Si elles ont un "O", on ne peut pas bouger */
    if($plateau[$x][$y] == "O"){
      $this->supprimerPion($x_del,$y_del);
      return;
    }

    //Déplacement sur la ligne
    if ($x_sel - $x == 0) {
      $x_saute = $x_sel;
      $y_saute = $y_sel-1;
    }
    //Déplacement en colonne
    if($y_sel - $y == 0){
      $x_saute = $x_sel-1;
      $y_saute = $y_sel;
    }

    $plateau[$x_del][$y_del] = "O";
    $plateau[$x][$y] = "+";
    $plateau[$x_sel][$y_sel] = "O";
    $plateau[$x_saute][$y_saute] = "O";

    for ($i=0; $i <7; $i++) {
      echo "<br/>";
      for ($j=0; $j <7 ; $j++) {
        if($plateau[$i][$j] == "+"){
          $plateau[$i][$j] = "<img src='css/img/bille_selection.png' alt='bille'>";
        }
        if($plateau[$i][$j] == "X"){
          $plateau[$i][$j] = "<img src='css/img/bille.png' alt='bille'>";
        }
        if($plateau[$i][$j] == "O"){
          $plateau[$i][$j] = "<img src='css/img/vide.png' alt='vide'>";
        }
        echo $plateau[$i][$j];
      }
    }
  }
}
?>
