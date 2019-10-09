<?php 
    class PagoVo {
        private $id;
        private $idBahia;
        private $idVehiculo;
        private $hora;
        private $fecha;
        private $costo;
        
        public function __construct($id, $idBahia, $idVehiculo, $hora, $fecha, $costo) {
            $this->id = $id;
            $this->idBahia = $idBahia;
            $this->idVehiculo = $idVehiculo;
            $this->hora = $hora;
            $this->fecha = $fecha;
            $this->costo = $costo;
        }
        public function setId($id) {
            $this->id = $id;
        }
        public function setIdBahia($idBahia) {
            $this->idBahia = $idBahia;
        }
        public function setIdVehiculo($idVehiculo) {
            $this->idVehiculo = $idVehiculo;
        }
        public function setHora($hora) {
            $this->hora = $hora;
        }
        public function setFecha($fecha) {
            $this->fecha = $fecha;
        }
        public function setCosto($Costo) {
            $this->costo = $costo;
        }
        
        public function getId() {
            return $this->id;
        }
        public function getIdBahia() {
            return $this->idBahia;
        }
        public function getIdVehiculo() {
            return $this->idVehiculo;
        }
        public function getHora() {
            return $this->hora;
        }
        public function getFecha() {
            return $this->fecha;
        }
        public function getCosto() {
            return $this->costo;
        }
    }
?>