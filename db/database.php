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
            $stmt = $this -> db -> prepare("SELECT p.Nome, a.Data, a.OraInizio, a.DataFine, a.OraFine, a.Stato, p.Descrizione, p.Base_asta, p.Prezzo, p.Immagine FROM asta a JOIN prodotto p ON a.CodProdotto = p.IDProdotto ORDER BY a.Data, a.OraInizio ASC");
            $stmt -> execute();
            $result = $stmt -> get_result();
            
            return $result -> fetch_All(MYSQLI_ASSOC);
        }

        public function getProducts(){
            $stmt = $this -> db -> prepare("SELECT p.Nome, p.Descrizione, p.Prezzo, p.Immagine, p.Disponibilita FROM prodotti p WHERE p.Base_asta = null");
            $stmt -> execute();
            $result = $stmt -> get_result();
            
            return $result -> fetch_All(MYSQLI_ASSOC);
        }
    }    
?>