<!DOCTYPE html>
<head lang="it">
    <meta charset="utf-8">
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<html>
    <body>
        <nav>
        <div class="topnav">
            <a <?php isActive("velivoli.php");?> href="velivoli.php">Velivoli</a>
            <a <?php isActive("voli.php");?> href="voli.php">Voli</a>
            <a  <?php isActive("personale.php");?> href="personale.php">Personale</a>
            <a <?php isActive("nuovo_volo.php");?> href="nuovo_volo.php">Nuovo Volo</a>
            <a <?php isActive("biglietti.php");?> href="biglietti.php">Biglietti</a>
          </div>
        </nav>
        <main>
            <?php
            if(isset($templateParams["nome"])){
                require($templateParams["nome"]);
            }
            ?>
        </main>
    </body>
</html>