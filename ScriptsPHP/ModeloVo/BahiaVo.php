<?php 
    class BahiaVo {
        private $idBahia;
        private $idParqueadero;
        private $disponible;
        
        public function __construct($idBahia, $idParqueadero, $disponible) {
            $this->idBahia = $idBahia;
            $this->idParqueadero = $idParqueadero;
            $this->disponible = $disponible;
        }
        
        public function setIdBahia($id) {
            $this->idBahia = $id;
        }
        public function setIdParqueadero($idParqueadero) {
             $this->idParqueadero = $idParqueadero;
        }
        public function setDisponible($disponible) {
            $this->disponible = $disponible;
        }
        public function getIdIdBahia() {
            return  $this->idBahia;
        }
        public function getIdParqueadero() {
            return $this->idParqueadero;
        }
        public function getDisponible() {
            return $this->disponible;
        }
        }
?>