<?php
class VueResultat{

/* Fonction qui permet de voir le résultat */
function afficherTestVictoire(){
  if ($_SESSION['resultat'] == true) {
    ?>
    <html>
      <body>
        <p> Félicitations vous avez gagné ! </p>
        <a href="index.php?nouvelle_partie"><button>Nouvelle partie</button></a>
        <a href="index.php?statistiques"><button>Voir les statistiques</button></a>
      </body>
    </html>
  <?php }

  else {
    ?>
    <html>
      <body>
        <p> Dommage, vous avez perdu... </p>
        <a href="index.php?nouvelle_partie"><button>Nouvelle partie</button></a>
        <a href="index.php?statistiques"><button>Voir les statistiques</button></a>
      </body>
    </html>
    <?php
    }
  }
}
?>
