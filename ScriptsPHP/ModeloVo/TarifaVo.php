<?php
    class TarifaVo {
        private $costo;
        private $tipo;

        public function __construct($tipo, $costo) {
            $this->costo = $costo;
            $this->tipo = $tipo;
        }


        public function setCosto($costo) {
             $this->costo = $costo;
        }
        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }

        public function getCosto() {
            return $this->costo;
        }
        public function getTipo() {
            return $this->tipo;
        }
    }
?>
