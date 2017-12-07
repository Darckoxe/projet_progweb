<?php
class VuePartie{

  function formTexteDebut(){
  ?>
  <html>
    <body>
      <p> Pour commencer à jouer, cliquer sur une bille pour la supprimer. </p>
    </body>
  </html>
  <?php
    }

  /* Bouton pour lancer une nouvelle partie */
  function formNouvellePartie(){
  ?>
  <html>
    <body>
          <a href="index.php?nouvelle_partie"><button>Nouvelle partie</button></a>
    </body>
  </html>
  <?php
    }
  /* Bouton pour se déconnecter et revenir au formulaire de connexion */
  function formDeconnexion(){
  ?>
  <html>
    <body>
      <a href="index.php?disconnect"><button>Se deconnecter</button></a>
    </body>
  </html>
  <?php
    }
  /* Bouton pour accéder à ses statistiques */
  function formStats(){
  ?>
  <html>
    <body>
      <a href="index.php?statistiques"><button>Voir les statistiques</button></a>
    </body>
  </html>
  <?php
    }

/* Fonction qui permet d'afficher le plateau en fonction de l'état de la case, de
la variable de session error et de l'état des liens ainsi que du nombre de billes restantes. */
  function afficherPlateau(){
    echo "<html>";
    echo "<head>";
    echo "<link rel=\"stylesheet\" href=\"css/sheet.css\" />";
    echo "</head>";
    echo "<body>";
    echo "<table>";
    for ($i=0; $i <7; $i++) {
      echo "<tr>";
      for ($j=0; $j <7 ; $j++) {
        if($_SESSION['plateau'][$i][$j] == "X"){
            echo "<td class=\"case_bille\">";
          if($_SESSION['nb_bille'] == 33){
            ?>
              <a href="index.php?supprimerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille.png' alt='bille'></a>
            <?php
          }
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['supprimerBille']))) {
            ?>
            <a href="index.php?selectionnerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille.png' alt='bille'></a>
            <?php
          }
          if ((isset($_GET['selectionnerBille'])) && ($_SESSION['error'] == true)) {
            ?>
            <a href="index.php?selectionnerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille.png' alt='bille'></a>
            <?php
          }
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['selectionnerBille'])) && ($_SESSION['error'] == false)) {
            ?>
            <a href="index.php?selectionnerCase<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille.png' alt='bille'></a>
            <?php
          }
          if ((isset($_GET['selectionnerCase'])) && ($_SESSION['error'] == true)) {
            ?>
            <a href="index.php?selectionnerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille.png' alt='bille'></a>
            <?php
          }
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['selectionnerCase'])) && ($_SESSION['error'] == false)) {
            ?>
            <a href="index.php?selectionnerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille.png' alt='bille'></a>
            <?php
          }
          echo "</td>";
        }

        if($_SESSION['plateau'][$i][$j] == "O"){
          echo "<td class=\"case_vide\">";
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['supprimerBille']))) {
            ?>
            <a href="index.php?selectionnerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/vide.png' alt='vide'></a>
            <?php
          }
          if ((isset($_GET['selectionnerBille'])) && ($_SESSION['error'] == true)) {
            ?>
            <a href="index.php?selectionnerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/vide.png' alt='vide'></a>
            <?php
          }
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['selectionnerBille'])) && ($_SESSION['error'] == false)) {
            ?>
            <a href="index.php?selectionnerCase<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/vide.png' alt='vide'></a>
            <?php
          }
          if ((isset($_GET['selectionnerCase'])) && ($_SESSION['error'] == true)) {
            ?>
            <a href="index.php?selectionnerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/vide.png' alt='vide'></a>
            <?php
          }
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['selectionnerCase'])) && ($_SESSION['error'] == false)) {
            ?>
            <a href="index.php?selectionnerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/vide.png' alt='vide'></a>
            <?php
          }
          echo "</td>";
        }

        if($_SESSION['plateau'][$i][$j] == "+"){
          echo "<td class=\"case_selectionnee\">";
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['supprimerBille']))) {
            ?>
            <a href="index.php?selectionBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille_selection.png' alt='bille_selection'></a>
            <?php
          }
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['selectionnerBille']))) {
            ?>
            <a href="index.php?selectionnerCase<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille_selection.png' alt='bille_selection'></a>
            <?php
          }
          if ((isset($_GET['selectionnerCase'])) && ($_SESSION['error'] == true)) {
            ?>
            <a href="index.php?selectionnerCase<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille_selection.png' alt='bille_selection'></a>
            <?php
          }
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['selectionnerCase'])) && ($_SESSION['error'] == false)) {
            ?>
            <a href="index.php?selectionnerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille_selection.png' alt='bille_selection'></a>
            <?php
          }
          echo "</td>";
        }
        if ($_SESSION['plateau'][$i][$j] == "/") {
          echo "<td class=\"case_interdite\">";
          echo "<img src='css/img/rayures.png' alt='rayures'>";
          echo "</td>";
        }
      }
      echo "</tr>";
    }
    echo "</table>";
    echo "</body>";
    echo "</html>";
  }
}
?>
