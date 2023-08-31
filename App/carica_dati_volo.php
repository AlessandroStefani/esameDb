<?php
require_once "bt.php";

if (isset($_POST["infoVolo"]) && isset($_POST["personale"])) {
    $infoVolo = json_decode($_POST["infoVolo"]);
    $personale = json_decode($_POST["personale"]);
    $codiceVolo = $dbh->creaVolo($infoVolo);
    $dbh->associaPersonale($codiceVolo, $personale);
    if (isset($_POST["scali"])) {
        $scali = json_decode($_POST["scali"]);
        $dbh->caricaScali($scali, $codiceVolo);
    }
}

?>