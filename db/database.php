<?php
    class DatabaseHelper{
        private $db;

        public function __construct($servername, $username, $password, $dbname, $port){
            $this->db = new mysqli($servername, $username, $password, $dbname, $port);
            if ($this->db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }        
        }

        public function getAuctions(){
            $stmt = $this -> db -> prepare("SELECT p. IDProdotto, p.Nome, a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio, a.AnnoFine, a.MeseFine, a.GiornoFine, a.OraFine, a.Stato, a.CodVincitore, p.Descrizione, p.DescrizioneBreve, p.Base_asta, p.Prezzo, p.Immagine FROM asta a JOIN prodotto p ON a.CodProdotto = p.IDProdotto ORDER BY a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio ASC");
            $stmt -> execute();
            $result = $stmt -> get_result();
            
            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        public function getProducts(){
            $stmt = $this -> db -> prepare("SELECT p. IDProdotto, p.Nome, p.Descrizione, p.DescrizioneBreve, p.Prezzo, p.Immagine, p.Disponibilita FROM prodotto p WHERE p.Base_asta IS NULL ORDER BY p.Disponibilita DESC");
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

        public function insertProduct($nome, $descrizione, $descrizioneBreve, $prezzo, $disponibilità){
            $query = "INSERT INTO prodotto (Nome, Descrizione, DescrizioneBreve, Prezzo, Disponibilita) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssii',$nome, $descrizione, $descrizioneBreve, $prezzo, $disponibilità);
            $stmt->execute();    
            return $stmt->insert_id;
        }

        function getAviableProducts(){
            $query = "SELECT IDProdotto, Disponibilita FROM prodotto WHERE Disponibilita IS NOT NULL AND Disponibilita > 0";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt -> get_result();

            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        /*public function insertAuction($nome, $descrizione, $descrizioneBreve, $prezzo, $base, $data, $oraInizio){
            $query="";
            $query = "INSERT INTO prodotto (Nome, Descrizione, DescrizioneBreve, Prezzo, Base_asta, Immagine) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssiis',$nome, $descrizione, $descrizioneBreve, $prezzo, $base, $immagine);
            $stmt->execute();
            $id = $stmt->insert_id;
            
            $query="";
            $query = "INSERT INTO asta a(a.Data, a.CodProdotto, a.Stato, a.OraInizio, a.OraFine, a.DataFine) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stato = "INIZIATA";
            $stmt->bind_param('sissss',$data, $id, $stato, $oraInizio, $oraInizio, $data);
            $stmt->execute();
            return $stmt->insert_id;
        }*/
    }    
?>