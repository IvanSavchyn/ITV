<?php
    class PagoDao {
        private $bd;

        public function __construct($bd) {
            $this->bd = $bd;
        }

        public function getPago($matricula) {

            $consulta = "SELECT * FROM pagos WHERE idVehiculo = '" . $matricula . "';";
            $result = mysqli_query($this->bd, $consulta);

            if(mysqli_num_rows($result) == 0) {
                return null;
            }
            else {
                $row = mysqli_fetch_assoc($result);
                $pago = new PagoVo($row["idPago"], $row["idBahia"], $row["idVehiculo"], $row["hora"], $row["fecha"], $row["costo"]);

                return $pago;
            }
        }
        public function pagar($pago) {
          $consulta = "INSERT INTO pagos VALUES('',NULL,'" . $pago->getIdVehiculo() . "','" . $pago->getHora() . "','" . $pago->getFecha() . "','" . $pago->getCosto() . "');";
          if(mysqli_query($this->bd, $consulta)) {
            return true;
          }
          else {
            return mysqli_error($this->bd);
          }
        }
    }
?>
