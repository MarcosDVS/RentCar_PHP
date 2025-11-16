function showForm(id) {
    document.getElementById('formModal').style.display = 'block';
    document.getElementById('modalTitle').textContent = id === 0 ? 'Nueva solicitud' : 'Actualizar solicitud';

    if (id === 0) {
        const submitButton = document.getElementById('submit-button');
        submitButton.innerText = 'Registrar';
        submitButton.name = 'crearItem';
    }
    else {
        // El formulario se llenará con los datos existentes al editar
        const submitButton = document.getElementById('submit-button');
        submitButton.innerText = 'Actualizar';
        submitButton.name = 'editarItem';
    }
}
// Oculta el formulario en el archivo index.php
function hideForm() {
    document.getElementById('formModal').style.display = 'none';
}
// Abre una ventana flotante para confirmar si deseas eliminar un registro
function confirmDelete() {
    return confirm("Are you sure you want to delete this?");
}

// Recolecta informacion de un registro en el index al utilizar
//el boton EDIT y la inserta en el formulario AddEditArticulo
//ademas cambia el metodo del boton Create de Crear a Editar
function fillForm(id, nombre, telefono, email, vehiculo, fecha_retiro, fecha_devolucion) { // almacenan los valores
    // Asignan los valores almacenados a los inputs
    document.getElementById('id').value = id;
    document.getElementById('nombre').value = nombre;
    document.getElementById('telefono').value = telefono;
    document.getElementById('email').value = email;
    document.getElementById('vehiculo').value = vehiculo;
    document.getElementById('fecha_retiro').value = fecha_retiro;
    document.getElementById('fecha_devolucion').value = fecha_devolucion;
    
    const submitButton = document.getElementById('submit-button');
    submitButton.innerText = 'Actualizar';
    submitButton.name = 'editarItem';
}

// Limpia el formulario
function clearForm() {
    document.getElementById('id').value = '';
    document.getElementById('nombre').value = '';
    document.getElementById('telefono').value = '';
    document.getElementById('email').value = '';
    document.getElementById('vehiculo').value = '';
    document.getElementById('fecha_retiro').value = '';
    document.getElementById('fecha_devolucion').value = '';
    document.getElementById('submit-button').innerText = 'Create'; // Restablece el texto del botón
    document.getElementById('submit-button').name = 'crear-cliente'; // Restablece el nombre del botón a 'create'
    hideForm(); // Cierra el modal
}
