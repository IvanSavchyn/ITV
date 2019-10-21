<?php

    class TarifaDao {
        private $bd;
        public function __construct($bd) {
          $this->bd = $bd;
        }
        public function getTarifa($tipo) {

            $consulta = "SELECT * FROM tarifas WHERE Tipo='" . $tipo . "';";
            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
              return null;
            }
            else{
              $row = mysqli_fetch_assoc($result);
              $tarifa = new TarifaVo($row["Tipo"], $row["costo"]);
              return $tarifa;
            }
        }
        public function selectTarifas() {
          $consulta = "SELECT * FROM tarifas;";
          $result = mysqli_query($this->bd, $consulta);
          if(mysqli_num_rows($result) == 0) {
            return null;
          }
          else {
            $tarifas = array();
            while($row = mysqli_fetch_assoc($result)) {
              $tarifa = new TarifaVo($row["Tipo"], $row["costo"]);
              array_push($tarifas, $tarifa);
            }
            return $tarifas;
          }
        }
    }
?>
