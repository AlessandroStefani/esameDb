<section>
    <h2>Voli Disponibili</h2>
    <table>
        <tr>
            <th>Volo</th>
            <th>Durata</th>
            <th>Partenza</th>
            <th>Origine</th>
            <th>Destinazione</th>
            <th>Scali</th>
            <th>Prezzo</th>
            <th>Acquista</th>
        </tr>
        <?php foreach($templateParams["voliProgrammati"] as $volo):?>
            <tr>
                <td><?php echo($volo["codiceVolo"]); ?></td>
                <td><?php echo($volo["durata"]); ?></td>
                <td><?php echo($volo["data"]);?> <?php echo($volo["ora"]);?></td>
                <td><?php echo($volo["codiceAeroportoOrigine"]); ?></td>
                <td><?php echo($volo["codiceAeroportoDest"]); ?></td>
                <td><?php 
                    if($volo["scali"]) {
                        foreach ($volo["scali"] as $scalo) {
                        echo($scalo["codiceAeroporto"]);
                        echo('<br>');
                        }
                    } else {
                        echo("Diretto");
                    }                     
                ?></td>
                <td><?php echo($volo["prezzo"])?>€</td>
                <td><a href="?idVolo=<?php echo($volo["codiceVolo"]);?>&c=<?php echo($volo["prezzo"])?>#inserimento">Acquista</a></td>
            </tr>
        <?php endforeach;?>
    </table>
    <div id="inserimento" <?php if(isset($_GET["idVolo"])) echo(""); else echo("hidden");?>>
    <h2>Acquisto</h2>
        <form action="biglietti.php" method="post">
            <input type="text" name="prezzo" id="prezzo" value="<?php echo($_GET["c"]); ?>" hidden>
            <input type="text" name="volo" id="volo" value="<?php echo($_GET["idVolo"]); ?>" hidden>


            <label for="nome">Nome:</label><br>
            <input type="text" name="nome" id="nome" required><br>
            
            <label for="cognome">Cognome:</label><br>
            <input type="text" name="cognome" id="cognome" required><br>

            <label for="dataNascita">Data di Nascita:</label><br>
            <input type="date" name="dataNascita" id="dataNascita" required><br>
            
            <label for="codiceFiscale">Codice Fiscale:</label><br>
            <input type="text" name="codiceFiscale" id="codiceFiscale" required><br>

            <label for="telefono">Telefono:</label><br>
            <input type="tel" name="telefono" id="telefono" required><br>

            <input type="submit" value="Conferma">
            <input type="reset" value="Annulla">
        </form>
    </div>
</section>