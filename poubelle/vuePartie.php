<?php

class VuePartie{

function formSupprimerBille(){?>
  <html>
    <body>
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

function formSelectionnerBille(){ ?>
<html>
  <body>
  <form action="index.php" method="post">
    <br/>
    <label for="coordonnees_tomove_x">Indiquer la ligne de la bille à sélectionner</label>
    <input type="number" name="coordonnees_tomove_x" value="1" min="1" max="7"> <br/>
    <label for="coordonnees_tomove_y">Indiquer la colonne de la bille à sélectionner</label>
    <input type="number" name="coordonnees_tomove_y" value="1" min="1" max="7"><br/>

    <input type="submit" name="selection_pion" value="Selectionner la bille">
  </form>
</body>
</html>
<?php
}

function formDeplacerBille(){?>
  <html>
  <body>
  <form action="index.php" method="post">
    <br/>
    <label for="coordonnees_moved_x">Indiquer la ligne de la case à atteindre</label>
    <input type="number" name="coordonnees_moved_x" value="1" min="1" max="7"> <br/>
    <label for="coordonnees_moved_y">Indiquer la colonne de la case à atteindre</label>
    <input type="number" name="coordonnees_moved_y" value="1" min="1" max="7"><br/>

    <input type="submit" name="deplacer" value="Déplacer la bille">
  </form>
  </body>
  </html>
<?php
}

function accueil(){
header("Content-type: text/html; charset=utf-8");

      echo "Vue accueil";
      $plateau = array(); // On crée une matrice
      $plateau[0] = array("O","O","X","X","X","O","O");
      $plateau[1] = array("O","O","X","X","X","O","O");
      $plateau[2] = array("X","X","X","X","X","X","X");
      $plateau[3] = array("X","X","X","X","X","X","X");
      $plateau[4] = array("X","X","X","X","X","X","X");
      $plateau[5] = array("O","O","X","X","X","O","O");
      $plateau[6] = array("O","O","X","X","X","O","O");

      $_SESSION['plateau'] = $plateau;

      for ($i=0; $i <7; $i++) {
        echo "<br/>";
        for ($j=0; $j <7 ; $j++) {
          if($_SESSION['plateau'][$i][$j] == "X"){
            $_SESSION['plateau'][$i][$j] = "<img src='css/img/bille.png' alt='bille'>";
          }
          if($_SESSION['plateau'][$i][$j] == "O"){
            $_SESSION['plateau'][$i][$j] = "<img src='css/img/vide.png' alt='vide'>";
          }
          echo $_SESSION['plateau'][$i][$j];
        }
      }
      $this->formSupprimerBille();
  }

function supprimerPion($x,$y){
header("Content-type: text/html; charset=utf-8");

      echo "Vue supprimerPion";
      $_SESSION['x_del'] = $x;
      $_SESSION['y_del'] = $y;
      $_SESSION['plateau'][$x][$y] = "O";

      for ($i=0; $i <7; $i++) {
        echo "<br/>";
        for ($j=0; $j <7 ; $j++) {
          if($_SESSION['plateau'][$i][$j] == "X"){
            $_SESSION['plateau'][$i][$j] = "<img src='css/img/bille.png' alt='bille'>";
          }
          if($_SESSION['plateau'][$i][$j] == "O"){
            $_SESSION['plateau'][$i][$j] = "<img src='css/img/vide.png' alt='vide'>";
          }
          echo $_SESSION['plateau'][$i][$j];
        }
      }
      $this->formSelectionnerBille();
  }

function selectionnerPion($x,$y){
echo "Vue selectionnerPion";
$_SESSION['plateau'][$x][$y] = "+";
$_SESSION['x_sel'] = $x;
$_SESSION['y_sel'] = $y;

  for ($i=0; $i <7; $i++) {
    echo "<br/>";
    for ($j=0; $j <7 ; $j++) {
      if($_SESSION['plateau'][$i][$j] == "X"){
        $_SESSION['plateau'][$i][$j] = "<img src='css/img/bille.png' alt='bille'>";
      }
      if($_SESSION['plateau'][$i][$j] == "O"){
        $_SESSION['plateau'][$i][$j] = "<img src='css/img/vide.png' alt='vide'>";
      }
      if($_SESSION['plateau'][$i][$j] == "+"){
        $_SESSION['plateau'][$i][$j] = "<img src='css/img/bille_selection.png' alt='sel'>";
      }
      echo $_SESSION['plateau'][$i][$j];
    }
  }
  $_SESSION['plateau'][$_SESSION['x_sel']][$_SESSION['y_sel']] = "O";
  $this->formDeplacerBille();
}

function deplacerPion($x,$y){
echo "deplacerPion";

$_SESSION['plateau'][$_SESSION['x_sel']][$_SESSION['y_sel']] = "O";
$_SESSION['plateau'][$x][$y] = "+";

/* Dans cette boucle, on déplace la bille sélectionnée par dessus l'autre bille */
  for ($i=0; $i <7; $i++) {
    echo "<br/>";
    for ($j=0; $j <7 ; $j++) {
      if($_SESSION['plateau'][$i][$j] == "X"){
        $_SESSION['plateau'][$i][$j] = "<img src='css/img/bille.png' alt='bille'>";
      }
      if($_SESSION['plateau'][$i][$j] == "O"){
        $_SESSION['plateau'][$i][$j] = "<img src='css/img/vide.png' alt='vide'>";
      }
      if($_SESSION['plateau'][$i][$j] == "+"){
        $_SESSION['plateau'][$i][$j] = "<img src='css/img/bille_selection.png' alt='sel'>";
      }
      echo $_SESSION['plateau'][$i][$j];
    }
  }

    /* On regarde les coordonnées passés en paramètre. Si elles ont un "X" alors
    on peut bouger. Si elles ont un "O", on ne peut pas bouger */
    if($_SESSION['plateau'][$x][$y] == "O"){
      $this->supprimerPion($_SESSION['x_del'],$_SESSION['y_del']);
      return;
    }
    /* On vérifie si une case côte à côte est selectionné et on renvoie la vue
    pour annuler le déplacement*/
    if (($_SESSION['x_sel'] - $x == 1) || ($_SESSION['x_sel'] - $x == -1)) {
      $this->supprimerPion($_SESSION['x_del'],$_SESSION['y_del']);
      return;
    }
    if (($_SESSION['y_sel'] - $y == 1) || ($_SESSION['y_sel'] - $y == -1)) {
      $this->supprimerPion($_SESSION['x_del'],$_SESSION['y_del']);
      return;
    }

    //Déplacement sur la ligne
    if ($_SESSION['x_sel'] - $x == 0) {
      $x_saute = $_SESSION['x_sel'];
      $y_saute = $_SESSION['y_sel']-1;
    }
    //Déplacement en colonne
    if($_SESSION['y_sel'] - $y == 0){
      $x_saute = $_SESSION['x_sel']-1;
      $y_saute = $_SESSION['y_sel'];
    }

    /* Dans cette partie du code, on supprime la bille sélectionnée à sa position initiale
    car elle s'est déplacée et on supprime aussi la bille sautée*/
    $_SESSION['plateau'][$_SESSION['x_del']][$_SESSION['y_del']] = "O";
    $_SESSION['plateau'][$_SESSION['x_sel']][$_SESSION['y_sel']] = "O";
    $_SESSION['plateau'][$x][$y] = "+";
    $_SESSION['plateau'][$x_saute][$y_saute] = "O";

    for ($j=0; $j <7 ; $j++) {
      if($_SESSION['plateau'][$i][$j] == "X"){
        $_SESSION['plateau'][$i][$j] = "<img src='css/img/bille.png' alt='bille'>";
      }
      if($_SESSION['plateau'][$i][$j] == "O"){
        $_SESSION['plateau'][$i][$j] = "<img src='css/img/vide.png' alt='vide'>";
      }
      if($_SESSION['plateau'][$i][$j] == "+"){
        $_SESSION['plateau'][$i][$j] = "<img src='css/img/bille_selection.png' alt='sel'>";
      }
      echo $_SESSION['plateau'][$i][$j];
    }
    $_SESSION['plateau'][$x][$y] = "X";
    $_SESSION['plateau'][$_SESSION['x_sel']][$_SESSION['y_sel']] = "X";
    $this->formSelectionnerBille();
  }
}
?>
