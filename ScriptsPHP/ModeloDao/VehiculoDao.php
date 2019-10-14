<?php 

    class VehiculoDao {
        private $bd;
        
        public function __construct($bd) {
            $this->bd = $bd;
        }
    
        public function registrarVehiculo($coche) {
            $consulta = "INSERT INTO vehiculos VALUES('" . $coche->getId() ."', '" . $coche->getMarca() . "','" . $coche->getAceptado() . "' ,'" . $coche->getIdPersona() . "', '" . $coche->getTipo() . "');";
            
            if(mysqli_query($this->bd, $consulta)) {
                return "insertado";
            }
            else {
                return mysqli_error($this->bd);
            }
            
            
        }
        public function cocheExiste($coche) {
            $consulta = "SELECT * FROM vehiculos WHERE matricula = '" . $coche->getId() ."';";
            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
                return false;
            }
            else {
                return true;
            }
        }
        public function getCochesNoAceptados() {
            include 'ScriptsPHP/ModeloVo/PersonaVo.php';
            include 'ScriptsPHP/ModeloVo/VehiculoVo.php';
            $consulta = "SELECT v.matricula, v.marca , v.idTipo, p.dni, p.nombre, p.apellidos
            FROM vehiculos v, personas p
            WHERE p.dni = v.idPersona AND v.aceptado = 'false';";
            
            $result = mysqli_query($this->bd, $consulta);
            
            if(mysqli_num_rows($result) == 0) {
                return null;
            }
            else {
                $coches = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $persona = new PersonaVo($row["dni"], $row["nombre"], $row["apellidos"], "", "", "", "", "");
                    $vehiculo = new VehiculoVo($row["matricula"],$row["marca"],"","",$row["idTipo"]);
                    
                    array_push($coches, $persona);
                    array_push($coches, $vehiculo);
                }
                return $coches;
            }
        }
        public function getCochesCliente($dni) {
            include 'ScriptsPHP/ModeloVo/VehiculoVo.php';
            $consulta = "SELECT * FROM vehiculos WHERE idPersona = '" . $dni . "'";
            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
                return null;
            }
            else {
                $coches = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $vehiculo = new VehiculoVo($row["matricula"], $row["marca"], $row["aceptado"], $row["idPersona"], $row["idTipo"]);
                    
                    array_push($coches, $vehiculo);
                }
                return $coches;
            }
        }
        public function eliminarCoche($matricula) {
            $consulta = "DELETE FROM vehiculos WHERE matricula='" . $matricula . "';";
            if(mysqli_query($this->bd, $consulta)) {
                return "Coche Eliminado!";
            }
            else {
                return "No se puede eliminar el coche!";
            }
        }
        public function aceptarCoche($matricula) {
            $consulta = "UPDATE vehiculos SET aceptado='true' WHERE matricula='" . $matricula . "';";
            if(mysqli_query($this->bd, $consulta)) {
                return "Coche Aceptado!";
            }
            else {
                return "No se puede aceptar el coche!";
            }
        }
    }
?>