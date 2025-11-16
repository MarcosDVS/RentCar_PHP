<?php 
    include 'Src/head.php'; 
    require_once "Controller/SolicitudController.php";

    $solicitudController = new SolicitudController();
    $solicitudes = $solicitudController->Consultar();

    // Referencia a los servicios para la entidad
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Ejecuta las validaciones y operaciones
        $solicitudController->manejarPost($_POST);

        // SI hay error, NO redirigir
        if (!empty($_SESSION['error'])) {
            // Se queda en la misma página mostrando el mensaje
        } else {
            // Si no hay error → redirigir
            header("Location: solicitudes_lista.php");
            exit;
        }
    }

?>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">Solicitud de Renta</h1>
        <p class="text-muted fs-5">Completa el formulario para procesar tu solicitud.</p>
        <?php 
            if (!empty($_SESSION['error'])) {
                echo '<div class="alert alert-danger text-center fw-semibold">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']); // Limpia el mensaje
            }
        ?>

    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">

                    <!-- Formulario de solicitud -->
                    <form method="POST" class="needs-validation" novalidate>
                        <!-- action="procesar_solicitud.php" -->

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nombre completo</label>
                            <input type="text" id="nombre" name="nombre" class="form-control form-control-lg" required>
                        </div>

                        <!-- Teléfono -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Teléfono</label>
                            <input type="text" id="telefono" name="telefono" class="form-control form-control-lg" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg" required>
                        </div>

                        <!-- Vehículo -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tipo de Vehículo</label>
                            <select id="vehiculo" name="vehiculo" class="form-select form-select-lg">
                                <option value="Económico">Económico</option>
                                <option value="SUV Familiar">SUV Familiar</option>
                                <option value="Lujo">Lujo</option>
                            </select>
                        </div>

                        <!-- Fecha Retiro -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Fecha de Retiro</label>
                            <input type="date" id="fecha_retiro" name="fecha_retiro" class="form-control form-control-lg" required>
                        </div>

                        <!-- Fecha Devolución -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Fecha de Devolución</label>
                            <input type="date" id="fecha_devolucion" name="fecha_devolucion" class="form-control form-control-lg" required>
                        </div>

                        <!-- Botón -->
                        <div class="d-grid">
                            <button type="submit" id="submit-button" class="btn btn-primary btn-lg rounded-3" name="crearItem">
                                Enviar Solicitud
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="Js/SolicitudMethod.js"></script>
<?php include 'Src/foot.php'; ?>
