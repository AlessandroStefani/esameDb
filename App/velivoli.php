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

$all = array_merge($templateParams["terra"], $templateParams["volo"], $templateParams["coda"], $templateParams["controllo"]);

foreach ($all as $v) {
    $voli = $dbh->getVoliVelivolo($v["idVelivolo"]);
    if ($v["stato"] == "volo") {
        $voloTerminato = true;
        foreach ($voli as $volo) {
            $dataPartenza = new DateTime($volo["data"] . $volo["ora"]);
            $durataOre = explode(":", $volo["durata"])[0];
            $durataMinuti = explode(":", $volo["durata"])[1];
            $dataArrivo = date_add(new DateTime($volo["data"] . $volo["ora"]), date_interval_create_from_date_string($durataOre . "hours" . $durataMinuti . "minutes"));
            $dataUpdate = new DateTime("now");
            if (($dataPartenza < $dataUpdate) && ($dataUpdate < $dataArrivo)) {
                $voloTerminato = false;
            }
        }
        if ($voloTerminato) {
            $dbh->updateStatoVelivolo($v["idVelivolo"], "terra");
            $ore = explode(":",$volo["durata"])[0] + $v["oreDiVolo"];
            $dbh->updateOreVolo($v["idVelivolo"], $ore);
        }
    }

    if ($v["stato"] == "terra") {
        $lastCheck = $dbh->getLastCheck($v["idVelivolo"])[0];
        $dataFine = date_create($lastCheck["dataFine"]);
        $now = date_create(date("Y-m-d"));
        $diff = date_diff($dataFine, $now)->format("%R%a");
        if ($diff[0] == "+" && explode("+",$diff)[1] > 70) {
            $dbh->updateStatoVelivolo($v["idVelivolo"], "coda");
        }
    }

    if ($v["stato"] == "controllo") {
        $controllo = $dbh->getLastCheck($v["idVelivolo"])[0];
        if ($controllo["dataFine"] < date("Y-m-d")) {
            $dbh->updateStatoVelivolo($v["idVelivolo"], "terra");
        }
    }
}

if (isset($_GET["id"])) {
    $templateParams["controlliVelivolo"] = $dbh->getControlliVelivolo($_GET["id"]);
} else if (isset($_GET["idV"])) {
    $templateParams["controlliVelivolo"] = $dbh->getControlliVelivolo($_GET["idV"]);
}

if (isset($_GET["infoC"])) {
    $templateParams["infoControllo"] = $dbh->getLastCheck($_GET["infoC"]);
}

if (isset($_POST["specifiche"])) {
    $idVelivolo = $_POST["idVelivolo"];
    $codiceControllo = $_POST["idControllo"];
    $specifiche = $_POST["specifiche"];
    $note = $_POST["note"];
    $dataInizio = new DateTime();
    $dataFine;
    $durata;
    switch ($specifiche) {
        case 'Tipo A':
            $durata = "1day";
            break;
        case 'Tipo C':
            $durata = "21days";
            break;
        case 'Tipo D':
            $durata = "42days";
            break;
        default:
            $durata = "1day";
            break;
    }
    $dataFine = date_add(new DateTime($dataInizio->format("Y-m-d")),date_interval_create_from_date_string($durata));

    if($dbh->inserisciControllo($idVelivolo, $codiceControllo, $specifiche, $durata, $dataInizio->format("Y-m-d"), $dataFine->format("Y-m-d"), $note)) {
        $templateParams["err"] = "Inserimento avvenuto";
        $dbh->updateStatoVelivolo($idVelivolo, "controllo");
    }else {
        $templateParams["err"] = "Qualcosa è andato storto :/";
    }
}

require 'front/home.php';
?>