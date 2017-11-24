<?php
session_start();

require "config.php";
require PATH_CONTROLEUR."/routeur.php";

$routeur=new Routeur();
$routeur->routerRequete();

?>
