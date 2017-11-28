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

  function formErreurSupprimerBille(){?>
    <html>
      <body>
        <p>Impossible de supprimer cette bille, elle n'existe pas !</p>
        <form action="index.php" method="post">
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

  function formErreurSelectionnerBille(){ ?>
  <html>
    <body>
      <p>Impossible de sélectionner cette bille</p>
      <form action="index.php" method="post">
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

  function formErreurDeplacerBille(){?>
    <html>
    <body>
      <form action="index.php" method="post">
      <p>Impossible de déplacer cette bille</p>
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

  function erreurSuppression(){
    $this->afficherPlateau();
    $this->formErreurSupprimerBille();
  }

  function erreurSelection(){
    $this->afficherPlateau();
    $this->formErreurSelectionnerBille();
  }
}
?>
