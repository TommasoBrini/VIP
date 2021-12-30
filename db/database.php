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
            $stmt = $this -> db -> prepare("SELECT p. IDProdotto, a.IdAsta, p.Nome, a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio, a.AnnoFine, a.MeseFine, a.GiornoFine, a.OraFine, a.Stato, a.CodVincitore, p.Descrizione, p.DescrizioneBreve, p.Base_asta, p.Prezzo, p.Immagine FROM asta a JOIN prodotto p ON a.CodProdotto = p.IDProdotto ORDER BY a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio ASC");
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

        public function checkProduct($id){
            $query="";
            $stmt = $this -> db -> prepare("SELECT CodProdotto FROM asta WHERE CodProdotto=?");
            $stmt -> bind_param('i', $id);
            $stmt -> execute();
            $result = $stmt -> get_result();
            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        public function getProductById($id, $check){
            if($check==0){
                $query="SELECT Nome, Descrizione, DescrizioneBreve, Prezzo, Immagine, Base_asta, Disponibilita FROM prodotto WHERE IDProdotto=?";
            } else {
                $query="SELECT p. IDProdotto, p.Nome, a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio, a.AnnoFine, a.MeseFine, a.GiornoFine, a.OraFine, a.Stato, a.CodVincitore, p.Descrizione, p.DescrizioneBreve, p.Base_asta, p.Prezzo, p.Immagine FROM asta a JOIN prodotto p ON a.CodProdotto = p.IDProdotto WHERE p.IDProdotto=?";
            }
            
            $stmt = $this -> db -> prepare($query);
            $stmt -> bind_param('i', $id);
            $stmt -> execute();
            $result1 = $stmt -> get_result();

            return $result1 -> fetch_All(MYSQLI_ASSOC);
        }

        function getAviableProducts(){
            $query = "SELECT IDProdotto, Disponibilita FROM prodotto WHERE Disponibilita IS NOT NULL AND Disponibilita > 0";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt -> get_result();

            return $result -> fetch_All(MYSQLI_ASSOC);
        }
        
        public function insertProduct($nome, $descrizione, $descrizioneBreve, $prezzo, $disponibilità, $immagine){
            $query = "INSERT INTO prodotto (Nome, Descrizione, DescrizioneBreve, Prezzo, Disponibilita, Immagine) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssiis',$nome, $descrizione, $descrizioneBreve, $prezzo, $disponibilità, $immagine);
            $stmt->execute();    
            return $stmt->insert_id;
        }

        public function insertAuction($nome, $descrizione, $descrizioneBreve, $prezzo, $base, $oraInizio, $annoInizio, $meseInizio, $giornoInizio, $oraFine, $annoFine, $meseFine, $giornofine, $immagine){
	        $query="";
            $query = "INSERT INTO prodotto (Nome, Descrizione, DescrizioneBreve, Prezzo, Base_asta, Immagine) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssiis',$nome, $descrizione, $descrizioneBreve, $prezzo, $base, $immagine);
            $stmt->execute();
            $id = $stmt->insert_id;
            $query="";
            $query = "INSERT INTO asta (`CodProdotto`, `Stato`, `AnnoInizio`, `MeseInizio`, `GiornoInizio`, `OraInizio`, `AnnoFine`, `MeseFine`, `GiornoFine`, `OraFine`, `CodVincitore`) VALUES (?, 'BEFORE', ?, ?, ?, ? , ?, ?, ?, ?, NULL)";
            $stmt = $this->db->prepare($query);
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

        public function deleteProduct($idProdotto, $isAsta){
            if($isAsta==1){
                $query="DELETE FROM asta WHERE asta.CodProdotto=?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('i',$idProdotto);
                $stmt->execute();
            }
            
            $query="DELETE FROM prodotto WHERE prodotto.IDProdotto=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i',$idProdotto);
            $stmt->execute();
            return true;
        }
        

        public function updateAuctionState($auctionId, $newState) {
            $query = "UPDATE `asta` SET `Stato` = '".$newState."' WHERE `asta`.`IdAsta` = ".$auctionId;
            $stmt = $this->db->prepare($query);
            $stmt->execute();
        }
        public function checkLogin($email, $password, $idvenditore){
            $query = "SELECT U.email, U.password, U.idvenditore FROM user U WHERE U.email = ? AND U.password = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss',$email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }    
    }    
?>