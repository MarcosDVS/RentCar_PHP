<?php 
    require_once "Controller/CarroController.php";

    $carroController = new CarroController();
    $carros = $carroController->Consultar();

    // Referencia a los servicios para la entidad
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Ejecuta las validaciones y operaciones
        $carroController->manejarPost($_POST, $_FILES);

        // SI hay error, NO redirigir
        if (!empty($_SESSION['error'])) {
            // Se queda en la misma página mostrando el mensaje
        } else {
            // Si no hay error → redirigir
            header("Location: vehiculos.php");
            exit;
        }
    }
?>


<?php 
    if (!empty($_SESSION['error'])) {
        echo '<div class="alert alert-danger text-center fw-semibold">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']); // Limpia el mensaje
    }
?>

<form action="" method="POST" enctype="multipart/form-data">

    <!-- IMPORTANTE: Campo oculto para el ID -->
    <input type="hidden" id="id" name="id">

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Marca</label>
            <input type="text" id="marca" name="marca" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold">Modelo</label>
            <input type="text" id="modelo" name="modelo" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Versión</label>
        <input type="text" id="version" name="version" class="form-control" required>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Año</label>
            <input type="number" id="year" name="year" class="form-control" required min="1900" max="2100">
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold">Precio (RD$)</label>
            <input type="number" id="precio" name="precio" class="form-control" required step="0.01" min="0">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Imagen del Vehículo</label>
        <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*">
    </div>

    <button id="submit-button" class="btn btn-dark w-100 py-2 fw-semibold rounded-3" name="crearItem">
        Guardar Vehículo
    </button>

</form>


<script src="Js/CarroMethod.js"></script>