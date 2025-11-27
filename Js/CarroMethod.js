function showForm(id, marca = '', modelo = '', version = '', year = '', precio = '') {
    document.getElementById('formModal').style.display = 'block';
    document.getElementById('modalTitle').textContent = id == 0 ? 'Nuevo vehículo' : 'Actualizar vehículo';

    const submitButton = document.getElementById('submit-button');

    if (id == 0) {
        clearForm();
        submitButton.innerText = 'Registrar';
        submitButton.name = 'crearItem';
    } else {
        fillForm(id, marca, modelo, version, year, precio);
        submitButton.innerText = 'Actualizar';
        submitButton.name = 'editarItem';
    }
}


// Oculta el formulario en el archivo index.php
function hideForm() {
    document.getElementById('formModal').style.display = 'none';
    clearForm(); // Limpia el formulario al cerrar
}
// Abre una ventana flotante para confirmar si deseas eliminar un registro
function confirmDelete() {
    return confirm("Are you sure you want to delete this?");
}

// Recolecta informacion de un registro en el index al utilizar
//el boton EDIT y la inserta en el formulario AddEditArticulo
//ademas cambia el metodo del boton Create de Crear a Editar
function fillForm(id, marca, modelo, version, year, precio) {
    document.getElementById('id').value = id;
    document.getElementById('marca').value = marca;
    document.getElementById('modelo').value = modelo;
    document.getElementById('version').value = version;
    document.getElementById('year').value = year;
    document.getElementById('precio').value = precio;

    const submitButton = document.getElementById('submit-button');
    submitButton.innerText = 'Actualizar';
    submitButton.name = 'editarItem';
}


// Limpia el formulario
function clearForm() {
    document.getElementById('id').value = '';
    document.getElementById('marca').value = '';
    document.getElementById('modelo').value = '';
    document.getElementById('version').value = '';
    document.getElementById('year').value = '';
    document.getElementById('precio').value = '';
    document.getElementById('imagen').value = '';
    document.getElementById('submit-button').innerText = 'Create'; // Restablece el texto del botón
    document.getElementById('submit-button').name = 'crearItem'; // Restablece el nombre del botón a 'create'
}
