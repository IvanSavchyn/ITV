<?php 
    class BahiaDao {
        private $bd;
        public function __construct($bd) {
            $this->bd = $bd;
        }
        public function getBahia($id) {
            include 'ScriptsPHP/ModeloVo/BahiaVo.php';
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
    }
?>