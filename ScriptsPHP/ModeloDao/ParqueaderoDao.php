<?php 
    class ParquederoDao {
        private $bd;
        public function __construct($bd) {
            $this->bd = $bd;
        }
        public function getParqueadero($idParqueadero) {
            include 'ScriptsPHP/ModeloVo/Parqueadero.php';
            $consulta = "SELECT * FROM parqueaderos  WHERE idParqueadero = '" . $idParqueadero  ."';";
            $result = mysqli_query($this->bd, $bd);
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