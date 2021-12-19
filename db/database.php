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
            $stmt = $this -> db -> prepare("SELECT p.Nome, a.Data, a.OraInizio, a.DataFine, a.OraFine, a.Stato, p.Descrizione, p.DescrizioneBreve, p.Base_asta, p.Prezzo, p.Immagine FROM asta a JOIN prodotto p ON a.CodProdotto = p.IDProdotto ORDER BY a.Data, a.OraInizio ASC");
            $stmt -> execute();
            $result = $stmt -> get_result();
            
            return $result -> fetch_All(MYSQLI_ASSOC);
        }

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
                $query="SELECT Nome, Descrizione, DescrizioneBreve, Prezzo, Immagine, Disponibilita FROM prodotto WHERE IDProdotto=?";
            }
            
            $stmt = $this -> db -> prepare($query);
            $stmt -> bind_param('i', $id);
            $stmt -> execute();
            $result1 = $stmt -> get_result();

            return $result1 -> fetch_All(MYSQLI_ASSOC);
        }
    }    
?>