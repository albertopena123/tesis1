@extends('layouts.admin')
@section('contenidoprincipal')

<script >
   
var usuarios = <?php echo json_encode($usuariocarnet); ?>;
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
<div id="usuariosElemento" data-usuarios="{{ json_encode($usuariocarnet) }}"></div>


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
                          <input class="form-control" id="fechasoat" name="fechasoat" type="date" disabled>
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
                     
                      </form>
                    </div>
                      
                      
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>

<!-- FIN DE CARNET DE USUARIOS  -->

<div class="row gy-3 mb-6 justify-content-between">
          <div class="col-md-9 col-auto">
            <h2 class="mb-2 text-body-emphasis">Panel de Gremio de Taxistas

</h2>
            <h5 class="text-body-tertiary fw-semibold">Aquí puedes estar al tanto de los socios en el gremio en tiempo real.</h5>
          </div>
          <div class="col-md-3 col-auto">
            <!-- INICIO DE CARNET -->

            
            <!-- FIN DE CARNET -->
            
        </div>
        <div class="row mb-3 gy-6">
          <div class="col-12 col-xxl-2">
            <div class="row align-items-center g-3 g-xxl-0 h-100 align-content-between">
              <div class="col-12 col-sm-6 col-md-3 col-lg-6 col-xl-3 col-xxl-12">
                <div class="d-flex align-items-center"><span class="fs-4 lh-1 uil uil-books text-primary-dark"></span>
                  <div class="ms-2">
                    <div class="d-flex align-items-end">
                      <h2 class="mb-0 me-2">{{$gremios->count()}}</h2><span class="fs-7 fw-semibold text-body">Gremios</span>
                    </div>
                    <p class="text-body-secondary fs-9 mb-0">De Taxistas</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-3 col-lg-6 col-xl-3 col-xxl-12">
                <div class="d-flex align-items-center"><span class="fs-4 lh-1 uil uil-users-alt text-success-dark"></span>
                  <div class="ms-2">
                    <div class="d-flex align-items-end">
                      <h2 class="mb-0 me-2">{{$usuarios->count()}}</h2><span class="fs-7 fw-semibold text-body">Usuarios</span>
                    </div>
                    <p class="text-body-secondary fs-9 mb-0">Registrados</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-3 col-lg-6 col-xl-3 col-xxl-12">
                <div class="d-flex align-items-center"><span class="fs-4 lh-1 uil uil-invoice text-warning-dark"></span>
                  <div class="ms-2">
                    <div class="d-flex align-items-end">
                      <h2 class="mb-0 me-2">{{$carnets->count()}}</h2><span class="fs-7 fw-semibold text-body">Carnets</span>
                    </div>
                    <p class="text-body-secondary fs-9 mb-0">Operacionales</p>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          
          <div class="col-12 col-xl-6 col-xxl-5">
            <div class="card border h-100 w-100 overflow-hidden">
              <div class="bg-holder d-block bg-card" style="background-image:url(../assets/img/spot-illustrations/32.png);background-position: top right;"></div>
              <!--/.bg-holder-->
              <div class="d-dark-none">
                <div class="bg-holder d-none d-sm-block d-xl-none d-xxl-block bg-card" style="background-image:url(../assets/img/spot-illustrations/21.png);background-position: bottom right; background-size: auto;"></div>
                <!--/.bg-holder-->
              </div>
              <div class="d-light-none">
                <div class="bg-holder d-none d-sm-block d-xl-none d-xxl-block bg-card" style="background-image:url(../assets/img/spot-illustrations/dark_21.png);background-position: bottom right; background-size: auto;"></div>
                <!--/.bg-holder-->
              </div>
              <div class="card-body px-5 position-relative">
                <div class="badge badge-phoenix fs-10 badge-phoenix-warning mb-4"><span class="fw-bold">Con Punche Peru</span><span class="fa-solid fa-award ms-1"></span></div>
                <h3 class="mb-5">ORDENANZA Nº 092-MDMP</h3>
                <p class="text-body-tertiary fw-semibold">DISPOSICIONES COMPLEMENTARIAS, TRANSITORIAS Y FINALES<br class="d-none d-sm-block">Madre de Dios <br class="d-none d-sm-block">Puerto Maldonado. </p>
              </div>
              <div class="card-footer border-0 py-0 px-5 z-1">
                <p class="text-body-tertiary fw-semibold"><br class="d-none d-xxl-block">Año del Bicentenario, de la consolidación de nuestra Independencia, y de la conmemoración de las heroicas batallas de Junín y Ayacucho</p>
              </div>
            </div>
          </div>

          <div class="col-12 col-xl-6 col-xxl-5">
          <button class="btn btn-phoenix-success me-1 mb-1" data-bs-toggle="modal" id="dni" data-bs-target="#ModalCarnet" type="button" onclick="buscarUsuarioPorDNI('{{ $usuario->dni }}')">Carnet Operacional</button></td>
          <div class="d-flex align-items-center mb-3"><a href="../../apps/social/profile.html">
                            <div class="avatar avatar-xl  me-2">
                            <img class="rounded-circle" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                            </div>
                          </a>
                          <div class="flex-1">
                            <a class="fw-bold mb-0 text-body-emphasis" href="{{ route('profile.show') }}">{{$usuario->nombre}}</a>
                            <p class="fs-10 mb-0 text-body-tertiary text-opacity-85 fw-semibold">GREMIO DE TAXISTAS<svg class="svg-inline--fa fa-circle text-body-quaternary text-opacity-50" data-fa-transform="shrink-10 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.625em;"><g transform="translate(256 256)"><g transform="translate(0, 64)  scale(0.375, 0.375)  rotate(0 0 0)"><path fill="currentColor" d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="fa-solid fa-circle text-body-quaternary text-opacity-50" data-fa-transform="shrink-10 down-2"></span> Font Awesome fontawesome.com -->Peru, Puerto Maldonado<svg class="svg-inline--fa fa-circle text-body-quaternary text-opacity-50" data-fa-transform="shrink-10 down-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.625em;"><g transform="translate(256 256)"><g transform="translate(0, 64)  scale(0.375, 0.375)  rotate(0 0 0)"><path fill="currentColor" d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z" transform="translate(-256 -256)"></path></g></g></svg><!-- <span class="fa-solid fa-circle text-body-quaternary text-opacity-50" data-fa-transform="shrink-10 down-2"></span> Font Awesome fontawesome.com --><svg class="svg-inline--fa fa-earth-americas text-body" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="earth-americas" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM57.71 192.1L67.07 209.4C75.36 223.9 88.99 234.6 105.1 239.2L162.1 255.7C180.2 260.6 192 276.3 192 294.2V334.1C192 345.1 198.2 355.1 208 359.1C217.8 364.9 224 374.9 224 385.9V424.9C224 440.5 238.9 451.7 253.9 447.4C270.1 442.8 282.5 429.1 286.6 413.7L289.4 402.5C293.6 385.6 304.6 371.1 319.7 362.4L327.8 357.8C342.8 349.3 352 333.4 352 316.1V307.9C352 295.1 346.9 282.9 337.9 273.9L334.1 270.1C325.1 261.1 312.8 255.1 300.1 255.1H256.1C245.9 255.1 234.9 253.1 225.2 247.6L190.7 227.8C186.4 225.4 183.1 221.4 181.6 216.7C178.4 207.1 182.7 196.7 191.7 192.1L197.7 189.2C204.3 185.9 211.9 185.3 218.1 187.7L242.2 195.4C250.3 198.1 259.3 195 264.1 187.9C268.8 180.8 268.3 171.5 262.9 165L249.3 148.8C239.3 136.8 239.4 119.3 249.6 107.5L265.3 89.12C274.1 78.85 275.5 64.16 268.8 52.42L266.4 48.26C262.1 48.09 259.5 48 256 48C163.1 48 84.4 108.9 57.71 192.1L57.71 192.1zM437.6 154.5L412 164.8C396.3 171.1 388.2 188.5 393.5 204.6L410.4 255.3C413.9 265.7 422.4 273.6 433 276.3L462.2 283.5C463.4 274.5 464 265.3 464 256C464 219.2 454.4 184.6 437.6 154.5H437.6z"></path></svg><!-- <span class="fa-solid fa-earth-americas text-body"></span> Font Awesome fontawesome.com --></p>
                          </div>
                          <div class="btn-reveal-trigger">
                            <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none d-flex btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                <path fill="currentColor" d="M120 256C120 286.9 94.93 312 64 312C33.07 312 8 286.9 8 256C8 225.1 33.07 200 64 200C94.93 200 120 225.1 120 256zM280 256C280 286.9 254.9 312 224 312C193.1 312 168 286.9 168 256C168 225.1 193.1 200 224 200C254.9 200 280 225.1 280 256zM328 256C328 225.1 353.1 200 384 200C414.9 200 440 225.1 440 256C440 286.9 414.9 312 384 312C353.1 312 328 286.9 328 256z"></path></svg><!-- <span class="fas fa-ellipsis-h"></span> Font Awesome fontawesome.com --></button>
                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Report abuse</a></div>
                          </div>
                        </div>
          </div>
        </div>
        <!-- Inicio de imagenes -->
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-7 pb-3 border-y">
    <div class="row">
        <div class="col-12 col-xl-7 col-xxl-6">
            <div class="row g-3 mb-3">
                <div class="col-12 col-md-12 d-flex" style="margin: 0 auto;"> <!-- Aplicamos el estilo de margen auto para centrar horizontalmente -->
                    <a href="#" class="me-3"> <!-- Aumentamos el margen derecho -->
                        <div class="avatar avatar-4xl">
                            <img class="rounded-circle" src="{{ asset('logos/muni.jpg') }}" alt="">
                        </div>
                    </a>
                    <a href="#" class="me-3"> <!-- Aumentamos el margen derecho -->
                        <div class="avatar avatar-4xl">
                            <img class="rounded-circle" src="{{ asset('logos/apiperu.png') }}" alt="">
                        </div>
                    </a>
                    <a href="#" class="me-3"> <!-- Aumentamos el margen derecho -->
                        <div class="avatar avatar-4xl">
                            <img class="rounded-circle" src="{{ asset('logos/logomadre.png') }}" alt="">
                        </div>
                    </a>
                    <a href="#" class="me-3"> <!-- Aumentamos el margen derecho -->
                        <div class="avatar avatar-4xl">
                            <img class="rounded-circle" src="{{ asset('logos/logotransporte.png') }}" alt="">
                        </div>
                    </a>
                    <a href="#" class="me-3"> <!-- Aumentamos el margen derecho -->
                        <div class="avatar avatar-4xl">
                            <img class="rounded-circle" src="{{ asset('logos/punche.jpg') }}" alt="">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Fin de imagenes -->



        
      
        <footer class="footer position-absolute">
          <div class="row g-0 justify-content-between align-items-center h-100">
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 mt-2 mt-sm-0 text-body">Gracias por crear con CodigoIzi<span class="d-none d-sm-inline-block"></span><span class="d-none d-sm-inline-block mx-1">|</span><br class="d-sm-none">2024 &copy;<a class="mx-1" href="https://portal.unamad.edu.pe/">UNAMAD</a></p>
            </div>
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 text-body-tertiary text-opacity-85">v.1</p>
            </div>
          </div>
        </footer>
@endsection

