<?php
    require_once "DB/Database.php";

    class SolicitudController {
        private $conn;

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        // Método para manejar las solicitudes POST
        public function manejarPost($postData) {

            // --- Si es eliminar, NO validar nada ---
            if (isset($postData['eliminarItem'])) {
                $this->Eliminar($postData['id']);
                return;
            }

            // --- Validar campos obligatorios ---
            $camposRequeridos = ['nombre', 'telefono', 'email', 'vehiculo', 'fecha_retiro', 'fecha_devolucion'];

            foreach ($camposRequeridos as $campo) {
                if (empty($postData[$campo])) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['error'] = "Debe completar todos los campos antes de continuar.";
                    return; // No continúa → NO crea, NO edita
                }
            }

            // --- Operaciones ---
            if (isset($postData['crearItem'])) {
                $this->Crear(
                    $postData['nombre'],
                    $postData['telefono'],
                    $postData['email'],
                    $postData['vehiculo'],
                    $postData['fecha_retiro'],
                    $postData['fecha_devolucion'],
                    $postData['fecha_registro'] ?? date('Y-m-d')
                );
            }
            elseif (isset($postData['editarItem'])) {
                $this->Editar(
                    $postData['id'],
                    $postData['nombre'],
                    $postData['telefono'],
                    $postData['email'],
                    $postData['vehiculo'],
                    $postData['fecha_retiro'],
                    $postData['fecha_devolucion'],
                    $postData['fecha_registro']
                );
            }
        }

        public function Consultar() {
            $query = "SELECT * FROM solicitudes";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function Crear($nombre, $telefono, $email, $vehiculo, $fecha_retiro, $fecha_devolucion, $fecha_registro) {
            $query = "INSERT INTO solicitudes (Nombre, Telefono, Email, Vehiculo, Fecha_retiro, Fecha_devolucion, Fecha_registro) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$nombre, $telefono, $email, $vehiculo, $fecha_retiro, $fecha_devolucion, $fecha_registro]);
        }

        public function Editar($id, $nombre, $telefono, $email, $vehiculo, $fecha_retiro, $fecha_devolucion, $fecha_registro) {
            $query = "UPDATE solicitudes SET Nombre = ?, Telefono = ?, Email = ?, Vehiculo = ?, Fecha_retiro = ?, Fecha_devolucion = ?, Fecha_registro = ? WHERE Id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$nombre, $telefono, $email, $vehiculo, $fecha_retiro, $fecha_devolucion, $fecha_registro, $id]);
        }

        public function Eliminar($id) {
            $query = "DELETE FROM solicitudes WHERE Id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
        }
    }
?>
