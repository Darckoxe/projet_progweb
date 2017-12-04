<?php
class VueStats{

function voirStatsPerso($stats,$classement){?>
  <html>
    <body>
      <h1> Vos stats personnelles </h1>
      <p> <?php echo $stats ?> </p>
      <h1> Classement général </h1>
      <?php
      foreach ($classement as $row) {
        echo $row['pseudo']." a un ratio de victoire de ".$row['ratio']."<br />";
      }
      ?>
      <table>
    </body>
</html>
<?php
  }
}
?>
