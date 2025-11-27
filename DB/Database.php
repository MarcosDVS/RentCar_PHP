<?php
    class Database {
        private $host = "localhost"; //Direccion ip de tu servidor de base de datos
        private $db_name = "rentcar_db"; //Nombre de tu database 
        private $username = "root"; //Nombre de usuario en el servidor que aloja tu base de datos
        private $password = ""; //Contraseña del usuario de la base de datos
        public $conn; //Conexión a la base de datos


        public function getConnection() {
            $this->conn = null;
            try {
                // Crea una nueva conexión PDO (PHP Data Objects) a la base de datos
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                                    $this->username, $this->password);
                $this->conn->exec("set names utf8");
                // Establece el modo de error de PDO a excepción 
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $exception) {
                // Captura cualquier excepción y muestra un mensaje de error 
                echo "Error de conexión: " . $exception->getMessage();
            }
            return $this->conn; // Devuelve la conexión a la base de datos
        }
    }
?>
