<section>
    <h2>Personale</h2>
    <table id="personale">
        <tr>
            <th>Codice</th>
            <th>Ruolo</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Data di Nascita</th>
            <th>Codice Fiscale</th>
            <th>Telefono</th>
            <th>Data Assunzione</th>
            <th>Stato</th>
            <th>Ore Accumulate</th>
            <th>Ore di Volo</th>
            <th>Voli Effettuati</th>
        </tr>
        <?php foreach($templateParams["personale"] as $membro): ?>
            <tr>
                <td><?php echo($membro["codicePersonale"]); ?></td>
                <td><?php echo($membro["ruolo"]); ?></td>
                <td><?php echo($membro["nome"]); ?></td>
                <td><?php echo($membro["cognome"]); ?></td>
                <td><?php echo($membro["dataNascita"]); ?></td>
                <td><?php echo($membro["codiceFiscale"]); ?></td>
                <td><?php echo($membro["telefono"]); ?></td>
                <td><?php echo($membro["dataAssunzione"]); ?></td>
                <td><?php echo($membro["stato"]); ?></td>
                <td><?php echo($membro["oreAccumulate"]); ?></td>
                <td><?php echo($membro["oreDiVolo"]); ?></td>
                <td><a class="voli_membro" href="?id=<?php echo($membro["codicePersonale"]);?>#voli_di_X">Voli</a></td>
            </tr>
        <?php endforeach;?>
    </table>
    <div <?php if(isset($templateParams["voliMembro"])){echo "";} else echo "hidden"; ?>>
    <h2>Voli di <?php echo($_GET["id"]); ?></h2>
    <table id="voli_di_X">
        <tr>
            <th>Volo</th>
            <th>Durata</th>
            <th>Data</th>
            <th>Ora</th>
            <th>Velivolo</th>
            <th>Origine</th>
            <th>Destinazione</th>
        </tr>
        <?php if(isset($templateParams["voliMembro"])) : foreach($templateParams["voliMembro"] as $voli): ?>
            <tr>
                <td><?php echo($voli["codiceVolo"]); ?></td>
                <td><?php echo($voli["durata"]); ?></td>
                <td><?php echo($voli["data"]); ?></td>
                <td><?php echo($voli["ora"]); ?></td>
                <td><?php echo($voli["idVelivolo"]); ?></td>
                <td><?php echo($voli["codiceAeroportoOrigine"]); ?></td>
                <td><?php echo($voli["codiceAeroportoDest"]); ?></td>
            </tr>
        <?php endforeach; endif;?>
    </table>
    </div>
</section>