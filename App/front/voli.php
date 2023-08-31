<section id="voli">
    <div>
        <h2>Voli</h2>
        <table>
            <tr>
                <th>Volo</th>
                <th>Durata</th>
                <th>Data</th>
                <th>Ora</th>
                <th>Velivolo</th>
                <th>Origine</th>
                <th>Destinazione</th>
                <th>Personale</th>
                <th>Passeggeri</th>
            </tr>
            <?php foreach ($templateParams["voli"] as $volo): ?>
                <tr>
                    <td>
                        <?php echo ($volo["codiceVolo"]); ?>
                    </td>
                    <td>
                        <?php echo ($volo["durata"]); ?>
                    </td>
                    <td>
                        <?php echo ($volo["data"]); ?>
                    </td>
                    <td>
                        <?php echo ($volo["ora"]); ?>
                    </td>
                    <td>
                        <?php echo ($volo["idVelivolo"]); ?>
                    </td>
                    <td>
                        <?php echo ($volo["codiceAeroportoOrigine"]); ?>
                    </td>
                    <td>
                        <?php echo ($volo["codiceAeroportoDest"]); ?>
                    </td>
                    <td><a href="?idVolo=<?php echo ($volo["codiceVolo"]); ?>&t=2#personale_di_volo">Personale</a></td>
                    <td><a href="?idVolo=<?php echo ($volo["codiceVolo"]); ?>&t=1#passeggeri">Passeggeri</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div <?php if(isset($_GET["idVolo"]) && isset($_GET["t"]) && $_GET["t"] == "2") {echo("");} else {echo("hidden");} ?>>
        <h2>Personale del volo <?php if(isset($_GET["idVolo"])) echo($_GET["idVolo"]); ?></h2>
        <table id="personale_di_volo">
                <tr>
                    <th>Codice Personale</th>
                    <th>Ruolo</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                </tr>
                <?php foreach($templateParams["personaleDiVolo"] as $membro): ?>
                    <tr>
                        <td><?php echo($membro["codicePersonale"]); ?></td>
                        <td><?php echo($membro["ruolo"]); ?></td>
                        <td><?php echo($membro["nome"]); ?></td>
                        <td><?php echo($membro["cognome"]); ?></td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
    <div <?php if(isset($_GET["idVolo"]) && isset($_GET["t"]) && $_GET["t"] == "1") {echo("");} else {echo("hidden");} ?>>
        <h2>Passeggeri del volo <?php if(isset($_GET["idVolo"])) echo($_GET["idVolo"]); ?></h2>
        <table id="passeggeri">
            <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Codice Fiscale</th>
                <th>Telefono</th>
            </tr>
            <?php foreach($templateParams["passeggeriVolo"] as $passeggero):?>
                <tr>
                    <td><?php echo($passeggero["nome"]);?></td>
                    <td><?php echo($passeggero["cognome"]);?></td>
                    <td><?php echo($passeggero["codiceFiscale"]);?></td>
                    <td><?php echo($passeggero["telefono"]);?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</section>