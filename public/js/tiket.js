const btnUpdate = document.querySelector("#update-list"),
  btnAtender = document.querySelector('#atender-cliente'),
  btnGuardar = document.querySelector('#guardar-tiket'),
  tableBody = document.querySelector('#table-body');

window.addEventListener('load', eventListeners)

function eventListeners() {
  btnUpdate.addEventListener('click', getTikets);
  btnAtender.addEventListener('click', setAtender);
  btnGuardar.addEventListener('click', ingresarTiket);
  tableBody.addEventListener('click', gestionarTikets);
  actTikets();
}

function removeLoading() {
  const loadingRow = document.querySelector("#loading-row");
  loadingRow.remove();
}

function addLoading() {
  tableBody.innerHTML = `
  <tr id="loading-row" class="container">
  <td colspan="2" class="justify-content-center">
      <div class="d-flex justify-content-center">
          <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
          </div>
      </div>
  </td>
</tr>
  `;
}

function getTikets(e) {
  e.preventDefault();
  addLoading();
  actTikets();
}

function setAtender() {
  console.log('Inicio de tarea');
  const tiket = document.getElementById('idTiket');
  const inputGestion = document.getElementById('gestion-a-atender');

  if (tiket.value !== "-1") {
    swal({
      type: 'error',
      title: 'Error',
      text: 'Aun hay un tiket en edición'
    })
    return;
  }

  if (inputGestion.value === "-1") {
    swal({
      type: 'error',
      title: 'Error',
      text: 'Debe seleccionar un tiket'
    })
    return;
  }

  const xhr = new XMLHttpRequest();

  xhr.open('GET', `/api/nuevo-tiket-validacion?idGestionCliente=${inputGestion.value}`, true);
  xhr.onload = function () {
    if (this.status === 201) {

      const data = JSON.parse(this.responseText).data;

      tiket.value = data.idtiket;

      const tiketTitle = document.getElementById('tiket-Titulo');
      tiketTitle.innerHTML = `Tiket #${data.idtiket}`;

      const tiketLoaded = document.getElementById('gestion-en-atencion');
      tiketLoaded.value = inputGestion.value;

    }else{
      if(this.status==423){
        swal({
          type: 'info',
          title: 'Tiket bloqueado',
          text: 'El tiket ya esta siendo atendido por otro usuario, sera removido de su pantalla.'
        })

        document.getElementById(`row-id-${inputGestion.value}`).remove();
        inputGestion.value = "-1"
      }
    }
  }
  xhr.send();
}

function ingresarTiket() {

  const nombre = document.querySelector('#nombre').value,
    apellido = document.querySelector('#apellido').value,
    telefono = document.querySelector('#telefono').value,
    direccion = document.querySelector('#direccion').value,
    gestion = document.querySelector('#gestion-real').value,
    problema = document.querySelector('#problema-expuesto').value,
    solucion = document.querySelector('#solucion-brindada').value,
    tiket = document.getElementById('idTiket').value;

    if (tiket.value == "-1") {
      swal({
        type: 'error',
        title: 'Error',
        text: 'Debe seleccionar un tiket'
      })
      return;
    }

  if (
    nombre === "" || apellido === "" || telefono === "" ||
    direccion === "" || gestion === "" || problema === "" || solucion === ""
  ) {
    swal({
      type: 'error',
      title: 'Error',
      text: 'Todos los campos son necesarios'
    })
    return
  } else {
    //CREANDO LLamanda AJAX
    const infoTiket = new FormData();
    infoTiket.append('nombre', nombre);
    infoTiket.append('apellido', apellido);
    infoTiket.append('telefono', telefono);
    infoTiket.append('direccion', direccion);
    infoTiket.append('gestion', gestion);
    infoTiket.append('problema', problema);
    infoTiket.append('solucion', solucion);
    infoTiket.append('tiketId', tiket);

    const xhr = new XMLHttpRequest();

    xhr.open('POST', '/api/nuevo-tiket', true);
    xhr.onload = function () {
      if (this.status == 201) {
        swal({
          type: 'success',
          title: 'Tiket Guardado',
          text: 'El tiket fue creado y guardado correctamente'
        })
      }
      resetForm();
    }

    xhr.send(infoTiket);
  }
}

function resetForm(){
  const fieldsArray = [document.querySelector('#nombre'),
    document.querySelector('#apellido'),
    document.querySelector('#telefono'),
    document.querySelector('#direccion'),
    document.querySelector('#problema-expuesto'),
    document.querySelector('#solucion-brindada'),
    ]

    fieldsArray.map(field => {
      field.value = "";
    })

    const tiket = document.getElementById('idTiket'),
    gestion = document.querySelector('#gestion-real');
    
    tiket.value = '-1';
    gestion.value = '-1';

    const tiketTitle = document.getElementById('tiket-Titulo');
    tiketTitle.innerHTML = `Tiket`

    const tiketLoaded = document.getElementById('gestion-en-atencion');
    document.getElementById(`row-id-${tiketLoaded.value}`).remove();

    tiketLoaded.value = '-1';

}

function actTikets() {
  //Llamado AJAX

  const xhr = new XMLHttpRequest();
  xhr.open('GET', '/api/tikets', true);
  xhr.onload = function () {
    if (this.status === 200) {
      const datos = JSON.parse(this.responseText).datos;
      setTikets(datos);
    }
  }
  xhr.send();
}

function setTikets(datos) {

  tableBody.innerHTML = "";
  datos.map((dato, index) => {
    tableBody.innerHTML += `
    <tr id="row-id-${dato.id}" class="selectable-row" data-gestionCliente-id="${dato.id}">
      <td>${index + 1}</td>
      <td>${dato.gestion.nombreGestion}</td>
    </tr>
    `;
  })
}

function gestionarTikets(e) {
  const row = e.target.parentElement;

  const arrTikets = document.getElementsByClassName('selected-row');
  if (arrTikets.length > 0) {
    arrTikets[0].classList.remove('selected-row');
  }

  row.classList.add('selected-row');
  const inputGestion = document.getElementById('gestion-a-atender');
  inputGestion.value = row.getAttribute('data-gestionCliente-id');
  
}
