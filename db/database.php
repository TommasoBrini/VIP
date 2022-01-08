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
            $query = "SELECT a.IDProdotto, a.IdAsta, a.Nome, a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio, a.AnnoFine, a.MeseFine, a.GiornoFine, a.OraFine, a.CodVincitore, a.Descrizione, a.DescrizioneBreve, a.Base_asta, a.Prezzo, a.Immagine, b.CodCliente, b.quantita FROM (SELECT p. IDProdotto, a.IdAsta, p.Nome, a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio, a.AnnoFine, a.MeseFine, a.GiornoFine, a.OraFine, a.CodVincitore, p.Descrizione, p.DescrizioneBreve, p.Base_asta, p.Prezzo, p.Immagine FROM asta a JOIN prodotto p ON a.CodProdotto = p.IDProdotto ) AS a LEFT JOIN (SELECT CodCliente, IdAsta, quantita FROM puntata ORDER BY quantita DESC LIMIT 1) AS b ON a.IdAsta=b.IdAsta ORDER BY a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio ASC";
            $stmt = $this -> db -> prepare($query);
            $stmt -> execute();
            $result = $stmt -> get_result();
            
            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        public function getAuctionPrice($auctionId){
            $stmt = $this -> db -> prepare("SELECT a.IdAsta, a.Base_asta, b.CodCliente, b.quantita FROM (SELECT a.IdAsta, p.Base_asta FROM asta a JOIN prodotto p ON a.CodProdotto = p.IDProdotto ) AS a LEFT JOIN (SELECT CodCliente, IdAsta, quantita FROM puntata ORDER BY quantita DESC LIMIT 1) AS b ON a.IdAsta=b.IdAsta WHERE a.IdAsta = ".$auctionId) ;
            $stmt -> execute();
            $result = $stmt -> get_result() -> fetch_All(MYSQLI_ASSOC);
            foreach($result as $res){
                if($res["quantita"] == NULL){
                    return $res["Base_asta"];
                } else {
                    return $res["quantita"];
                }
            }
        }

        public function getAuctionWinner($auctionId){
            $stmt = $this -> db -> prepare("SELECT * FROM asta WHERE IdAsta = ".$auctionId) ;
            $stmt -> execute();
            $result = $stmt -> get_result() -> fetch_All(MYSQLI_ASSOC);
            foreach($result as $res){
                return $res['CodVincitore']==NULL ? "" : $res['CodVincitore'];
            }
        }

        public function setWinner($auctionId){
            $query = "SELECT * FROM puntata WHERE IdAsta=".$auctionId." ORDER BY quantita DESC LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt -> get_result() -> fetch_All(MYSQLI_ASSOC);
            $vincitore = NULL;
            foreach($result as $res){
                $vincitore = $res['CodCliente'];
            }
            if($vincitore != NULL){
                $query = "UPDATE asta SET CodVincitore='".$vincitore."' WHERE IdAsta=".$auctionId;
                $stmt = $this->db->prepare($query);
                $stmt->execute();
            }
            return $vincitore;
        }

        public function getProducts(){
            $stmt = $this -> db -> prepare("SELECT p.IDProdotto, p.Nome, p.Descrizione, p.DescrizioneBreve, p.Prezzo, p.Immagine, p.Disponibilita FROM prodotto p WHERE p.Base_asta IS NULL ORDER BY p.Disponibilita DESC");
            $stmt -> execute();
            $result = $stmt -> get_result();
            
            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        public function checkProduct($id){
            $stmt = $this -> db -> prepare("SELECT CodProdotto FROM asta WHERE CodProdotto=?");
            $stmt -> bind_param('i', $id);
            $stmt -> execute();
            $result = $stmt -> get_result();
            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        public function getProductById($id, $check){
            if($check==0){
                $query="SELECT IDProdotto, Nome, Descrizione, DescrizioneBreve, Prezzo, Immagine, Base_asta, Disponibilita FROM prodotto WHERE IDProdotto=?";
            } else {
                $query="SELECT p.IDProdotto, p.Nome, a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio, a.AnnoFine, a.MeseFine, a.GiornoFine, a.OraFine, a.CodVincitore, p.Descrizione, p.DescrizioneBreve, p.Base_asta, p.Prezzo, p.Immagine FROM asta a JOIN prodotto p ON a.CodProdotto = p.IDProdotto WHERE p.IDProdotto=?";
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

        public function getBuyNowPrice($auctionId){
            $stmt = $this -> db -> prepare("SELECT a.IdAsta, a.CodProdotto, p.Prezzo FROM asta AS a JOIN prodotto AS p ON a.CodProdotto=p.IDProdotto WHERE a.IdAsta=".$auctionId) ;
            $stmt -> execute();
            $result = $stmt -> get_result() -> fetch_All(MYSQLI_ASSOC);
            foreach($result as $res){
                return $res['Prezzo'];
            }
        }

        public function buyNow($auctionId, $user){
            $price = $this->getBuyNowPrice($auctionId);
            $this->raise($auctionId, $price , $user);
            $this->setWinner($auctionId);

        }

        public function raise($auctionid, $bet, $user){
            $query = "SELECT * FROM puntata WHERE IdPuntata=? ORDER BY quantita DESC LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i',$auctionid);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $oldBid = true;
            foreach($result as $last){
                $oldBid = false;
                if($last['quantita'] < $bet){
                    $oldBid = true;
                }
            }        
            if($oldBid){
                $query = "INSERT INTO puntata (quantita, IdAsta, CodCliente) VALUES ( ".$bet.", ".$auctionid.", '".$user."')";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
                return true;
            } else {
                return false;
            }
        }

        public function getRows(){
            $query = "SELECT * FROM riga R, ordine O WHERE O.IdOrdine = R.CodOrdine AND O.CodCliente=? AND O.Pagato=0";
            $stmt = $this -> db -> prepare($query);
            $stmt->bind_param('s',$SESSION_EMAIL);
            $stmt -> execute();
            $result = $stmt -> get_result();
            
            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        public function getPhoto($idProdotto){
            $query = "SELECT P.Immagine FROM prodotto P WHERE P.IDProdotto = ?";
            $stmt = $this -> db -> prepare($query);
            $stmt->bind_param('i',$idProdotto);
            $stmt -> execute();
            $result = $stmt -> get_result();
            
            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        public function getName($idProdotto){
            $query = "SELECT P.Nome FROM prodotto P WHERE P.IDProdotto = ?";
            $stmt = $this -> db -> prepare($query);
            $stmt->bind_param('i',$idProdotto);
            $stmt -> execute();
            $result = $stmt -> get_result();
            
            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        public function getUnitPrice($idProdotto){
            $query = "SELECT P.Prezzo FROM prodotto P WHERE P.IDProdotto = ?";
            $stmt = $this -> db -> prepare($query);
            $stmt->bind_param('i',$idProdotto);
            $stmt -> execute();
            $result = $stmt -> get_result();
            
            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        public function getQuantity($idProdotto){
            $query = "SELECT P.Prezzo FROM prodotto P WHERE P.IDProdotto = ?";
            $stmt = $this -> db -> prepare($query);
            $stmt->bind_param('i',$idProdotto);
            $stmt -> execute();
            $result = $stmt -> get_result();
            
            return $result -> fetch_All(MYSQLI_ASSOC);
        }
    }    
?>