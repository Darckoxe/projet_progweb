<?php
class VuePartie{
  function formNouvellePartie(){
  ?>
  <html>
    <body>
        <form method="post" action="index.php">
          <input type="submit" name="nouvelle_partie" value="Nouvelle partie"/>
        </form>
    </body>
  </html>
  <?php
    }

  function formStats(){
  ?>
  <html>
    <body>
        <form method="post" action="index.php">
          <input type="submit" name="stats" value="Voir les statistiques"/>
        </form>
    </body>
  </html>
  <?php
    }

  function formRetourJeu(){
    ?>
    <html>
      <body>
          <form method="post" action="index.php">
            <input type="submit" name="retourJeu" value="Retour"/>
          </form>
      </body>
    </html>
    <?php
  }

  function creerPlateau(){
    $plateau = array(); // On crée une matrice
    $plateau[0] = array("/","/","X","X","X","/","/");
    $plateau[1] = array("/","/","X","X","X","/","/");
    $plateau[2] = array("X","X","X","X","X","X","X");
    $plateau[3] = array("X","X","X","X","X","X","X");
    $plateau[4] = array("X","X","X","X","X","X","X");
    $plateau[5] = array("/","/","X","X","X","/","/");
    $plateau[6] = array("/","/","X","X","X","/","/");

    $_SESSION['plateau'] = $plateau;
    $_SESSION['nb_bille']= 33;

    $this->afficherPlateau();
  }

  function initPlateau(){
    $this->creerPlateau();
    echo "Pour commencer à jouer, cliquer sur une bille pour la supprimer.";
    echo "<br/>";
    echo "Il reste ".$_SESSION['nb_bille']." billes sur le plateau";

  }

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
