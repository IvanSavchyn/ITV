<?php 
    public class TarifaVo {
        private $id;
        private $costo;
        private $idTipo;
        
        public function __construct($id, $costo, $idTipo) {
            $this->id = $id;
            $this->costo = $costo;
            $this->idTipo = $idTipo;
        }
        
        public function setId($id) {
            $this->id = $id;
        }
        public function setCosto($costo) {
             $this->costo = $costo;
        }
        public function setIdTipo($idTipo) {
            $this->idTipo = $idTipo;
        }
        public function getId() {
            return $this->id;
        }
        public function getCosto() {
            return $this->costo;
        }
        public function getIdTipo() {
            return $this->idTipo;
        }
    }
?>