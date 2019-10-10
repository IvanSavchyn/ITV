<?php 
    class PagoDao {
        private $bd;
        
        public function __construct($bd) {
            $this->bd = $bd;
        }
        
        public function getPago($matricula) {
            include "ScriptsPHP/ModeloVo/PagoVo.php";
            $consulta = "Select * FROM pagos WHERE idVehiculo = '" . $matricula . "';";
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
    }
?>