<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }        
    }

    public function getVelivoli($stato) {
        $stmt = $this->db->prepare("SELECT * FROM velivolo WHERE stato = ?");
        $stmt->bind_param('s',$stato);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAeroporti(){
        $stmt = $this->db->prepare("SELECT * FROM aeroporto");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getVoli(){        
        $stmt = $this->db->prepare("SELECT * FROM volo");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function selezionePiloti($dataOra, $durata){
        $stmt = $this->db->prepare("SELECT *
        FROM personale
        WHERE ruolo = 'pilota'
        AND codicePersonale != ALL (SELECT codicePersonale
        FROM effettua
        WHERE codiceVolo = ANY (SELECT CodiceVolo
        FROM volo
        WHERE TIMESTAMP(?) BETWEEN TIMESTAMP(volo.data, volo.ora) AND DATE_ADD(TIMESTAMP(volo.data, volo.ora), INTERVAL volo.durata + 24 HOUR)
        OR TIMESTAMP(volo.data, volo.ora) BETWEEN TIMESTAMP(?) AND DATE_ADD(TIMESTAMP(?), INTERVAL ? + 24 HOUR)
        ))
        ");        
        $stmt->bind_param('ssss',$dataOra, $dataOra, $dataOra, $durata);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function selezioneAssistenti($dataOra, $durata){
        $stmt = $this->db->prepare("SELECT *
        FROM personale
        WHERE ruolo = 'assistente'
        AND codicePersonale != ALL (SELECT codicePersonale
        FROM effettua
        WHERE codiceVolo = ANY (SELECT CodiceVolo
        FROM volo
        WHERE TIMESTAMP(?) BETWEEN TIMESTAMP(volo.data, volo.ora) AND DATE_ADD(TIMESTAMP(volo.data, volo.ora), INTERVAL volo.durata + 24 HOUR)
        OR TIMESTAMP(volo.data, volo.ora) BETWEEN TIMESTAMP(?) AND DATE_ADD(TIMESTAMP(?), INTERVAL ? + 24 HOUR)
        ))
        ");        
        $stmt->bind_param('ssss',$dataOra, $dataOra, $dataOra, $durata);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function selezioneVelivoli($dataOra, $durata) {
        $data = explode("T",$dataOra)[0];
        $stmt = $this->db->prepare("SELECT idVelivolo, modello, posti
        FROM velivolo
        WHERE idVelivolo != ALL (SELECT idVelivolo
            FROM volo
            WHERE TIMESTAMP(?) BETWEEN TIMESTAMP(data, ora) AND
        DATE_ADD(TIMESTAMP(data, ora), INTERVAL durata + 24 HOUR)
        OR TIMESTAMP(data, ora) BETWEEN TIMESTAMP(?) AND
        DATE_ADD(TIMESTAMP(?), INTERVAL ?+ 24 HOUR)
            )
        AND idVelivolo != ALL (SELECT idVelivolo
        FROM controllo
        WHERE dataFine > ?
        OR DATEDIFF(?, dataFine)%70 = 0
        )        
        ");        
        $stmt->bind_param('ssssss',$dataOra, $dataOra, $dataOra, $durata, $data, $data);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPersonale() {
        $stmt = $this->db->prepare("SELECT * FROM personale");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getVoliMembro($codicePersonale) {
        $stmt = $this->db->prepare("SELECT V.*
        FROM volo V, effettua E
        WHERE E.codicePersonale = ?
        AND E.codiceVolo = V.codiceVolo");
        $stmt->bind_param("s", $codicePersonale);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function creaVolo($infoVolo) {        
        $stmt = $this->db->prepare("INSERT INTO volo (durata, data, ora, idVelivolo, codiceAeroportoOrigine, codiceAeroportoDest) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $infoVolo->durata, $infoVolo->data ,$infoVolo->ora, $infoVolo->idVelivolo, $infoVolo->codiceAeroportoOrigine, $infoVolo->codiceAeroportoDest);
        $stmt->execute();

        return $stmt->insert_id;;
    }

    public function associaPersonale($codiceVolo, $personale) {
        foreach ($personale as $p) {
            $stmt = $this->db->prepare("INSERT INTO effettua (codiceVolo, codicePersonale) VALUES (?,?)");
            $stmt->bind_param("ss", $codiceVolo, $p);
            $stmt->execute();
        }

    }

    public function caricaScali($scali, $codiceVolo) {
        foreach ($scali as $scalo) {
            $stmt = $this->db->prepare("INSERT INTO scalo (codiceAeroporto, codiceVolo) VALUES (?,?)");
            $stmt->bind_param("ss", $scalo, $codiceVolo);
            $stmt->execute();
        }
    }

    public function getPersonaleDiVolo($idVolo) {
        $stmt = $this->db->prepare("SELECT p.codicePersonale, p.ruolo, p.nome, p.cognome
        FROM personale p, effettua e
        WHERE e.codiceVolo = ?
        AND e.codicePersonale = p.codicePersonale");
        $stmt->bind_param("s", $idVolo);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getVoliProgrammati() {
        $stmt = $this->db->prepare("SELECT v.*
        FROM volo v, velivolo vel
        WHERE v.data > CURRENT_DATE()
        AND vel.idVelivolo = v.idVelivolo
        AND vel.posti > (SELECT COUNT(b.codiceBiglietto) FROM biglietto b WHERE b.codiceVolo = v.codiceVolo)");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNomeAeroporto($codiceAeroporto) {
        $stmt = $this->db->prepare("SELECT  nome
        FROM aeroporto
        WHERE codiceAeroporto = ?");
        $stmt->bind_param("s", $codiceAeroporto);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["nome"];
    }

    public function getScaliVolo($idVolo) {
        $stmt = $this->db->prepare("SELECT codiceAeroporto FROM scalo WHERE codiceVolo = ?");
        $stmt->bind_param("s", $idVolo);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function inserisciCliente($nome, $cognome, $dataNascita, $cf, $tel) {
        $stmt = $this->db->prepare("INSERT INTO cliente (nome, cognome, dataNascita, codiceFiscale, telefono) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nome, $cognome, $dataNascita, $cf, $tel);
        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            //Il cliente è già nel database: no problemo
        }
    }

    public function inserisciBiglietto($volo, $cf, $prezzo) {
        $stmt = $this->db->prepare("INSERT INTO biglietto (codiceVolo, codiceFiscale, prezzo) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $volo, $cf, $prezzo);
        $stmt->execute();
    }

    public function getPasseggeriVolo($idVolo) {
        $stmt = $this->db->prepare("SELECT c.* 
        FROM cliente c, biglietto b
        WHERE b.codiceVolo = ?
        AND b.codiceFiscale = c.codiceFiscale");
        $stmt->bind_param("s", $idVolo);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateStatoVelivolo($idVelivolo, $stato){
        $stmt = $this->db->prepare("UPDATE velivolo SET stato = ? WHERE idVelivolo = ?");
        $stmt->bind_param("ss", $stato, $idVelivolo);
        $stmt->execute();
    }

    public function updateStatoPersonale($idVolo, $stato) {
        $stmt = $this->db->prepare("UPDATE personale p, effettua e 
        SET p.stato = ? 
        WHERE e.codiceVolo = ? 
        AND p.codicePersonale = e.codicePersonale");
        $stmt->bind_param("ss", $stato, $idVelivolo);
        $stmt->execute();
    }
}

?>