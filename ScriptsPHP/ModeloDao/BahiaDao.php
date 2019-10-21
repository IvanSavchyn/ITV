<?php
    class BahiaDao {
        private $bd;
        public function __construct($bd) {
            $this->bd = $bd;
        }
        public function getBahia($id) {
            $consulta = "SELECT * FROM bahias WHERE idBahia = '" . $id . "'";
            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
                return null;
            }
            else {
                $row = mysqli_fetch_assoc($result);
                $bahia = new BahiaVo($row["idBahia"], $row["idParqueadero"], $row["disponible"]);

                return $bahia;
            }
        }
        public function getBahias() {

            $consulta = "SELECT * FROM bahias;";
            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
                return null;
            }
            else {
                $bahias = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $bahia = new BahiaVo($row["idBahia"], $row["idParqueadero"], $row["disponible"]);

                    array_push($bahias, $bahia);
                }
                return $bahias;
            }
        }
        public function insertarBahia($bahia) {
            $consulta = "INSERT INTO bahias VALUES ('" . $bahia->getIdBahia() ."', '" . $bahia->getIdParqueadero() . "', '" . $bahia->getDisponible() . "');";
            if(mysqli_query($this->bd, $consulta)) {
                return true;
            }
            else {
                return false;
            }

        }
        public function eliminarBahia($id) {
            $consulta = "DELETE FROM bahias WHERE idBahia='" . $id . "';";
            if(mysqli_query($this->bd, $consulta)) {
                return true;
            }
            else {
                return false;
            }
        }
        public function modificarBahia($bahia) {
            $consulta = "UPDATE bahias SET idParqueadero='" . $bahia->getIdParqueadero() . "', disponible='" . $bahia->getDisponible() . "' WHERE idBahia='" . $bahia->getIdBahia() . "';";
            if(mysqli_query($this->bd, $consulta)) {
                return true;
            }
            else {
                return false;
            }
        }

    }
?>
