<?php include 'Src/head.php'; ?>

<div class="container py-5">

    <!-- Encabezado -->
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5">Preguntas Frecuentes</h1>
        <p class="text-muted fs-5">Respuestas rápidas a las dudas más comunes de nuestros clientes.</p>
    </div>

    <!-- Acordeón de preguntas -->
    <div class="accordion shadow rounded-3" id="faqAccordion">

        <div class="accordion-item">
            <h2 class="accordion-header" id="q1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#a1">
                    ¿Qué necesito para rentar un vehículo?
                </button>
            </h2>
            <div id="a1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Debes presentar tu licencia de conducir vigente, documento de identidad 
                    (cédula o pasaporte) y realizar el depósito correspondiente según el tipo de vehículo.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="q2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a2">
                    ¿Puedo alquilar un vehículo si soy turista?
                </button>
            </h2>
            <div id="a2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    ¡Sí! Aceptamos licencias extranjeras y pasaportes válidos.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="q3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a3">
                    ¿Los precios incluyen seguro?
                </button>
            </h2>
            <div id="a3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Sí, todos nuestros vehículos incluyen seguro básico. También ofrecemos planes de cobertura total.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="q4">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a4">
                    ¿Ofrecen entrega a domicilio?
                </button>
            </h2>
            <div id="a4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Sí, llevamos el vehículo a tu hotel, casa o aeropuerto por un costo adicional.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="q5">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a5">
                    ¿Qué pasa si tengo un accidente?
                </button>
            </h2>
            <div id="a5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Debes comunicarte inmediatamente con nuestro soporte 24/7. Te guiaremos en los pasos a seguir.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="q6">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a6">
                    ¿Qué métodos de pago aceptan?
                </button>
            </h2>
            <div id="a6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Aceptamos efectivo, tarjeta de crédito, transferencia y pagos móviles.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="q7">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a7">
                    ¿Puedo extender mi renta?
                </button>
            </h2>
            <div id="a7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Sí, siempre que informes con al menos 12 horas de anticipación para garantizar disponibilidad.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="q8">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a8">
                    ¿Hay límite de kilometraje?
                </button>
            </h2>
            <div id="a8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Ofrecemos planes con kilometraje limitado e ilimitado. Puedes elegir el que más te convenga.
                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'Src/foot.php'; ?>

