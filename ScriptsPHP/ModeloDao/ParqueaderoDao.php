<?php 
    class ParqueaderoDao {
        private $bd;
        public function __construct($bd) {
            $this->bd = $bd;
        }
        public function getParqueadero($id) {
            include 'ScriptsPHP/ModeloVo/ParqueaderoVo.php';
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
    }
?>