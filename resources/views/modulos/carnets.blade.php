@extends('layouts.admin')
@section('script')
<script src="{{ asset('carga/dni.js') }}"></script>
<script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-firestore-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-auth-compat.js"></script>

    <!-- Agrega tu script personalizado -->
    <script type="module" src="{{ asset('carga/firebase.js') }}"></script>

@endsection
@section('contenidoprincipal')
@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <nav class="mb-2" aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active">Carnet Operacional</li>
          </ol>
        </nav>
        <form id="miFormulario" class="mb-9" method="POST" action="{{ route('carnet') }}" enctype="multipart/form-data">
    @csrf
    <div class="row g-3 flex-between-end mb-5">
        <div class="col-auto">
            <h2 class="mb-2">CARNET OPERACIONAL</h2>
        </div>
    </div>
    <div class="row g-5">
        <div class="col-12 col-xl-8">
            <h4 class="mb-3">DNI</h4>
            <input class="form-control mb-5" type="text" id="dni" placeholder="Ingrese Numero de Documento" required>
            <div id="alertadni" class="alert alert-outline-danger invalid-feedback" role="alert">DNI REGISTRADO</div>
            <h4 class="mb-3">GREMIO</h4>
            <input class="form-control mb-5" type="text" id="gremio" name="gremio" value="Nueva Juventud"  placeholder="Ingrese Gremio" required>


            <h4 class="mb-3">SOCIO</h4>
            <input class="form-control mb-5" type="text" id="socio" placeholder="Ingrese nombre del socio" disabled>
            <input class="form-control mb-5" type="text" id="id" name="user_id" style="display: none;" >
            <input class="form-control mb-5" type="text" id="apellidom" name="apellidom" style="display: none;" >
            <input class="form-control mb-5" type="text" id="apellidop" name="apellidop" style="display: none;" >
            <input class="form-control mb-5" type="text" id="nombresfinal" name="nombresfinal" style="display: none;" >


              <h4  <h4 class="mb-3">FECHA_VENC_SOAT</h4>
            <input class="form-control mb-5" type="date" placeholder="" name="fechasoat" required>
            <h4 class="mb-3">N° PLACA</h4>
            <input class="form-control mb-5" id="placanumero" type="text" name="placanumero" placeholder="Ingresa placa" required>
            <h4 class="mb-3">PDF</h4>
            <input class="form-control mb-3" type="file" name="pdf" accept=".pdf" required>
            <h4 class="mb-3">FOTO CARNET</h4>
            <input class="form-control mb-3" type="file" id="fotocarnet" name="fotocarnet" accept=".jpg" required>

            <input class="form-control mb-5" type="text" placeholder="" name="estado" value="1" style="display: none;">

            <button id="enviarcarnet" class="btn btn-primary" type="submit">Enviar</button>
        </div>
    </div>
</form>

        <footer class="footer position-absolute">
          <div class="row g-0 justify-content-between align-items-center h-100">
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 mt-2 mt-sm-0 text-body">Gracias por crear con CODE-IZI-_<span class="d-none d-sm-inline-block"></span><span class="d-none d-sm-inline-block mx-1">|</span><br class="d-sm-none">2024 ©<a class="mx-1" href="#">UNAMAD</a></p>
            </div>
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 text-body-tertiary text-opacity-85">v1.14.0</p>
            </div>
          </div>
        </footer>
      
              

    
@endsection

