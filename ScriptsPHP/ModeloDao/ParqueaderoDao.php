<?php
    class ParqueaderoDao {
        private $bd;
        public function __construct($bd) {
            $this->bd = $bd;
        }
        public function getParqueadero($id) {

            $consulta = "SELECT * FROM parqueaderos  WHERE idParqueadero = '" . $id . "';";
            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
                return null;
            }
            else {
                $row = mysqli_fetch_assoc($result);
                $parck = new ParqueaderoVo($row["idParqueadero"], $row["nombre"], $row["ubicacion"]);
                return $parck;
            }
        }
        public function selectParqueaderos() {
          $parqueaderos = array();
          $consulta = "SELECT * FROM parqueaderos;";
          $result = mysqli_query($this->bd, $consulta);
          if(mysqli_num_rows($result) == 0) {
            return null;
          }
          else {
            while($row = mysqli_fetch_assoc($result)){
                $parq = new ParqueaderoVo($row["idParqueadero"], $row["nombre"], $row["ubicacion"]);
                array_push($parqueaderos, $parq);
            }
            return $parqueaderos;
          }
        }
        public function insertParqueadero($parck) {
            $consulta = "INSERT INTO parqueaderos VALUES('" . $parck->getId() . "', '" . $parck->getNombre() . "', '" . $parck->getUbicacion() . "');";
            if(mysqli_query($this->bd, $consulta)) {
                return true;
            }
            else {
                return false;
            }
        }
        public function eliminarParqueadero($id) {
            $consulta = "DELETE FROM parqueaderos WHERE idParqueadero='" . $id . "';";
            if(mysqli_query($this->bd, $consulta)) {
                return true;
            }
            else {
                return false;
            }
        }
    }
?>
