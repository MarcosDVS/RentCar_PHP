<?php 
    include 'Src/head.php'; 
    require_once "Controller/CarroController.php";

    $carroController = new CarroController();
    $carros = $carroController->Consultar();

?>

<section class="page-header">
    <!-- Modal para el formulario de nuevo artículo -->
    <div id="formModal" class="modal" tabindex="-1" role="dialog" style="display:none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold" id="modalTitle"></h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close" onclick="hideForm();">
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Referencia al formulario de los articulos -->
                    <?php include 'CarroForm.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Encabezado de sección -->
    <div class="text-center my-5">
        <h1 class="fw-bold text-primary">Nuestros Vehículos</h1>
        <p class="text-muted fs-5">Selecciona el vehículo ideal para tu viaje.</p>
        <button id="newButton" 
                class="btn btn-dark mb-3 fw-semibold shadow-sm" 
                onclick="showForm(0);">
            <i class="bi bi-plus-circle me-1"></i> Agregar vehículo
        </button>
        <hr class="mx-auto opacity-25" style="width:180px;">
    </div>

</section>

<section class="vehiculos">
    <div class="vehiculos-container">

        <?php if (empty($carros)): ?>
            
            <div class="alert alert-info text-center w-100 fs-5 shadow-sm">
                No hay vehículos registrados por el momento.
            </div>

        <?php else: ?>

            <?php foreach ($carros as $carro): ?>
                <?php 
                    $img = !empty($carro['Img']) 
                        ? $carro['Img'] 
                        : 'default-car.jpg'; 
                ?>

                <div class="vehiculo-card shadow-sm">
                    <img src="<?php echo $img; ?>" alt="Vehículo">

                    <h3 class="mt-2">
                        <?php echo $carro['Marca'] . ' ' . $carro['Modelo']; ?>
                    </h3>

                    <p class="text-muted mb-1">
                        Versión: <?php echo $carro['Version']; ?>
                    </p>

                    <p class="fw-bold text-primary fs-5">
                        RD$ <?php echo number_format($carro['Precio'], 2); ?>
                    </p>

                    <small class="text-secondary">
                        Año: <?php echo $carro['Year']; ?>
                    </small>
                    <br>
                    <button type="button" class="btn btn-warning btn-sm fw-bold"
                        onclick="showForm(
                            '<?php echo $carro['Id']; ?>',
                            `<?php echo htmlspecialchars($carro['Marca']); ?>`,
                            `<?php echo htmlspecialchars($carro['Modelo']); ?>`,
                            `<?php echo htmlspecialchars($carro['Version']); ?>`,
                            `<?php echo htmlspecialchars($carro['Year']); ?>`,
                            `<?php echo htmlspecialchars($carro['Precio']); ?>`
                        );">
                        EDIT
                    </button>

                    <button type="button" class="btn btn-danger btn-sm text-black fw-bold" 
                        onclick="if(confirmDelete()) { 
                            document.getElementById('deleteForm<?php echo $carro['Id']; ?>').submit(); }">
                        DELETE
                    </button>
                    <form id="deleteForm<?php echo $carro['Id']; ?>" method="post" style="display:none;">
                        <input type="hidden" name="id" value="<?php echo $carro['Id']; ?>">
                        <input type="hidden" name="eliminarItem" value="1">
                    </form>
                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</section>


<script src="Js/CarroMethod.js"></script>
<?php include 'Src/foot.php'; ?>
