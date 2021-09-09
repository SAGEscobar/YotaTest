const gestiones = document.querySelector('#gestiones');

window.addEventListener('load', eventListeners)

function eventListeners() {
  gestiones.addEventListener('click', crearGestionCliente);
  numeroContactos();
}



function crearGestionCliente(e) {

  if (e.target.classList.contains('btn-gestion')) {
    const id = e.target.getAttribute('data-gestion-id');
    const xhr = new XMLHttpRequest();
    console.log('Inicio de la operacion');
    xhr.open('GET', `/api/nueva-gestion-cliente?idGestion=${id}`, true);
    xhr.onload = function () {
      if (this.status === 201) {
        const resultado = JSON.parse(this.responseText);

        if (resultado.success === 'Creado con exito') {
          console.log('fin de la operacion');
          // mostrarNotificacion(, 'correcto');
          swal({
            type: 'success',
            title: 'Gestión creada',
            text: `Su numero de gestion es ${resultado.id}`
          })
        } else {
          swal({
            type: 'error',
            title: 'Error',
            text: 'Ha ocurrido un error al crear la gestión :('
          })
        }
      }
    }
    xhr.send();
  }

}