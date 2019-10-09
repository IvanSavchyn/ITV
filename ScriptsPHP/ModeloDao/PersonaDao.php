<?php 
    require_once('ConfigBD.php');
    class PersonaDao {
        private $bd;
       
        public function getBD() {
            return $this->bd;
        }
        public function setBD($bd) {
            $this->bd = $bd;
        }
        
        public function conectar() {
            $config = new ConfigBD();
            $this->bd = mysqli_connect($config->getHOST(), $config->getUSER(),$config->getPASSWORD(),$config->getDATABASE());
            if(!$this->bd) {
                return mysqli_connect_error() . "";
            }
            else {
                return 1 . "";
            }
            
        }
    
        public function desconectar() {
            mysqli_close($this->bd);
        }
        public function registrarCliente($cliente) {
            $consulta = "INSERT INTO personas VALUES('" . $cliente->getDni() ."' , '" . $cliente->getNombre() . "' , '" . $cliente->getApellidos() . "', '" . $cliente->getEmail() . "' , '" . $cliente->getTelefono() . "' , '" . $cliente->getDireccion() . "' , '" . $cliente->getContrasenia() . "');";
            
            if(mysqli_query($this->bd, $consulta)) {
                return "insertado";
            }
            else {
                return mysqli_error($this->bd);
            }
            
            
        }
        public function clienteExiste($cliente) {
            $consulta = "SELECT * FROM personas WHERE dni = '" . $cliente->getDni() ."';";
            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
                return false;
            }
            else {
                return true;
            }
        }
    }
?>