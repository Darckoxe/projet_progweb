<?php
class VuePartie{
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
    $_SESSION['nb_bille']= 33;

    $this->afficherPlateau();
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
            echo "<td class=\"case_utilisable\">";
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
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['selectionnerBille']))) {
            ?>
            <a href="index.php?selectionnerCase<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille.png' alt='bille'></a>
            <?php
          }
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['selectionnerCase']))) {
            ?>
            <a href="index.php?selectionnerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille.png' alt='bille'></a>
            <?php
          }
          echo "</td>";
        }
        if($_SESSION['plateau'][$i][$j] == "O"){
          echo "<td>";
          if($_SESSION['nb_bille'] == 33){
            ?>
            <a href="index.php?supprimerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/vide.png' alt='vide'></a>
            <?php
          }
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['supprimerBille']))) {
            ?>
            <a href="index.php?selectionnerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/vide.png' alt='vide'></a>
            <?php
          }
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['selectionnerBille']))) {
            ?>
            <a href="index.php?selectionnerCase<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/vide.png' alt='vide'></a>
            <?php
          }
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['selectionnerCase']))) {
            ?>
            <a href="index.php?selectionnerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/vide.png' alt='vide'></a>
            <?php
          }
          echo "</td>";
        }
        if($_SESSION['plateau'][$i][$j] == "+"){
          echo "<td>";
          if($_SESSION['nb_bille'] == 33){
            ?>
            <a href="index.php?supprimerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille_selection.png' alt='bille_selection'></a>
            <?php
          }
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['supprimerBille']))) {
            ?>
            <a href="index.php?selectionBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille_selection.png' alt='vide'></a>
            <?php
          }
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['selectionnerBille']))) {
            ?>
            <a href="index.php?selectionnerCase<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille_selection.png' alt='bille_selection'></a>
            <?php
          }
          if (($_SESSION['nb_bille'] <= 32) && (isset($_GET['selectionnerCase']))) {
            ?>
            <a href="index.php?selectionnerBille<?php echo "&i=".$i;?><?php echo "&j=".$j;?>"><img src='css/img/bille_selection.png' alt='bille_selection'></a>
            <?php
          }
          echo "</td>";
        }
      }
      echo "</tr>";
    }
    echo "</table>";
    echo "</body>";
    echo "</html>";
  }

  function initPlateau(){
    echo "<html>";
    echo "<head>";
    echo "<link rel=\"stylesheet\" href=\"css/sheet.css\" />";
    echo "</head>";
    echo "<body>";
    $this->creerPlateau();
    echo "<p> Pour commencer à jouer, supprimer une bille de votre choix. </p>";
    echo "</body>";
    echo "</html>";


  }
}
?>
