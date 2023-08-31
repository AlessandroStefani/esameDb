<section>
    <h2>Programmazione Volo</h2>
    <p id="voloOK"></p>
    <form action="nuovo_volo.php" method="post" <?php if(isset($orig)){echo "hidden";} else echo ""; ?>>
        <label for="origine">Origine:</label>
        <select name="origine" id="origine" required>
            <option value=""></option>
            <?php foreach ($templateParams["aeroporti"] as $aeroporto):?>
                <option value="<?php echo($aeroporto["codiceAeroporto"]); ?>"><?php echo($aeroporto["nome"]); ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="destinazione">Destinazione:</label>
        <select name="destinazione" id="destinazione" required>
            <option value=""></option>
            <?php foreach ($templateParams["aeroporti"] as $aeroporto):?>
                <option value="<?php echo($aeroporto["codiceAeroporto"]); ?>"><?php echo($aeroporto["nome"]); ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="scalo1">Primo Scalo:</label>
        <select name="scalo1" id="scalo1">
            <option value=""></option>
            <?php foreach ($templateParams["aeroporti"] as $aeroporto):?>
                <option value="<?php echo($aeroporto["codiceAeroporto"]); ?>"><?php echo($aeroporto["nome"]); ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="scalo2">Secondo Scalo:</label>
        <select name="scalo2" id="scalo2">
            <option value=""></option>
            <?php foreach ($templateParams["aeroporti"] as $aeroporto):?>
                <option value="<?php echo($aeroporto["codiceAeroporto"]); ?>"><?php echo($aeroporto["nome"]); ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="scalo3">Terzo Scalo:</label>
        <select name="scalo3" id="scalo3">
            <option value=""></option>
            <?php foreach ($templateParams["aeroporti"] as $aeroporto):?>
                <option value="<?php echo($aeroporto["codiceAeroporto"]); ?>"><?php echo($aeroporto["nome"]); ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="data_ora">Partenza:</label>
        <input type="datetime-local" name="data_ora" id="data_ora" min="<?php echo(date('Y-m-d')."T".date('H:i'));?>" required><br>

        <label for="durata">Durata:</label>
        <input type="time" name="durata" id="durata" required><br>

        <input type="reset" value="Annulla">
        <input type="submit" value="Conferma">
    </form>

    <div <?php if(isset($orig)){echo "";} else echo "hidden"; ?>>
        <label for="conf_orig">Origine: </label>
        <p id="conf_orig"><?php echo($orig); ?></p><br>

        <label for="conf_dest">Destinazione: </label>
        <p id="conf_dest"><?php echo($dest); ?></p><br>

        <?php if($sca1 != ""): ?>
            <label for="conf_sca1">Primo Scalo: </label>
            <p id="conf_sca1"><?php echo($sca1); ?></p><br>
        <?php endif; ?>
        <?php if($sca2 != ""): ?>
            <label for="conf_sca2">Secondo Scalo: </label>
            <p id="conf_sca2"><?php echo($sca2); ?></p><br>
        <?php endif; ?>
        <?php if($sca3 != ""): ?>
            <label for="conf_sca3">Terzo Scalo: </label>
            <p id="conf_sca3"><?php echo($sca3); ?></p><br>
        <?php endif; ?>

        <label for="conf_part">Partenza: </label>
        <p id="conf_part"><?php echo($part); ?></p><br>

        <label for="conf_dura">Durata: </label>
        <p id="conf_dura"><?php echo($dura); ?></p><br>
    </div>
    <div id="selezione" <?php if(isset($orig)){echo "";} else echo "hidden"; ?>>
        <h2>Selezione Velivolo e Personale di Volo</h2>
        <table id="aereiOK">
            <tr>
                <th>Identificatore</th>
                <th>Modello</th>
                <th>Posti</th>
            </tr>
            <?php foreach($templateParams["velivoliOK"] as $velivolo):?>
                <tr>
                    <td><?php echo($velivolo["idVelivolo"]); ?></td>
                    <td><?php echo($velivolo["modello"]); ?></td>
                    <td><?php echo($velivolo["posti"]); ?></td>
                </tr>
            <?php endforeach;?>
        </table>
        <table id="pilotiOK">
            <tr>
                <th>Codice</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Ore di Volo</th>
            </tr>
            <?php foreach($templateParams["pilotiOK"] as $pilota): ?>
                <tr>
                    <td><?php echo($pilota["codicePersonale"]); ?></td>
                    <td><?php echo($pilota["nome"]); ?></td>
                    <td><?php echo($pilota["cognome"]); ?></td>
                    <td><?php echo($pilota["oreDiVolo"]); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <table id="assOK">
            <tr>
                <th>Codice</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Entrata in Servizio</th>
            </tr>
            <?php foreach($templateParams["assistentiOK"] as $assistente): ?>
                <tr>
                    <td><?php echo($assistente["codicePersonale"]); ?></td>
                    <td><?php echo($assistente["nome"]); ?></td>
                    <td><?php echo($assistente["cognome"]); ?></td>
                    <td><?php echo($assistente["dataAssunzione"]); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br><button type="button" onclick="window.location.href = window.location.href">Annulla</button>
        <button type="button" onclick=confirm()>Conferma</button>
    </div>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="js/sel_voli.js"></script>
</section>