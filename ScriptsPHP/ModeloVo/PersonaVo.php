
<?php 
    class PersonaVo {
        private $dni;
        private $nombre;
        private $apellidos;
        private $email;
        private $telefono;
        private $direccion;
        private $aceptado;
        private $contrasenia;
        private $nuevaContrasenia;
        
        public function __construct($dni, $nombre, $apellidos, $email, $telefono, $direccion, $aceptado, $contrasenia) {
            $this->dni = $dni;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->email = $email;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $this->aceptado = $aceptado;
            $this->contrasenia = $contrasenia;
            $this->nuevaContrasenia = "";
        }
        
        public function setDni($dni) {
            $this->dni = $dni;
        }
        public function setNombre($nombre) {
             $this->nombre = $nombre;
        }
        public function setApellidos($apellidos) {
            $this->apellidos = $apellidos;
        }
        public function setEmail($Email) {
            $this->email = $email;
        }
        public function setTelefono($telefono) {
             $this->telefono = $telefono;
        }
        public function setDireccion($direccion) {
            $this->direccion = $direccion;
        }
        public function setAceptado($aceptado) {
            $this->aceptado = $aceptado;
        }
        public function setContrasenia($contrasenia) {
            $this->contrasenia = $contrasenia;
        }
        public function setNuevaContrasenia($contrasenia) {
            $this->nuevaContrasenia = $contrasenia;
        }
        
        
        public function getDni() {
            return $this->dni;
        }
        public function getNombre() {
            return $this->nombre;
        }
        public function getApellidos() {
            return $this->apellidos;
        }
        public function getEmail() {
            return $this->email;
        }
        public function getTelefono() {
            return $this->telefono;
        }
        public function getDireccion() {
            return $this->direccion;
        }
        public function getAceptado() {
            return $this->aceptado;
        }
        public function getContrasenia() {
            return $this->contrasenia;
        }
        public function getNuevaContrasenia() {
            return $this->nuevaContrasenia;
        }
    }
?>