<?php
    class DatabaseHelper{
        private $db;

        public function __construct($servername, $username, $password, $dbname, $port){
            $this->db = new mysqli($servername, $username, $password, $dbname, $port);
            if ($this->db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }        
        }

        /*public function getAuctions(){
            $stmt = $this -> db -> prepare("SELECT p.Nome, a.Data, a.OraInizio, a.DataFine, a.OraFine, a.Stato, p.Descrizione, p.DescrizioneBreve, p.Base_asta, p.Prezzo, p.Immagine FROM asta a JOIN prodotto p ON a.CodProdotto = p.IDProdotto ORDER BY a.Data, a.OraInizio ASC");
            $stmt -> execute();
            $result = $stmt -> get_result();
            
            return $result -> fetch_All(MYSQLI_ASSOC);
        }*/

        public function getProducts(){
            $stmt = $this -> db -> prepare("SELECT p.Nome, p.Descrizione, p.DescrizioneBreve, p.Prezzo, p.Immagine, p.Disponibilita FROM prodotto p WHERE p.Base_asta IS NULL ORDER BY p.Disponibilita DESC");
            $stmt -> execute();
            $result = $stmt -> get_result();
            
            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        public function getProductById($id){
            $query="";
            $stmt = $this -> db -> prepare("SELECT Disponibilita FROM prodotto WHERE IDProdotto=?");
            $stmt -> bind_param('i', $id);
            $stmt -> execute();
            $result = $stmt -> get_result();
            
            if(isset($result)){
                $query="SELECT Nome, Descrizione, DescrizioneBreve, Prezzo, Immagine, Base_asta, Disponibilita FROM prodotto WHERE IDProdotto=?";
            }
            
            $stmt = $this -> db -> prepare($query);
            $stmt -> bind_param('i', $id);
            $stmt -> execute();
            $result1 = $stmt -> get_result();

            return $result1 -> fetch_All(MYSQLI_ASSOC);
        }

        public function insertProduct($nome, $descrizione, $descrizioneBreve, $prezzo, $disponibilità, $immagine){
            $query = "INSERT INTO prodotto (Nome, Descrizione, DescrizioneBreve, Prezzo, Disponibilita, Immagine) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssiis',$nome, $descrizione, $descrizioneBreve, $prezzo, $disponibilità, $immagine);
            $stmt->execute();    
            return $stmt->insert_id;
        }

        public function insertAuction($nome, $descrizione, $descrizioneBreve, $prezzo, $base, $oraInizio, $annoInizio, $meseInizio, $giornoInizio, $oraFine, $annoFine, $meseFine, $giornofine){
            $query="";
            $query = "INSERT INTO prodotto (Nome, Descrizione, DescrizioneBreve, Prezzo, Base_asta) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssii',$nome, $descrizione, $descrizioneBreve, $prezzo, $base);
            $stmt->execute();
            $id = $stmt->insert_id;
            
            $query="";
            $query = "INSERT INTO asta (`CodProdotto`, `Stato`, `AnnoInizio`, `MeseInizio`, `GiornoInizio`, `OraInizio`, `AnnoFine`, `MeseFine`, `GiornoFine`, `OraFine`, `CodVincitore`) VALUES (?, 'INIZIATA', ?, ?, ?, ? , ?, ?, ?, ?, NULL)";
            $stmt = $this->db->prepare($query);
            $stato = "INIZIATA";
            $annoI = intval($annoInizio);
            $meseI = intval($meseInizio);
            $giornoI = intval($giornoInizio);
            $annoF = intval($annoFine);
            $meseF = intval($meseFine);
            $giornoF = intval($giornofine);
            $stmt->bind_param('iiiisiiis', $id, $annoI, $meseI,$giornoI, $oraInizio, $annoF, $meseF,$giornoF, $oraFine);
            $stmt->execute();
            return $stmt->insert_id;
        }
    }    
?>