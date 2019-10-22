<?php
    class PagoDao {
        private $bd;

        public function __construct($bd) {
            $this->bd = $bd;
        }
        public function getPagoPorId($id) {
          $consulta = "SELECT * FROM pagos WHERE idPago = '" . $id . "';";
          $result = mysqli_query($this->bd, $consulta);

            if(mysqli_num_rows($result) == 0) {
                return null;
            }
            else {
                $row = mysqli_fetch_assoc($result);
                $pago = new PagoVo($row["idPago"], $row["idBahia"], $row["idVehiculo"], $row["hora"], $row["fecha"], $row["costo"]);
                $pago->setArchivo($row["archivo"]);
                return $pago;
            }
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
                $pago->setArchivo($row["archivo"]);
                return $pago;
            }
        }
        public function pagar($pago) {
          $consulta = "INSERT INTO pagos VALUES('',NULL,'" . $pago->getIdVehiculo() . "','" . $pago->getHora() . "','" . $pago->getFecha() . "','" . $pago->getCosto() . "', '');";
          if(mysqli_query($this->bd, $consulta)) {
            return true;
          }
          else {
            return mysqli_error($this->bd);
          }
        }
        public function asignarBahia($pago) {
          $consulta = "UPDATE pagos SET idBahia='" . $pago->getIdBahia() . "' WHERE idPago='" . $pago->getId() ."';";
          if(mysqli_query($this->bd, $consulta)) {
            return true;
          }
          else {
            return false;
          }
        }
        public function asignarArchivo($pago) {
          $consulta = "UPDATE pagos SET archivo='" . $pago->getArchivo() . "' WHERE idPago='" . $pago->getId() ."';";
          if(mysqli_query($this->bd, $consulta)) {
            return true;
          }
          else {
            return false;
          }
        }
    }
?>
