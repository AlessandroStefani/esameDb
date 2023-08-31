<?php
require_once "bt.php";

//Base Template
$templateParams["titolo"] = "Biglietti";
$templateParams["nome"] = "biglietti.php";

$templateParams["voliProgrammati"] = $dbh->getVoliProgrammati();

$len = count($templateParams["voliProgrammati"]);
for ($i=0; $i < $len; $i++) { 
    $codOrig = $templateParams["voliProgrammati"][$i]["codiceAeroportoOrigine"];
    $templateParams["voliProgrammati"][$i]["codiceAeroportoOrigine"] = $dbh->getNomeAeroporto($codOrig);

    $codDest =  $templateParams["voliProgrammati"][$i]["codiceAeroportoDest"];
    $templateParams["voliProgrammati"][$i]["codiceAeroportoDest"] = $dbh->getNomeAeroporto($codDest);

    $codVolo = $templateParams["voliProgrammati"][$i]["codiceVolo"];
    $scali = $dbh->getScaliVolo($codVolo);

    $sc = count($scali);
    for ($j=0; $j < $sc; $j++) { 
        $scali[$j]["codiceAeroporto"] = $dbh->getNomeAeroporto($scali[$j]["codiceAeroporto"]);
    }
    $templateParams["voliProgrammati"][$i] += ["scali"=>$scali];

    $ore = explode(":",$templateParams["voliProgrammati"][$i]["durata"])[0];
    $minuti = explode(":",$templateParams["voliProgrammati"][$i]["durata"])[1];
    $prezzo = round(($ore + $minuti/60)*50, 2);
    $templateParams["voliProgrammati"][$i] += ["prezzo"=>$prezzo];
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $prezzo = $_POST["prezzo"];
    $volo = $_POST["volo"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $dataNascita = $_POST["dataNascita"];
    $cf = $_POST["codiceFiscale"];
    $tel = $_POST["telefono"];

    $dbh->inserisciCliente($nome, $cognome, $dataNascita, $cf, $tel);
    $dbh->inserisciBiglietto($volo, $cf, $prezzo);
}

require "front/home.php";
?>