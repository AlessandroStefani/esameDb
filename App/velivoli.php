<?php
require_once 'bt.php';

//Base Template
$templateParams["titolo"] = "Velivoli";
$templateParams["nome"] = "Velivoli.php";

//Velivoli
$templateParams["terra"] = $dbh->getVelivoli("terra");
$templateParams["volo"] = $dbh->getVelivoli("volo");
$templateParams["coda"] = $dbh->getVelivoli("coda");
$templateParams["controllo"] = $dbh->getVelivoli("controllo");



require 'front/home.php';
?>