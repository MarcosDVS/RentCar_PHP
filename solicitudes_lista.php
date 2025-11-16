<?php 
    include 'Src/head.php'; 
    require_once "Controller/SolicitudController.php";

    $solicitudController = new SolicitudController();
    $solicitudes = $solicitudController->Consultar();

    // Referencia a los servicios para la entidad contacto
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $solicitudController->manejarPost($_POST); // Llamada al nuevo método
        header("Location: solicitudes_lista.php");
    }
?>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">Listado de Solicitudes</h1>
        <p class="text-muted fs-5">Aquí puedes ver todas las solicitudes registradas.</p>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Vehículo</th>
                            <th>Fecha Retiro</th>
                            <th>Fecha Devolución</th>
                            <th>Fecha Registro</th>
                            <th>Acción</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($solicitudes)): ?>
                            <?php foreach ($solicitudes as $item): ?>
                                <tr>
                                    <td class="text-center"><?= $item['Id'] ?></td>
                                    <td><?= $item['Nombre'] ?></td>
                                    <td><?= $item['Telefono'] ?></td>
                                    <td><?= $item['Email'] ?></td>
                                    <td class="text-center"><?= $item['Vehiculo'] ?></td>
                                    <td class="text-center"><?= $item['Fecha_retiro'] ?></td>
                                    <td class="text-center"><?= $item['Fecha_devolucion'] ?></td>
                                    <td class="text-center"><?= $item['Fecha_registro'] ?></td>
                                    <td class="text-center">
                                         <!-- Botón Editar -->
                                        <!-- <button type="button" class="btn btn-warning btn-sm"  
                                            onclick="showForm(<?php echo $item['Id']; ?>);  
                                            fillForm('<?php echo $item['Id']; ?>', '<?php echo $item['Nombre']; ?>', '<?php echo $item['Telefono']; ?>',  
                                            '<?php echo $item['Email']; ?>', '<?php echo $item['Vehiculo']; ?>', '<?php echo $item['Fecha_retiro']; ?>', '<?php echo $item['Fecha_devolucion']; ?>', '<?php echo $item['Fecha_registro']; ?>');"> 
                                            Editar 
                                        </button>  -->

                                        <!-- Botón Eliminar -->
                                        <form action="solicitudes_lista.php" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta solicitud?');">
                                            <input type="hidden" name="id" value="<?= $item['Id'] ?>">
                                            <button type="submit" name="eliminarItem" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash-fill"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center py-4">No hay solicitudes registradas.</td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<?php include 'Src/foot.php'; ?>
