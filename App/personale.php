<?php
require_once 'bt.php';

$templateParams["titolo"] = "Personale";
$templateParams["nome"] = "personale.php";

$templateParams["personale"] = $dbh->getPersonale();

if(isset($_GET["id"])){
    $templateParams["voliMembro"] = $dbh->getVoliMembro($_GET["id"]);
}

require 'front/home.php';
?>