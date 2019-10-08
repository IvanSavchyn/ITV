<?php 
    public class TipoVehiculoVo {
        private $id;
        private $clase;
        
        public function __construct($id, $clase) {
            $this->id = $id;
            $this->clase = $clase;
        }
        
        public function setIdBahia($id) {
            $this->id = $id;
        }
        public function setClase($clase) {
            $this->clase = $clase;
        }
        public function getId() {
            return $this->id;
        }
        public function getClase() {
            return $this->clase;
        }
    }
?>