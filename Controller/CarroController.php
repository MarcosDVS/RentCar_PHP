<?php
    require_once "DB/Database.php";

    class CarroController {
        private $conn;
        private $uploadDir = "uploads/"; // Carpeta donde se guardan las imágenes

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        // ------------------------------------------------------------------
        // MANEJAR POST
        // ------------------------------------------------------------------
        public function manejarPost($postData, $fileData) {

            // Eliminar
            if (isset($postData['eliminarItem'])) {
                $this->Eliminar($postData['id']);
                return;
            }

            // Validaciones obligatorias
            $campos = ['marca', 'modelo', 'version', 'year', 'precio'];
            foreach ($campos as $campo) {
                if (empty($postData[$campo])) {
                    $this->crearError("Debe completar todos los campos obligatorios.");
                    return;
                }
            }

            // Crear
            if (isset($postData['crearItem'])) {
                $this->Crear(
                    $postData['marca'],
                    $postData['modelo'],
                    $postData['version'],
                    $postData['year'],
                    $postData['precio'],
                    $postData['fecha_reg'] ?? date('Y-m-d'),
                    $fileData['imagen']
                );
                return;
            }

            // Editar
            if (isset($postData['editarItem'])) {
                $this->Editar(
                    $postData['id'],
                    $postData['marca'],
                    $postData['modelo'],
                    $postData['version'],
                    $postData['year'],
                    $postData['precio'],
                    $fileData['imagen']
                );
                return;
            }
        }

        private function crearError($mensaje) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['error'] = $mensaje;
        }

        // ------------------------------------------------------------------
        // CONSULTAR
        // ------------------------------------------------------------------
        public function Consultar() {
            $query = "SELECT * FROM carros ORDER BY Id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // ------------------------------------------------------------------
        // CREAR
        // ------------------------------------------------------------------
        public function Crear($marca, $modelo, $version, $year, $precio, $fecha_reg, $imagen) {

            // Insertar sin imagen primero
            $query = "INSERT INTO carros (Marca, Modelo, Version, Year, Precio, Fecha_registro, Img)
                VALUES (?, ?, ?, ?, ?, ?, '')";

            $stmt = $this->conn->prepare($query);
            $stmt->execute([$marca, $modelo, $version, $year, $precio, $fecha_reg]);

            // Obtener ID
            $id = $this->conn->lastInsertId();

            // Si hay imagen → procesarla
            if (!empty($imagen['tmp_name'])) {
                $rutaImg = $this->guardarImagen($imagen, $id);

                // Guardar ruta final
                $query = "UPDATE carros SET Img = ? WHERE Id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->execute([$rutaImg, $id]);
            }
        }


        // ------------------------------------------------------------------
        // EDITAR
        // ------------------------------------------------------------------
        public function Editar($id, $marca, $modelo, $version, $year, $precio, $imagen) {

            // Actualizar datos normales
            $query = "UPDATE carros 
                        SET Marca = ?, Modelo = ?, Version = ?, Year = ?, Precio = ?
                    WHERE Id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$marca, $modelo, $version, $year, $precio, $id]);

            // Si subió nueva imagen → reemplazar
            if (!empty($imagen['tmp_name'])) {
                $this->eliminarImagen($id); // Elimina imagen anterior

                $rutaImg = $this->guardarImagen($imagen, $id);

                $query = "UPDATE carros SET Img = ? WHERE Id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->execute([$rutaImg, $id]);
            }
        }

        // ------------------------------------------------------------------
        // ELIMINAR
        // ------------------------------------------------------------------
        public function Eliminar($id) {

            // Eliminar imagen física
            $this->eliminarImagen($id);

            // Eliminar registro
            $query = "DELETE FROM carros WHERE Id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
        }

        // ------------------------------------------------------------------
        // GUARDAR IMAGEN
        // ------------------------------------------------------------------
        private function guardarImagen($imagen, $id) {

            $ext = strtolower(pathinfo($imagen['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, ["png", "jpg", "jpeg"])) {
                return "";
            }

            // Crear carpeta si no existe
            if (!file_exists($this->uploadDir)) {
                mkdir($this->uploadDir, 0777, true);
            }

            $nombreFinal = "Item_" . $id . "." . $ext;
            $rutaFinal = $this->uploadDir . $nombreFinal;

            move_uploaded_file($imagen['tmp_name'], $rutaFinal);

            return $rutaFinal;
        }

        // ------------------------------------------------------------------
        // ELIMINAR IMAGEN EN DISCO
        // ------------------------------------------------------------------
        private function eliminarImagen($id) {
            $query = "SELECT Img FROM carros WHERE Id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!empty($row['Img']) && file_exists($row['Img'])) {
                unlink($row['Img']);
            }
        }
    }
?>

