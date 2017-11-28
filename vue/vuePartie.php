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

  function creerPlateau(){
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
        if($_SESSION['plateau'][$i][$j] == "+"){
          $_SESSION['plateau'][$i][$j] = "<img src='css/img/bille_selection.png' alt='sel'>";
        }
        echo $_SESSION['plateau'][$i][$j];
      }
    }
  }

  function afficherPlateau(){
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
    echo $_SESSION['plateau'][$i][$j];
  }

  function initPlateau(){
        echo "Bienvenue sur le plateau de jeu du solitaire !."."\n"."Supprimez une bille pour commencer";
        $this->creerPlateau();
        $this->formSupprimerBille();
    }

  function supprimerBille($x_del,$y_del){ // coordonnées de la bille à supprimer
    $_SESSION['x_del'] = $x_del;
    $_SESSION['y_del'] = $y_del;
    $_SESSION['plateau'][$x_del][$y_del] = "O";
    $this->afficherPlateau();
    $this->formSelectionnerBille();
  }

  function selectionBille($x_sel,$y_sel){ // coordonnées de la bille à selectionner
    $_SESSION['x_sel'] = $x_sel;
    $_SESSION['y_sel'] = $y_sel;
    $_SESSION['plateau'][$x_sel][$y_sel] = "+"; // on sélectionne la bille
    $this->afficherPlateau();
    $this->formDeplacerBille();
  }

  function deplacerBille($x_move,$y_move){ // coordonnées de la case à atteindre
    $_SESSION['x_move'] = $x_move;
    $_SESSION['y_move'] = $y_move;
    $_SESSION['plateau'][$x_move][$y_move] = "X"; // on met la bille sélectionnée sur la case à atteindre
    $_SESSION['plateau'][$_SESSION['x_sel']][$_SESSION['y_sel']] = "O"; // on retire la bille qui a bougé de la case initiale

    /* Suppression de la bille sautée */

    if ($_SESSION['x_sel'] - $x_move == 0) { // La bille est déplacée sur la ligne
      if(($_SESSION['y_sel'] - $y_move) < 0){
        $x_saute = $_SESSION['x_sel'];
        $y_saute = $_SESSION['y_sel']+1;
      }
      else{
        $x_saute = $_SESSION['x_sel'];
        $y_saute = $_SESSION['y_sel']-1;
      }
    }

    if($_SESSION['y_sel'] - $y_move == 0) { // La bille est déplacée sur la colonne
      if(($_SESSION['x_sel'] - $x_move) < 0){
        $x_saute = $_SESSION['x_sel']+1;
        $y_saute = $_SESSION['y_sel'];
      }
      else{
        $x_saute = $_SESSION['x_sel']-1;
        $y_saute = $_SESSION['y_sel'];
      }
    }

    $_SESSION['plateau'][$x_saute][$y_saute] = "O"; // On supprime la bille sautée

    $this->afficherPlateau();
    $this->formSelectionnerBille();
  }
}
?>
