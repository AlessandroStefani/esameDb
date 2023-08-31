<?php
require_once 'bt.php';

//Base Template
$templateParams["titolo"] = "Programmazione";
$templateParams["nome"] = "nuovo_volo.php";

//
$templateParams["aeroporti"] = $dbh->getAeroporti();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $orig = $_POST["origine"];
    $dest = $_POST["destinazione"];
    $sca1 = $_POST["scalo1"];
    $sca2 = $_POST["scalo2"];
    $sca3 = $_POST["scalo3"];
    $part = $_POST["data_ora"];
    $dura = $_POST["durata"];

    $templateParams["pilotiOK"] = $dbh->selezionePiloti($part, $dura);
    $templateParams["assistentiOK"] = $dbh->selezioneAssistenti($part, $dura);
    $templateParams["velivoliOK"] = $dbh->selezioneVelivoli($part, $dura);
}




require 'front/home.php';
?>