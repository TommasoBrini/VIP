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
            $query = "SELECT a.IDProdotto, a.IdAsta, a.Nome, a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio, a.AnnoFine, a.MeseFine, a.GiornoFine, a.OraFine, a.CodVincitore, a.Descrizione, a.DescrizioneBreve, a.Base_asta, a.Prezzo, a.Immagine FROM (SELECT p.IDProdotto, a.IdAsta, p.Nome, a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio, a.AnnoFine, a.MeseFine, a.GiornoFine, a.OraFine, a.CodVincitore, p.Descrizione, p.DescrizioneBreve, p.Base_asta, p.Prezzo, p.Immagine FROM asta a JOIN prodotto p ON a.CodProdotto = p.IDProdotto ) AS a ORDER BY a.AnnoInizio, a.MeseInizio, a.GiornoInizio, a.OraInizio ASC";
            $stmt = $this -> db -> prepare($query);
            $stmt -> execute();
            $result = $stmt -> get_result() -> fetch_All(MYSQLI_ASSOC);
            $auctions = $result;
            $cont = 0;
            $tuple = NULL;
            foreach($auctions as $auction){
                $tuple[$cont] = $auction;
                $query = "SELECT IdAsta, CodCliente, quantita FROM puntata WHERE IdAsta = ".$auction['IdAsta']." ORDER BY quantita DESC LIMIT 1";
                $stmt = $this -> db -> prepare($query);
                $stmt -> execute();
                $result = $stmt -> get_result() -> fetch_All(MYSQLI_ASSOC);
                $tuple[$cont]['CodCliente'] = NULL;
                $tuple[$cont]['quantita'] = NULL;
                foreach($result as $res){
                    $tuple[$cont]['IdAsta'] = $res['IdAsta'];
                    $tuple[$cont]['CodCliente'] = $res['CodCliente'];
                    $tuple[$cont]['quantita'] = $res['quantita'];
                }
                $cont++;
            }
            return $tuple;
        }

        public function getAuctionPrice($auctionId){
            $query = "SELECT quantita FROM puntata WHERE IdAsta = ".$auctionId." ORDER BY quantita DESC LIMIT 1";
            $stmt = $this -> db -> prepare($query) ;
            $stmt -> execute();
            $result = $stmt -> get_result() -> fetch_All(MYSQLI_ASSOC);
            foreach($result as $res){
                return $res["quantita"];
            }
            $query = "SELECT p.Base_asta FROM asta a, prodotto p WHERE a.IdAsta = ".$auctionId." AND a.CodProdotto = p.IdProdotto";
            $stmt = $this -> db -> prepare($query) ;
            $stmt -> execute();
            $result = $stmt -> get_result() -> fetch_All(MYSQLI_ASSOC);
            foreach($result as $res){
                return $res["Base_asta"];
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

        function getBidsOfAuction($auctionId){
            $query = "SELECT * FROM puntata p WHERE IdAsta = ".$auctionId." ORDER BY quantita DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt -> get_result() -> fetch_All(MYSQLI_ASSOC);
            return $result;
        }

        function getAuctionFromProduct($productId){
            $query = "SELECT IdAsta FROM asta WHERE CodProdotto = ".$productId;
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt -> get_result() -> fetch_All(MYSQLI_ASSOC);
            foreach($result as $res){
                return $res['IdAsta'];
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
            } else {
                $query = "UPDATE asta SET CodVincitore='".$this->getSeller()."' WHERE IdAsta=".$auctionId;
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

        function getLastOrder($user){
            $query = "SELECT * FROM ordine WHERE CodCliente = '".$user."' AND Pagato = 0";
            $stmt = $this -> db -> prepare($query);
            $stmt -> execute();
            $result = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
            foreach($result as $res){
                if($res['Pagato'] == 0){
                    return $res['IdOrdine'];
                }
            }
            $query = "INSERT INTO ordine (Pagato, CodCliente) VALUES (0, '".$user."')";
            $stmt = $this -> db -> prepare($query);
            $stmt -> execute();
            return $stmt->insert_id;
        }


        function addCart($productId, $quantity, $user){
            $order = $this -> getLastOrder($user);
            $query = "SELECT quantita FROM riga WHERE CodOrdine = ".$order." AND CodProdotto = ".$productId;
            $stmt = $this -> db -> prepare($query);
            $stmt -> execute();
            $result = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
            $oldQ = 0;
            foreach($result as $res){
                $oldQ =$res['quantita'];
            }
            $query = "SELECT IDProdotto, Disponibilita FROM prodotto WHERE IDProdotto = ".$productId;
            $stmt = $this -> db -> prepare($query);
            $stmt -> execute();
            $result = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
            $disp = 0;
            foreach($result as $res){
                if($quantity + $oldQ <= $res['Disponibilita']){
                    $disp = $res['Disponibilita'];
                } else {
                    return false;
                }
            }
            if($disp == 0){
                return false;
            } else {
                if($oldQ > 0){
                    $query = "DELETE FROM riga WHERE CodOrdine = ".$order." AND CodProdotto = ".$productId;
                    $stmt = $this -> db -> prepare($query);
                    $stmt -> execute();
                }
                $query = "INSERT INTO riga (CodOrdine, CodProdotto, Quantita) VALUES (".$order.", ".$productId.", ".$quantity + $oldQ.")";
                $stmt = $this -> db -> prepare($query);
                $stmt -> execute();
                return true;
            }
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

        public function updateProduct($idProdotto, $nome, $descrizione, $descrizioneBreve, $prezzo, $disponibilità, $immagine, $check){
            if($check!=0){
                $query = "UPDATE prodotto SET Nome=?, Descrizione=?, DescrizioneBreve=?, Prezzo=?, Immagine=? WHERE idProdotto=".$idProdotto;
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('sssis',$nome, $descrizione, $descrizioneBreve, $prezzo, $immagine);
                $stmt->execute();
            } else{
                $query = "UPDATE prodotto SET Nome=?, Descrizione=?, DescrizioneBreve=?, Prezzo=?, Disponibilita=?, Immagine=? WHERE idProdotto=".$idProdotto;
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('sssiis',$nome, $descrizione, $descrizioneBreve, $prezzo, $disponibilità, $immagine);
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

        public function getSeller(){
            $query = "SELECT * FROM user WHERE idvenditore=1 LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            foreach($result as $user){
                return $user['email'];
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
            $this->raise($auctionId, 0, $price , $user);
            $this->setWinner($auctionId);

        }

        public function raise($auctionid, $actual, $bet, $user){
            $query = "SELECT * FROM puntata WHERE IdAsta=? ORDER BY quantita DESC LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i',$auctionid);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $oldBid = true;
            foreach($result as $last){
                $oldBid = false;
                if($last['quantita'] < $actual + $bet){
                    $oldBid = true;
                }
            }        
            if($oldBid){
                $query = "INSERT INTO puntata (quantita, IdAsta, CodCliente, Notifica, TimeStamp) VALUES ( ".$actual + $bet.", ".$auctionid.", '".$user."', '".(($actual == 0) ? buyMessage($bet) : raiseMessage($bet))."', '".time()."')";
                echo $query;
                $stmt = $this->db->prepare($query);
                $stmt->execute();
                return true;
            } else {
                return false;
            }
        }

        //Registration and Login

        public function checkSellerExist() {
            $query = "SELECT COUNT(*) as cont FROM user U WHERE U.IdVenditore=1";
            $stmt = $this -> db -> prepare($query);
            $stmt -> execute();
            $result = $stmt -> get_result()->fetch_All(MYSQLI_ASSOC);
            foreach($result as $cont) {
                return $cont['cont'];
            }
        }

        public function checkUserExist($email){
            $query = "SELECT email FROM `user` WHERE email=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s',$email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function userInput($email, $password, $idVenditore) {
            $query = "INSERT INTO user (Email, Password, IdVenditore) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssi',$email, $password, $idVenditore);
            $stmt->execute();  
        }

        public function checkLogin($email, $password){
            $query = "SELECT password FROM `user` WHERE email=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s',$email);
            $stmt->execute();
            
            $result = $stmt->get_result()->fetch_All(MYSQLI_ASSOC);
            foreach($result as $pwd) {
                return password_verify($password,$pwd["password"]); 
            }
            return false;
        }

        //NOTIFICHE
        public function getNotify(){
            $query = "SELECT * FROM notifica N WHERE N.Email = ? ORDER BY TimeStamp";
            $stmt = $this -> db -> prepare($query);
            $stmt->bind_param('s',$_SESSION['email']);
            $stmt -> execute();
            $result = $stmt -> get_result();
            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        public function insertNotify($codUtente, $text, $idAsta, $idOrdine, $totaleOrdine, $idProdotto){
            $query = "INSERT INTO notifica (Email, Text, IdAsta, IdOrdine, TotaleOrdine, IDProdotto, TimeStamp) VALUES (?,?,?,?,?,?,?)";
            $stmt = $this -> db -> prepare($query);
            $timestamp = time();
            $stmt->bind_param('ssiiiis',$codUtente, $text, $idAsta, $idOrdine, $totaleOrdine, $idProdotto, $timestamp);
            $stmt->execute();
        }

        public function getNotifyDaVisualizzare(){
            $query = "SELECT * FROM notifica N WHERE N.Email = ? AND N.Visualizzata=0 ORDER BY TimeStamp";
            $stmt = $this -> db -> prepare($query);
            $stmt->bind_param('s',$_SESSION['email']);
            $stmt -> execute();
            $result = $stmt -> get_result();
            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        public function visualizzaNotify(){
            $query = "UPDATE notifica SET Visualizzata = 1";
            $stmt = $this -> db -> prepare($query);
            $stmt -> execute();
        }

        public function getNumberOfBids($auctionId){
            $query = "SELECT COUNT(*) AS numRows FROM puntata WHERE IdAsta = ".$auctionId." GROUP BY IdAsta";
            $stmt = $this -> db -> prepare($query);
            $stmt -> execute();
            $result = $stmt -> get_result() -> fetch_All(MYSQLI_ASSOC);
            foreach($result as $cont) {
                return $cont['numRows'];
            }
        }
        
        //End
        //Cart

        public function getRows(){
            $query = "SELECT * FROM riga R, ordine O, prodotto P WHERE O.IdOrdine = R.CodOrdine AND P.IDProdotto = R.CodProdotto AND O.CodCliente= ? AND O.Pagato=0";
            $stmt = $this -> db -> prepare($query);
            $stmt->bind_param('s',$_SESSION['email']);
            $stmt -> execute();
            $result = $stmt -> get_result();

            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        public function checkOrderExist() {
            $query = "SELECT COUNT(*) AS numRows FROM riga R, ordine O, prodotto P WHERE O.IdOrdine = R.CodOrdine AND P.IDProdotto = R.CodProdotto AND O.CodCliente= ? AND O.Pagato=0";
            $stmt = $this -> db -> prepare($query);
            $stmt->bind_param('s',$_SESSION['email']);
            $stmt -> execute();
            $result = $stmt -> get_result() -> fetch_All(MYSQLI_ASSOC);
            foreach($result as $cont) {
                return $cont['numRows'];
            }
        }

        public function deleteRow($idRow) {
            $query = "DELETE FROM riga WHERE IdRiga = ?";
            $stmt = $this -> db -> prepare($query);
            $stmt->bind_param('i',$idRow);
            $stmt -> execute();
        }

        public function checkQuantity($idRow) {
            $query = "SELECT Quantita FROM riga R WHERE IdRiga = ?";
            $stmt = $this -> db -> prepare($query);
            $stmt->bind_param('s',$idRow);
            $stmt -> execute();
            $result = $stmt -> get_result() -> fetch_All(MYSQLI_ASSOC);
            foreach($result as $cont) {
                return $cont['Quantita'];
            }
        }

        public function updateQuantity($actual, $idRow) {
            $query = "UPDATE riga SET Quantita = ? WHERE IdRiga = ?";
            $stmt = $this -> db -> prepare($query);
            $stmt->bind_param('ii',$actual, $idRow);
            $stmt -> execute();
        }
    }    

    //End
?>