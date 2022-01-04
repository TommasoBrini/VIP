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
            $stmt = $this -> db -> prepare("SELECT p. IDProdotto, a.IdAsta, p.Nome, a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio, a.AnnoFine, a.MeseFine, a.GiornoFine, a.OraFine, a.CodVincitore, p.Descrizione, p.DescrizioneBreve, p.Base_asta, p.Prezzo, p.Immagine FROM asta a JOIN prodotto p ON a.CodProdotto = p.IDProdotto ORDER BY a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio ASC");
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
                $query="SELECT p. IDProdotto, p.Nome, a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio, a.AnnoFine, a.MeseFine, a.GiornoFine, a.OraFine, a.CodVincitore, p.Descrizione, p.DescrizioneBreve, p.Base_asta, p.Prezzo, p.Immagine FROM asta a JOIN prodotto p ON a.CodProdotto = p.IDProdotto WHERE p.IDProdotto=?";
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
            $query = "INSERT INTO asta (`CodProdotto`, `AnnoInizio`, `MeseInizio`, `GiornoInizio`, `OraInizio`, `AnnoFine`, `MeseFine`, `GiornoFine`, `OraFine`, `CodVincitore`) VALUES (?, ?, ?, ?, ? , ?, ?, ?, ?, NULL)";
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

        public function updateProduct($idProdotto, $nome, $descrizione, $descrizioneBreve, $prezzo, $disponibilità, $base, $oraInizio, $annoInizio, $meseInizio, $giornoInizio, $oraFine, $annoFine, $meseFine, $giornofine, $immagine, $check){
            if($check!=0){
                $query = "UPDATE asta SET AnnoInizio = ?, MeseInizio = ?, GiornoInizio = ?, OraInizio = ?, AnnoFine = ?, MeseFine = ?, GiornoFine = ?, OraFine = ? WHERE codProdotto=".$idProdotto;
                $stmt = $this->db->prepare($query);
                $annoI = intval($annoInizio);
                $meseI = intval($meseInizio);
                $giornoI = intval($giornoInizio);
                $annoF = intval($annoFine);
                $meseF = intval($meseFine);
                $giornoF = intval($giornofine);
                $stmt->bind_param('iiisiiis', $annoI, $meseI,$giornoI, $oraInizio, $annoF, $meseF,$giornoF, $oraFine);
                $stmt->execute();
                
                $query = "UPDATE prodotto SET Nome=?, Descrizione=?, DescrizioneBreve=?, Prezzo=?, Base_Asta=?, Immagine=? WHERE idProdotto=".$idProdotto;
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('sssiis',$nome, $descrizione, $descrizioneBreve, $prezzo, $base, $immagine);
                $stmt->execute();
            } else{
                $query = "UPDATE prodotto SET Nome=?, Descrizione=?, DescrizioneBreve=?, Prezzo=?, Disponibilita=?, Immagine=? WHERE idProdotto=".$idProdotto;
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('sssiis',$nome, $descrizione,     $descrizioneBreve, $prezzo, $disponibilità, $immagine);
                $stmt->execute();
            }
            
            return $stmt->insert_id;
        }

        public function deleteProduct($idProdotto, $isAsta){
            if($isAsta>0){
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
        
        public function checkLogin($email, $password){
            $query = "SELECT * FROM `user` WHERE email=? AND password=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss',$email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }
     
        public function checkSeller(){
            $query = "SELECT * FROM user WHERE idvenditore=1 LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            foreach($result as $user){
                if(isset($_SESSION['email'])){
                    return $user['email'] == $_SESSION['email'];
                } else {
                    return false;
                }
            }
        
        }
    }    
?>