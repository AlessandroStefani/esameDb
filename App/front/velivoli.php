<section>
    <h2>Stato Velivoli</h2>
    <table class="velivoli">
        <tr>
            <th>Identificatore</th>
            <th>Modello</th>
            <th>Posti</th>
            <th>Ore di volo</th>
            <th>Età (anni)</th>
            <th>Data Acquisizione</th>
            <th>Stato</th>
        </tr>
        <?php foreach($templateParams["terra"] as $terra): ?>
                <tr>
                    <td><?php echo $terra["idVelivolo"]; ?></td>
                    <td><?php echo $terra["modello"]; ?></td>
                    <td><?php echo $terra["posti"]; ?></td>
                    <td><?php echo $terra["oreDiVolo"]; ?></td>
                    <td><?php echo $terra["eta"]; ?></td>
                    <td><?php echo $terra["dataAcquisizione"]; ?></td>
                    <td><?php echo $terra["stato"]; ?></td>
                </tr>
        <?php endforeach; ?>
    </table>
    <table class="velivoli">
        <tr>
            <th>Identificatore</th>
            <th>Modello</th>
            <th>Posti</th>
            <th>Ore di volo</th>
            <th>Età (anni)</th>
            <th>Data Acquisizione</th>
            <th>Stato</th>
        </tr>
        <?php foreach($templateParams["volo"] as $volo): ?>
                <tr>
                    <td><?php echo $volo["idVelivolo"]; ?></td>
                    <td><?php echo $volo["modello"]; ?></td>
                    <td><?php echo $volo["posti"]; ?></td>
                    <td><?php echo $volo["oreDiVolo"]; ?></td>
                    <td><?php echo $volo["eta"]; ?></td>
                    <td><?php echo $volo["dataAcquisizione"]; ?></td>
                    <td><?php echo $volo["stato"]; ?></td>
                </tr>
        <?php endforeach; ?>
    </table>
    <table class="velivoli">
        <tr>
            <th>Identificatore</th>
            <th>Modello</th>
            <th>Posti</th>
            <th>Ore di volo</th>
            <th>Età (anni)</th>
            <th>Data Acquisizione</th>
            <th>Stato</th>
            <th>Controlli</th>
            <th>Nuovo Controllo</th>
        </tr>
        <?php foreach($templateParams["coda"] as $coda): ?>
                <tr>
                    <td><?php echo $coda["idVelivolo"]; ?></td>
                    <td><?php echo $coda["modello"]; ?></td>
                    <td><?php echo $coda["posti"]; ?></td>
                    <td><?php echo $coda["oreDiVolo"]; ?></td>
                    <td><?php echo $coda["eta"]; ?></td>
                    <td><?php echo $coda["dataAcquisizione"]; ?></td>
                    <td><?php echo $coda["stato"]; ?></td>
                    <td><a href="?id=<?php echo($coda["idVelivolo"])?>#controlli">Controlli</a></td>
                    <td><a href="?idV=<?php echo($coda["idVelivolo"])?>#organizza">Organizza</a></td>
                </tr>
        <?php endforeach; ?>
    </table>
    <table class="velivoli">
        <tr>
            <th>Identificatore</th>
            <th>Modello</th>
            <th>Posti</th>
            <th>Ore di volo</th>
            <th>Età (anni)</th>
            <th>Data Acquisizione</th>
            <th>Stato</th>
            <th>Controllo</th>
        </tr>
        <?php foreach($templateParams["controllo"] as $controllo): ?>
                <tr>
                    <td><?php echo $controllo["idVelivolo"]; ?></td>
                    <td><?php echo $controllo["modello"]; ?></td>
                    <td><?php echo $controllo["posti"]; ?></td>
                    <td><?php echo $controllo["oreDiVolo"]; ?></td>
                    <td><?php echo $controllo["eta"]; ?></td>
                    <td><?php echo $controllo["dataAcquisizione"]; ?></td>
                    <td><?php echo $controllo["stato"]; ?></td>
                    <td><a href="?infoC=<?php echo($controllo["idVelivolo"])?>#info">Info</a></td>
                </tr>
        <?php endforeach; ?>
    </table>
    <div id="controlli" <?php  if(isset($_GET["id"]) || isset($_GET["idV"])){echo "";} else {echo"hidden";}?>>
        <h2>Controlli del Velivolo</h2>
        <table>
            <tr>
                <th>Velivolo</th>
                <th>Controllo</th>
                <th>Specifiche</th>
                <th>Inizio</th>
                <th>Fine</th>
                <th>Note</th>
            </tr>
            <?php foreach ($templateParams["controlliVelivolo"] as $controllo):?>
                <tr>
                    <td><?php echo($controllo["idVelivolo"]);?></td>
                    <td><?php echo($controllo["codiceControllo"]);?></td>
                    <td><?php echo($controllo["specifiche"]);?></td>
                    <td><?php echo($controllo["dataInizio"]);?></td>
                    <td><?php echo($controllo["dataFine"]);?></td>
                    <td><?php echo($controllo["note"]);?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
    <div id="organizza" <?php  if(isset($_GET["idV"])){echo "";} else {echo"hidden";}?>>
        <h2>Organizza Controllo</h2>
        <p><?php if(isset($templateParams["err"])) {echo $templateParams["err"];}?></p>
        <form action="" method="post">
                <input type="text" name="idVelivolo" id="idVelivolo" value="<?php echo($_GET['idV']);?>" hidden>

                <label for="idControllo">Codice Controllo</label><br>
                <input type="text" name="idControllo" id="idControllo"><br>
                <label for="specifiche"></label><br>
                <select name="specifiche" id="specifiche">
                    <option value="Tipo A">Tipo A</option>
                    <option value="Tipo C">Tipo C</option>
                    <option data="Tipo D">Tipo D</option>
                </select><br>
                <label for="note">Note:</label><br>
                <textarea name="note" id="note" cols="30" rows="10"></textarea><br>
                <input type="submit" value="Conferma">
                <input type="reset" value="Annulla">
        </form>
    </div>
    <div id="info" <?php  if(isset($_GET["infoC"])){echo "";} else {echo"hidden";}?>>
        <h2>Info Controllo</h2>    
        <table>
            <tr>
                <th>Velivolo</th>
                <th>Controllo</th>
                <th>Specifiche</th>
                <th>Inizio</th>
                <th>Fine</th>
                <th>Note</th>
            </tr>
            <?php foreach ($templateParams["infoControllo"] as $controllo):?>
                <tr>
                    <td><?php echo($controllo["idVelivolo"]);?></td>
                    <td><?php echo($controllo["codiceControllo"]);?></td>
                    <td><?php echo($controllo["specifiche"]);?></td>
                    <td><?php echo($controllo["dataInizio"]);?></td>
                    <td><?php echo($controllo["dataFine"]);?></td>
                    <td><?php echo($controllo["note"]);?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</section>