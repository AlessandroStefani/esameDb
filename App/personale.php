<?php
require_once 'bt.php';

$templateParams["titolo"] = "Personale";
$templateParams["nome"] = "personale.php";

$templateParams["personale"] = $dbh->getPersonale();

if(isset($_GET["id"])){
    $templateParams["voliMembro"] = $dbh->getVoliMembro($_GET["id"]);
}

foreach ($templateParams["personale"] as $membro) {
    $voli = $dbh->getVoliMembro($membro["codicePersonale"]);
    if ($membro["stato"] == "volo") {
        $voloTerminato = true;
        foreach ($voli as $volo) {
            $dataPartenza = new DateTime($volo["data"] . $volo["ora"]);
            $durataOre = explode(":", $volo["durata"])[0];
            $durataMinuti = explode(":", $volo["durata"])[1];
            $dataArrivo = date_add(new DateTime($volo["data"] . $volo["ora"]), date_interval_create_from_date_string($durataOre . "hours" . $durataMinuti . "minutes"));
            $dataUpdate = new DateTime("now");
            if (($dataPartenza < $dataUpdate) && ($dataUpdate < $dataArrivo)) {
                $voloTerminato = false;
                break;
            }
        }
        if ($voloTerminato) {
            $dbh->updateStatoPersonale($membro["codicePersonale"], "terra");
            $ore = explode(":",$volo["durata"])[0] + $membro["oreAccumulate"];
            if ($ore < 10) {
                $dbh->updateOrePersonale($membro["codicePersonale"], $ore);
            }  else {                
                $dbh->updateOrePersonale($membro["codicePersonale"], "0");
                $dbh->updateStatoPersonale($membro["codicePersonale"], "riposo");
                $t = new DateTime("now");
                $dbh->inserisciRiposo($membro["codicePersonale"], $t->format("Y-m-d"), $t->format("H:i:s"));
            }
            if ($membro["ruolo"] == "pilota") {
                $ore = explode(":",$volo["durata"])[0] + $membro["oreDiVolo"];
                $dbh->updateOreVoloPiloti($membro["codicePersonale"], $ore);
            }
        }
    }
    
    if ($membro["stato"] == "riposo") {
        $lastRiposino = $dbh->getLastRiposo($membro["codicePersonale"]);
        if (count($lastRiposino)) {
            $lastRiposino = $lastRiposino[0];
            $data = $lastRiposino["data"];
            $ora = $lastRiposino["ora"];
            $fine = date_add(new DateTime($data.$ora), date_interval_create_from_date_string("10hours"));
            if ($fine->format("Y-m-d H:i:s") < date("Y-m-d H:i:s")) {
                $dbh->updateStatoPersonale($membro["codicePersonale"], "terra");
            }
        }
    }

}
require 'front/home.php';
?>