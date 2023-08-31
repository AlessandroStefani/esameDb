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
        <?php foreach($templateParams["volo"] as $terra): ?>
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
        <?php foreach($templateParams["coda"] as $terra): ?>
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
        <?php foreach($templateParams["controllo"] as $terra): ?>
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
</section>