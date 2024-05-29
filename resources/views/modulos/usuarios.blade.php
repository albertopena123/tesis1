@extends('layouts.admin')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

@endsection
@section('script')
<!-- <script src="{{ asset('modulos/filtros.js') }}"></script> -->

<script src="{{ asset('modulos/usuarios.js') }}"></script>



@endsection
@section('contenidoprincipal')

<script >
   
var usuarios = <?php echo json_encode($usuarios); ?>;
console.log(usuarios);

// Función para buscar usuario por DNI
function buscarUsuarioPorDNI(dni) {
    // Aquí puedes realizar acciones con el DNI recibido
    console.log("Se hizo clic en el botón para buscar el usuario con DNI: " + dni);

    // Recorrer el arreglo de usuarios
    for (var i = 0; i < usuarios.length; i++) {
        // Verificar si el DNI del usuario en la posición 'i' coincide con el DNI recibido
        if (usuarios[i].dni === dni) {

            // Si coincide, imprimir información del usuario encontrado
            document.getElementById('nombrecarnet').value = usuarios[i].name;
            document.getElementById('emailcarnet').value = usuarios[i].email;
            document.getElementById('carnet_id').value = usuarios[i].carnet['id'];;

            console.log("ingresando carnet dni");
            
      

            // Establecer el valor del rol del usuario
            var rolUsuarioSelect = document.getElementById('rolusuario');
            if (usuarios[i].acceso_id === 1) {
                rolUsuarioSelect.value = "male"; // Admin
            } else if (usuarios[i].acceso_id === 2) {
                rolUsuarioSelect.value = "female"; // Socio
            }
            // Establecer el estado del carné
            var estadoCarnetSelect = document.getElementById('estadocarnet');
            if (usuarios[i].carnet['estado'] === 0) {
                estadoCarnetSelect.value = "no_carnet"; // No Carnet
            } else if (usuarios[i].carnet['estado'] === 1) {
                estadoCarnetSelect.value = "carnet_operacional"; // Carnet Operacional
            }
            document.getElementById('placacarnet').value = usuarios[i].carnet['placa'];
            document.getElementById('fechasoat').value = usuarios[i].carnet['fecha_soat'];
            // Obtener el elemento de la vista donde se mostrará la imagen
            const previewElement = document.getElementById('preview');

            // Obtener la ruta de la imagen desde el objeto de usuario
            const fotoCarnetPath = usuarios[i].carnet['fotocarnet'];

            // Asignar la ruta de la imagen al atributo src del elemento <img>
            previewElement.src = 'storage/'+ fotoCarnetPath;

            
            // Convertir la fecha de creación del carné a un formato legible
            var fechaCreacionCarnet = new Date(usuarios[i].carnet['created_at']);
            var fechaCreacionCarnetFormateada = fechaCreacionCarnet.toISOString().substring(0, 10); // Obtener solo la parte de la fecha en formato yyyy-mm-dd
            document.getElementById('carnetcreacion').value = fechaCreacionCarnetFormateada;

            var pdf = usuarios[i].carnet['pdf']; // Obtenemos la ruta de acceso al PDF

            // Establecemos el href del enlace con la ruta de acceso al PDF
            document.getElementById('enlacepdf').href = 'storage/'+pdf;

            // Terminamos la búsqueda una vez que se encuentre el usuario
            console.log("Usuario encontrado:");
            console.log("Nombre: " + usuarios[i].nombre);
            console.log("Apellido: " + usuarios[i].apellido);
            // Puedes realizar otras acciones con el usuario encontrado aquí
            return;
        }
    }

    // Si el usuario con el DNI especificado no se encuentra
    console.log("No se encontró ningún usuario con el DNI: " + dni);
}


</script>



@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
                              <div class="alert alert-danger">
                                  {{ session('error') }}
                              </div>
                          @endif
    <div class="modal fade" id="ModalCarnet" tabindex="-1" aria-labelledby="projectsCardViewModal" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-md">
          <div class="modal-content overflow-hidden">
          <div class="modal-header position-relative p-0">
   

    <button class="btn btn-circle project-modal-btn position-absolute end-0 top-0 mt-3 me-3 bg-body-emphasis" data-bs-dismiss="modal">
        <svg class="svg-inline--fa fa-xmark text-body dark__text-white" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
            <path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z">
            </path>
        </svg><!-- <span class="fa-solid fa-xmark text-body dark__text-white"></span> Font Awesome fontawesome.com -->
    </button>

    <img class="rounded-circle mx-auto d-block"  alt="" style="max-height: 100px; min-height: 300px;" id="preview">
</div>
<div id="usuariosElemento" data-usuarios="{{ json_encode($usuarios) }}"></div>


              <div class="modal-body p-0">
                <div class="row gx-0 gy-3 border-bottom px-5 px-lg-6 py-4 p-xl-0">
                  <div class="col-12 col-xl-5 border-end-xl">
                    <div class="row h-100 align-items-center px-xl-6 justify-content-between justify-content-xl-start">
                      <div class="col-auto">
                        <p class="text-body-tertiary fs-10 fw-semibold mb-0">Fecha de Creación</p>
                          <input class="form-control" id="carnetcreacion" type="date" disabled>

                      </div>  
                      
                    </div>
                  </div>
                  <div class="col-12 col-xl-7">
                    <div class="px-xl-6 py-xl-4">
                      <div class="row g-2 align-items-center">
                        <div class="col-auto col-12 col-lg-auto d-flex flex-1">
                          <div class="dropdown">
                          <a id="enlacepdf" href="www.google.com" class="btn btn-link px-2 text-body copy-code-btn" target="_blank"  >
                              <svg class="svg-inline--fa fa-copy me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="copy" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M384 96L384 0h-112c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48H464c26.51 0 48-21.49 48-48V128h-95.1C398.4 128 384 113.6 384 96zM416 0v96h96L416 0zM192 352V128h-144c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48h192c26.51 0 48-21.49 48-48L288 416h-32C220.7 416 192 387.3 192 352z"></path></svg><!-- <span class="fas fa-copy me-1"></span> Font Awesome fontawesome.com -->PDF
                            </a>



                            
                          </div>
                          
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row g-0">
                  <div class="col-12 col-xl-5 border-end">
                    <div class="px-5 px-lg-6 py-4">
                      <h3 class="fw-bolder lh-sm mb-5">Nueva Juventud</h3>
                     
                    
                      
                      <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                          <h4 class="me-3">Description</h4><button class="btn btn-link p-0"><svg class="svg-inline--fa fa-pen" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z"></path></svg><!-- <span class="fa-solid fa-pen"></span> Font Awesome fontawesome.com --></button>
                        </div>
                        <p class="text-body-highlight">Tu viaje seguro, cómodo y confiable: ¡Somos tu mejor ruta.</p>
                        <!-- <button class="btn btn-sm btn-primary px-6">Enviar</button> -->

                      </div>
                    </div>
                   
                  </div>
                  <div class="col-12 col-xl-7">
                    <div class="px-5 px-lg-6 py-4">
                      
                      <h4 class="mb-3">Datos de Carnet</h4>
                      <div class="p-1 code-to-copy">
                      <form id="miFormulario" class="mb-9" method="POST" action="{{ route('updatecarnet') }}">
                        @csrf
                        <div class="mb-3">
                          <label class="form-label" for="basic-form-name">Nombre Completo</label>
                          <input class="form-control" id="nombrecarnet" type="text" placeholder="Name" disabled>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-form-email">correo electronico</label>
                          <input class="form-control" id="emailcarnet" type="email" placeholder="name@example.com" disabled>
                          <input type="hidden" id="carnet_id" name="carnet_id">

                        </div>
                        <div class="mb-3">
                        <label class="form-label" for="basic-form-gender">Estado de Carnet</label>

                        <select class="form-select" id="estadocarnet" aria-label="Estado del Carné" disabled>
                            <option selected="selected" value="">Seleccione el Estado del Carné</option>
                            <option value="no_carnet">No Carnet</option>
                            <option value="carnet_operacional">Carnet Operacional</option>
                        </select>
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label" for="basic-form-dob">Fecha Vencimiento SOAT</label>
                          <input class="form-control" id="fechasoat" name="fechasoat" type="date">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-form-gender">ROL</label>
                          <select class="form-select" id="rolusuario" aria-label="Default select example" disabled>
                            <option selected="selected">Selecciona su Rol</option>
                            <option value="male">Admin</option>
                            <option value="female">Socio</option>
                           
                          </select>
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label">Foto Carnet</label>
                          <input class="form-control" type="file" id="image" name="image" onchange="previewImage(event)" disabled>
                        </div>
                        <div class="mb-3">
                        <label class="form-label" for="basic-form-dob">Placa Vehicular</label>
                          <input class="form-control" id="placacarnet" type="text" disabled>
                        </div>
                     
                        <button class="btn btn-primary" type="submit" >Editar</button>
                      </form>
                    </div>
                      
                      
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>
                       
      <!-- MODAL FIN CARNET  -->
<div class="modal fade" id="projectsCardViewModal" tabindex="-1" aria-labelledby="projectsCardViewModal" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content overflow-hidden">
              <div class="modal-header position-relative p-0">
                <!-- HEADER MODAL -->
              </div>
              <div class="modal-body p-5 px-md-6">
                <div class="row g-5">
                <div class="col-12 col-xl-12">
              <div class="border-bottom mb-4">
              <button class="btn btn-circle project-modal-btn position-absolute end-0 top-0 mt-3 me-3 bg-body-emphasis" data-bs-dismiss="modal"><svg class="svg-inline--fa fa-xmark text-body" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fa-solid fa-xmark text-body"></span> Font Awesome fontawesome.com --></button>
              <form method="POST" action="{{ route('registro') }}">
                @csrf
                <div class="mb-6">
                  <h4 class="mb-4">Informacion Personal</h4>
                  <div class="row g-3">

                 
                  <div class="col-12 col-sm-6">
                      <div class="form-icon-container">
                        <div class="form-floating">
                          <input class="form-control form-icon-input" name="dni" id="dni" type="text" placeholder="First Name">
                          <div id="socio" class="alert alert-outline-danger invalid-feedback" role="alert" >
                    El DNI ya está registrado.
                  </div>
                          <!-- <span id="socio" class="badge badge-phoenix badge-phoenix-danger invalid-feedback">El DNI ya está registrado.</span> -->


                        <label class="text-body-tertiary form-icon-label" for="firstName">Numero Documento</label>
                        

                      </div>
                      <svg class="svg-inline--fa fa-user text-body fs-9 form-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" role="img" 
                      xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                        <path fill="currentColor" d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61
                         304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path></svg><!-- <span class="fa-solid fa-user text-body fs-9 form-icon"></span> Font Awesome fontawesome.com -->
                      </div>

                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-icon-container">
                        <div class="form-floating"><input class="form-control form-icon-input" name="nombre" id="nombre" type="text" placeholder="First Name"><label class="text-body-tertiary form-icon-label" for="firstName">Nombres</label></div><svg class="svg-inline--fa fa-user text-body fs-9 form-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path></svg><!-- <span class="fa-solid fa-user text-body fs-9 form-icon"></span> Font Awesome fontawesome.com -->
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-icon-container">
                        <div class="form-floating"><input class="form-control form-icon-input" name="apellidop" id="apellidop" type="text" placeholder="Last Name"><label class="text-body-tertiary form-icon-label" for="lastName">Apellido Paterno</label></div><svg class="svg-inline--fa fa-user text-body fs-9 form-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path></svg><!-- <span class="fa-solid fa-user text-body fs-9 form-icon"></span> Font Awesome fontawesome.com -->
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-icon-container">
                        <div class="form-floating"><input class="form-control form-icon-input" name="apellidom" id="apellidom" type="text" placeholder="Last Name"><label class="text-body-tertiary form-icon-label" for="lastName">Apellido Materno</label></div><svg class="svg-inline--fa fa-user text-body fs-9 form-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path></svg><!-- <span class="fa-solid fa-user text-body fs-9 form-icon"></span> Font Awesome fontawesome.com -->
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-icon-container">
                        

                        <div class="form-floating"><input class="form-control form-icon-input" name="email" id="email" type="email" placeholder="Email"><label class="text-body-tertiary form-icon-label" for="emailSocial">Correo</label></div><svg class="svg-inline--fa fa-envelope text-body fs-9 form-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 64C490.5 64 512 85.49 512 112C512 127.1 504.9 141.3 492.8 150.4L275.2 313.6C263.8 322.1 248.2 322.1 236.8 313.6L19.2 150.4C7.113 141.3 0 127.1 0 112C0 85.49 21.49 64 48 64H464zM217.6 339.2C240.4 356.3 271.6 356.3 294.4 339.2L512 176V384C512 419.3 483.3 448 448 448H64C28.65 448 0 419.3 0 384V176L217.6 339.2z"></path></svg><!-- <span class="fa-solid fa-envelope text-body fs-9 form-icon"></span> Font Awesome fontawesome.com -->
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-icon-container">
                        <div class="form-floating"><input class="form-control form-icon-input" name="celular" id="celular" type="tel" placeholder="Phone"><label class="text-body-tertiary form-icon-label" for="phone">Numero Celular</label></div><svg class="svg-inline--fa fa-phone text-body fs-9 form-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z"></path></svg><!-- <span class="fa-solid fa-phone text-body fs-9 form-icon"></span> Font Awesome fontawesome.com -->
                      </div>
                    </div>
                    
                  </div>
                </div>
                <div class="row gx-3 mb-6 gy-6 gy-sm-3">
                 
                  <div class="col-12 col-sm-6">
                    <h4 class="mb-4">Credenciales de Acceso</h4>
                    <div class="form-icon-container mb-3">
                      <div class="form-floating">
                      <select class="form-control form-icon-input" name="acceso_id" id="acceso_id">
                          <option value="1">Admin</option>
                          <option value="2">Socio</option>
                      </select>

                        <label class="text-body-tertiary form-icon-label" for="newPassword">Rol</label>
                      </div><svg class="svg-inline--fa fa-key text-body fs-9 form-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="key" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                        <path fill="currentColor" d="M282.3 343.7L248.1 376.1C244.5 381.5 238.4 384 232 384H192V424C192 437.3 181.3 448 168 448H128V488C128 501.3 117.3 512 104 512H24C10.75 512 0 501.3 0 488V408C0 401.6 2.529 395.5 7.029 391L168.3 229.7C162.9 212.8 160 194.7 160 176C160 78.8 238.8 0 336 0C433.2 0 512 78.8 512 176C512 273.2 433.2 352 336 352C317.3 352 299.2 349.1 282.3 343.7zM376 176C398.1 176 416 158.1 416 136C416 113.9 398.1 96 376 96C353.9 96 336 113.9 336 136C336 158.1 353.9 176 376 176z"></path></svg><!-- <span class="fa-solid fa-key text-body fs-9 form-icon"></span> Font Awesome fontawesome.com -->
                    </div>
                    <div class="form-icon-container mb-3">
                      <!-- Strong Password -->
<div class="max-w-sm">
  <div class="flex mb-2">
    <div class="flex-1">
    <input type="password" name="password" id="hs-strong-password-with-indicator-and-hint" class="py-3 px-4 block w-full border border-gray-300 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Ingrese Contraseña">

      <div id="hs-strong-password" data-hs-strong-password='{
        "target": "#hs-strong-password-with-indicator-and-hint",
        "hints": "#hs-strong-password-hints",
        "stripClasses": "hs-strong-password:opacity-100 hs-strong-password-accepted:bg-teal-500 h-2 flex-auto rounded-full bg-blue-500 opacity-50 mx-1"
      }' class="flex mt-2 -mx-1"></div>
    </div>
  </div>

  <div id="hs-strong-password-hints" class="mb-3">


    <h4 class="my-2 text-sm font-semibold text-gray-800 dark:text-white">
      Su contraseña debe contener.
    </h4>

    <ul class="space-y-1 text-sm text-gray-500 dark:text-neutral-500">
      <li data-hs-strong-password-hints-rule-text="min-length" class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
        <span class="hidden" data-check="">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </span>
        <span data-uncheck="">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </span>
        El número mínimo de caracteres es 6.
      </li>
      <li data-hs-strong-password-hints-rule-text="lowercase" class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
        <span class="hidden" data-check="">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </span>
        <span data-uncheck="">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </span>
        Debe contener minúsculas.
      </li>
      <li data-hs-strong-password-hints-rule-text="uppercase" class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
        <span class="hidden" data-check="">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </span>
        <span data-uncheck="">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </span>
        Debe contener mayúsculas.
      </li>
      <li data-hs-strong-password-hints-rule-text="numbers" class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
        <span class="hidden" data-check="">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </span>
        <span data-uncheck="">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </span>
        Debe contener números.
      </li>
      <li data-hs-strong-password-hints-rule-text="special-characters" class="hs-strong-password-active:text-teal-500 flex items-center gap-x-2">
        <span class="hidden" data-check="">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </span>
        <span data-uncheck="">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </span>
        Debe contener caracteres especiales.
      </li>
    </ul>
  </div>
</div><!-- <span class="fa-solid fa-key text-body fs-9 form-icon"></span> Font Awesome fontawesome.com -->
                  </div>
                  

                  </div>
                </div>
              
                <div class="text-end mb-6">
                  <div>
                  <button id="btn-registrar" class="btn btn-phoenix-primary" type="submit">Registrar Usuario</button>
                  </div>
                </div>
              </form>


              </div>
             
            </div>
                 
                </div>
              </div>
            </div>
          </div>
</div>
<nav class="mb-2" aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#!">Modulos</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
          </ol>
        </nav>
        <h2 class="text-bold text-body-emphasis mb-5">Usuarios</h2>
        <div id="members" data-list='{"valueNames":["customer","email","mobile_number","city","last_active","joined","fechasoat"],"page":10,"pagination":true}'>
          <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
              <div class="search-box">
                <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input class="form-control search-input search" type="search" placeholder="Buscar Usuarios" aria-label="Search">
                  <span class="fas fa-search search-box-icon"></span>
                </form>
              </div>
            </div>
            <div class="col-auto">
              <div class="d-flex align-items-center">
                <!-- <button class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2">

              </span>Export</button> -->
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#projectsCardViewModal"><span class="fas fa-plus me-2">

              </span>Agregar Usuario</button>
            </div>

            
            </div>
          </div>
          <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
              <table class="table table-sm fs-9 mb-0">
                <thead>
                  <tr>
                    <th class="white-space-nowrap fs-9 align-middle ps-0">
                      <div class="form-check mb-0 fs-8"><input class="form-check-input" id="checkbox-bulk-members-select" type="checkbox" data-bulk-select='{"body":"members-table-body"}'></div>
                    </th>
                    <th class="sort align-middle" scope="col" data-sort="customer" style="width:15%; min-width:200px;">USUARIO</th>
                    <th class="sort align-middle" scope="col" data-sort="email" style="width:15%; min-width:200px;">CORREO</th>
                    <th class="sort align-middle pe-3" scope="col" data-sort="mobile_number" style="width:20%; min-width:200px;">NUMERO CELULAR</th>
                    <th class="sort align-middle" scope="col" data-sort="city" style="width:10%;">DNI</th>
                    <th class="sort align-middle" scope="col" data-sort="estadocarnet" style="width:10%;">CARNET</th>
                    <th class="sort align-middle" scope="col" data-sort="joined" style="width:19%;">ESTADO SOAT</th>
                    <th class="sort align-middle " scope="col" data-sort="last_active" style="width:10%;" >ROL</th>
                    <th class="sort align-middle " scope="col" data-sort="fechasoat" style="width:19%; " >FECHA CREACION</th>
                  </tr>
                </thead>
                <tbody class="list" id="members-table-body">
                @foreach ($usuarios as $usuario)
                    
                   
                   
                  <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                    <td class="fs-9 align-middle ps-0 py-3">
                      <div class="form-check mb-0 fs-8">
                        <input class="form-check-input" type="checkbox" 
                        data-bulk-select-row='{"customer":{"avatar":"/team/25.webp","name":"Michael Jenkins"},"email":"jenkins@example.com","mobile":"+3026138829","city":"Philadelphia","lastActive":"12 hours ago","joined":"Oct 3, 8:30 AM"}'></div>
                    </td>
                    <td class="customer align-middle white-space-nowrap"><a class="d-flex align-items-center text-body text-hover-1000" href="#!">
                        
                        @auth

                        <div class="avatar avatar-m">
                          
                          <img class="rounded-circle" src="{{ $usuario->profile_photo_url }}" alt="{{ $usuario->name }}">
                        </div>
                             
                            @endauth
                        <h6 class="mb-0 ms-3 fw-semibold">{{ $usuario->name }}</h6>
                      </a></td>
                    <td class="email align-middle white-space-nowrap"><a class="fw-semibold" href="mailto:jenkins@example.com">{{ $usuario->email }}</a></td>
                    <td class="mobile_number align-middle white-space-nowrap"><a class="fw-bold text-body-emphasis" href="tel:+3026138829">{{ $usuario->celular }}</a></td>
                    <td class="city align-middle white-space-nowrap text-body">{{ $usuario->dni }}</td>
                    {{-- Verificar si el usuario tiene un carnet --}}
                      @if ($usuario->carnet)
                          {{-- Mostrar el estado del carnet si está disponible y aplicar estilo verde --}}
                          <td class="city align-middle white-space-nowrap text-body text-success">
                            <button class="btn btn-phoenix-success me-1 mb-1" data-bs-toggle="modal" id="dni" data-bs-target="#ModalCarnet" type="button" onclick="buscarUsuarioPorDNI('{{ $usuario->dni }}')">Carnet Operacional</button></td>
                      @else
                          {{-- Mostrar otro contenido si el usuario no tiene un carnet y aplicar estilo rojo --}}
                          <td class="city align-middle white-space-nowrap text-body text-danger"><button class="btn btn-phoenix-danger me-1 mb-1" type="button">No carnet</button></td>
                      @endif
                      <td class="joined align-middle white-space-nowrap text-body">
    @if($usuario->carnet)
        @php
            // Obtener la fecha actual y la fecha de vencimiento del SOAT
            $fechaActual = now();
            $fechaVencimiento = \Carbon\Carbon::parse($usuario->carnet->fecha_soat);
            
            // Calcular la diferencia en días entre la fecha de vencimiento y la fecha actual
            $diferenciaDias = $fechaActual->diffInDays($fechaVencimiento);

            // Definir la clase CSS según el estado del SOAT
            $claseCSS = '';
            if ($fechaActual > $fechaVencimiento) {
                $claseCSS = 'text-danger'; // SOAT vencido, texto en rojo
            } elseif ($diferenciaDias <= 7) {
                $claseCSS = 'text-warning'; // SOAT vigente con menos de 7 días restantes, texto en amarillo
            } else {
                $claseCSS = 'text-success'; // SOAT vigente, texto en verde
            }
        @endphp

        <span class="{{ $claseCSS }}">
            @if($fechaActual > $fechaVencimiento)
                SOAT vencido
            @elseif($diferenciaDias <= 7)
                SOAT vigente - {{ $diferenciaDias }} días restantes
            @else
                SOAT vigente
            @endif
        </span>
    @else
        Sin información de SOAT
    @endif
</td>




                    @if($usuario->acceso_id == 1)  
                    <td class="last_active align-middle white-space-nowrap text-body">ADMIN</td>

                    
                    @else 
                    <td class="last_active align-middle white-space-nowrap text-body">SOCIO</td>

                    @endif

                    @if($usuario->carnet)
                    <td class="fechasoat align-middle white-space-nowrap text-body">{{ $usuario->carnet->created_at }}</td>
                    @else
                    <td class="fechasoat align-middle white-space-nowrap text-body">No carnet</td>

                    @endif
                  </tr>
                @endforeach
                  
                
                  
                 
                </tbody>
              </table>
            </div>
            <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
              <div class="col-auto d-flex">
                <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p><a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
              </div>
              <div class="col-auto d-flex"><button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                <ul class="mb-0 pagination"></ul><button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer position-absolute">
          <div class="row g-0 justify-content-between align-items-center h-100">
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 mt-2 mt-sm-0 text-body">Thank you for creating with Phoenix<span class="d-none d-sm-inline-block"></span><span class="d-none d-sm-inline-block mx-1">|</span><br class="d-sm-none">2023 &copy;<a class="mx-1" href="https://themewagon.com">Themewagon</a></p>
            </div>
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 text-body-tertiary text-opacity-85">v1.14.0</p>
            </div>
          </div>
        </footer>
              
        <script>
 function evaluarCriterios() {
  const hints = document.querySelectorAll('#hs-strong-password-hints li');
  const passwordInput = document.getElementById('hs-strong-password-with-indicator-and-hint');

  const passwordValue = passwordInput.value.trim();
  const isEmpty = passwordValue === '';

  const regexLowercase = /[a-z]/;
  const regexUppercase = /[A-Z]/;
  const regexNumbers = /[0-9]/;
  const regexSpecialChars = /[^A-Za-z0-9]/;

  const containsLowercase = regexLowercase.test(passwordValue);
  const containsUppercase = regexUppercase.test(passwordValue);
  const containsNumbers = regexNumbers.test(passwordValue);
  const containsSpecialChars = regexSpecialChars.test(passwordValue);

  let isValid = true; // Variable para verificar si todas las condiciones son válidas

  hints.forEach(hint => {
    const checkIcon = hint.querySelector('[data-check]');
    const uncheckIcon = hint.querySelector('[data-uncheck]');
    const ruleText = hint.getAttribute('data-hs-strong-password-hints-rule-text');

    switch (ruleText) {
      case 'min-length':
        actualizarEstado(hint, !isEmpty && passwordValue.length >= 6, checkIcon, uncheckIcon);
        break;
      case 'lowercase':
        actualizarEstado(hint, containsLowercase, checkIcon, uncheckIcon);
        break;
      case 'uppercase':
        actualizarEstado(hint, containsUppercase, checkIcon, uncheckIcon);
        break;
      case 'numbers':
        actualizarEstado(hint, containsNumbers, checkIcon, uncheckIcon);
        break;
      case 'special-characters':
        actualizarEstado(hint, containsSpecialChars, checkIcon, uncheckIcon);
        break;
      default:
        break;
    }

    // Si alguna condición no se cumple, establece isValid como falso
    if (!hint.classList.contains('text-green-500')) {
      isValid = false;
    }
  });

  // Deshabilitar el botón "Registrar Usuario" si no se cumplen todas las condiciones
  const btnRegistrar = document.getElementById('btn-registrar');
  if (btnRegistrar) {
    btnRegistrar.disabled = !isValid;
  }
}

function actualizarEstado(elemento, esValido, checkIcon, uncheckIcon) {
  if (esValido) {
    elemento.classList.remove('text-red-500');
    elemento.classList.add('text-green-500');
    if (checkIcon) checkIcon.classList.remove('hidden');
    if (uncheckIcon) uncheckIcon.classList.add('hidden');
  } else {
    elemento.classList.remove('text-green-500');
    elemento.classList.add('text-red-500');
    if (checkIcon) checkIcon.classList.add('hidden');
    if (uncheckIcon) uncheckIcon.classList.remove('hidden');
  }
}

window.addEventListener('load', evaluarCriterios);
document.getElementById('hs-strong-password-with-indicator-and-hint').addEventListener('input', evaluarCriterios);
evaluarCriterios(); // Llamada adicional para asegurar que todos los elementos comiencen en el estado no verificado
</script>
    
@endsection

