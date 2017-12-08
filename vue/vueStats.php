<?php
class VueStats{

/* Fonction qui permet de voir ses stats personnelles et générales */
function voirStatsPerso($stats,$classement){
  ?>
  <html>
    <body>
      <h1> Vos stats personnelles </h1>
      <p> <?php echo $stats ?> </p>
      <h1> Classement général </h1>
      <?php
      echo "<p>";
      foreach ($classement as $row) {
        echo $row['pseudo']." a un ratio de victoire de ".$row['ratio']."<br />";
      }
      echo "</p>";
      ?>
    </body>
</html>
<?php
  }

/* Bouton pour revenir de la page des statistiques au jeu */
  function formRetourJeu(){
    ?>
    <html>
      <body>
        <a href="index.php?retour_jeu"><button>Retour</button></a>
      </body>
    </html>
    <?php
  }
}
?>
