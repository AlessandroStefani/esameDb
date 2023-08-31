<?php 
require_once 'bt.php';

//Base Template
$templateParams["titolo"] = "Voli";
$templateParams["nome"] = "voli.php";

$templateParams["voli"] = $dbh->getVoli();

if (isset($_GET["idVolo"])) {
    $idVolo = $_GET["idVolo"];
    $templateParams["personaleDiVolo"] = $dbh->getPersonaleDiVolo($idVolo);
    $templateParams["passeggeriVolo"] = $dbh->getPasseggeriVolo($idVolo);
}

foreach ($templateParams["voli"] as $volo) {
    $dataPartenza = new DateTime($volo["data"].$volo["ora"]);
    $durataOre = explode(":",$volo["durata"])[0];
    $durataMinuti = explode(":",$volo["durata"])[1];
    $dataArrivo = date_add($dataPartenza, date_interval_create_from_date_string($durataOre."hours".$durataMinuti."minutes"));
    $dataUpdate = new DateTime("now");
    if ($dataPartenza > $dataUpdate && $dataPartenza < $dataArrivo) {
        $dbh->updateStatoVelivolo($volo["idVelivolo"], "volo");
        $dbh->updateStatoPersonale($volo["codiceVolo"], "volo");
    }
}

require 'front/home.php';
?>