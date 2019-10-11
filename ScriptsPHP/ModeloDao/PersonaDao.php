<?php 

    class PersonaDao {
        private $bd;
        
        public function __construct($bd) {
            $this->bd = $bd;
        }
    
        public function registrarCliente($cliente) {
            $consulta = "INSERT INTO personas VALUES('" . $cliente->getDni() ."' , '" . $cliente->getNombre() . "' , '" . $cliente->getApellidos() . "', '" . $cliente->getEmail() . "' , '" . $cliente->getTelefono() . "' , '" . $cliente->getDireccion() . "' ,'false', '" . $cliente->getContrasenia() . "');";
            
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
        public function getClientes($aceptado) {
            include 'ScriptsPHP/ModeloVo/PersonaVo.php';
            $consulta = "SELECT * FROM personas WHERE aceptado = '" . $aceptado ."';";
            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
                return null;
            }
            else {
                $clientes = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $persona = new PersonaVo($row["dni"], $row["nombre"], $row["apellidos"], $row["email"], $row["telefono"], $row["direccion"], $row["aceptado"], "");
                    
                    array_push($clientes, $persona);
                }
                return $clientes;
            }
        }
        public function getClientePorDni($dni) {
            include 'ScriptsPHP/ModeloVo/PersonaVo.php';
            $consulta = "SELECT * FROM personas WHERE dni = '" . $dni ."';";
            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
                return null;
            }
            else {
                $row = mysqli_fetch_assoc($result);
                $persona = new PersonaVo($row["dni"] , $row["nombre"],  $row["apellidos"] , $row["email"] , $row["telefono"], $row["direccion"], $row["aceptado"], $row["contrasenia"]);
                    
                return $persona;
            }
        }
        public function entrar($cliente) {
            
            $consulta = "SELECT * FROM personas WHERE dni = '" . $cliente->getDni() ."';";
            $result = mysqli_query($this->bd, $consulta);
            if(mysqli_num_rows($result) == 0) {
                return null;
            }
            else {
                $row = mysqli_fetch_assoc($result);
                $persona = new PersonaVo($row["dni"], $row["nombre"], $row["apellidos"], $row["email"], $row["telefono"], $row["direccion"], $row["aceptado"], $row["contrasenia"]);
                return $persona;
            }
        }
    }
?>