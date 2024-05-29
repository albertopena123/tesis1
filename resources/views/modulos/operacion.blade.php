@extends('layouts.admin')

@section('contenidoprincipal')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(!$estadoTrue)
    <nav class="mb-2" aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#!">Modulos</a></li>
            <li class="breadcrumb-item active">Operacion</li>
          </ol>
        </nav>
        <h2 class="mb-7">Operacion Anual</h2>
        <form method="POST" action="{{ route('operacion') }}">
        @csrf

        <div class="row g-7 g-lg-11 mb-7">
          <div class="col-12 col-sm-6 col-xxl-3">
            <!-- need to check PricingCard text-whites--><img class="mb-4 d-dark-none" src="../../assets/img/spot-illustrations/13.png" alt="" width="120" height="96"><img class="mb-4 d-light-none" src="../../assets/img/spot-illustrations/dark_13.png" alt="" width="120" height="96">
            <div class="mb-sm-5 pricing-column-title-box">
              <h3 class="mb-2">Descripcion</h3>
              <p class="text-body-secondary mb-0 pe-3">Ingrese una Descripcion del plan Operacion  Anual</p>
            </div>
         
            
            <input class="btn btn-lg w-100 mb-6 btn-outline-primary" name="descripcion" placeholder="Ingrese Descripcion">   
           
          </div>
          <div class="col-12 col-sm-6 col-xxl-3">
            <!-- need to check PricingCard text-whites--><img class="mb-4 d-dark-none" src="../../assets/img/spot-illustrations/14.png" alt="" width="120" height="96"><img class="mb-4 d-light-none" src="../../assets/img/spot-illustrations/dark_14.png" alt="" width="120" height="96">
            <div class="mb-sm-5 pricing-column-title-box">
              <h3 class="mb-2">Año </h3>
              <p class="text-body-secondary mb-0 pe-3">Ingresar el año del plan operacion anual</p>
            </div>
            <input class="btn btn-lg w-100 mb-6 btn-outline-primary" name="año" placeholder="Ingresar el año" value="2024" disabled>
            
          </div>
          <div class="col-12 col-sm-6 col-xxl-3">
            <!-- need to check PricingCard text-whites--><img class="mb-4 d-dark-none" src="../../assets/img/spot-illustrations/15.png" alt="" width="120" height="96"><img class="mb-4 d-light-none" src="../../assets/img/spot-illustrations/dark_15.png" alt="" width="120" height="96">
            <div class="mb-sm-5 pricing-column-title-box">
              <h3 class="mb-2">Gremio</h3>
              <p class="text-body-secondary mb-0 pe-3">Nombre del Gremio de la Operacion Anual.</p>
            </div>
            <input class="btn btn-lg w-100 mb-6 btn-primary" name="gremio_id" value="NUEVA JUVENTUD" disabled>
           
          </div>
          <div class="col-12 col-sm-6 col-xxl-3">
            <!-- need to check PricingCard text-whites--><img class="mb-4 d-dark-none" src="../../assets/img/spot-illustrations/16.png" alt="" width="120" height="96"><img class="mb-4 d-light-none" src="../../assets/img/spot-illustrations/dark_16.png" alt="" width="120" height="96">
            <div class="mb-sm-5 pricing-column-title-box">
              <h3 class="mb-2">Dar Inicio</h3>
              <p class="text-body-secondary mb-0 pe-3">Inciar el Plan Operacion Anual</p>
            </div>
          <button class="btn btn-lg w-100 mb-6 btn-outline-primary" type="submit">Crear Operacion</button>
          
          </div>
        </div>
        </form>
    @else
      <section class="bg-body-emphasis pb-8" id="home">
        <div class="container-small hero-header-container px-lg-7 px-xxl-3">
          <div class="row align-items-center">
            <div class="col-12 col-lg-auto order-0 order-md-1 text-end order-1">
              <div class="position-relative p-5 p-md-7 d-lg-none">
                <div class="bg-holder" style="background-image:url(../../assets/img/bg/bg-23.png);background-size:contain;"></div>
                <!--/.bg-holder-->
              </div>
              <div class="hero-image-container position-absolute top-0 bottom-0 end-0 d-none d-lg-block">
                <div class="position-relative h-100 w-100">
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 text-lg-start text-center pt-8 pb-6 order-0 position-relative">
              <h1 class="fs-3 fs-lg-2 fs-md-1 fs-lg-2 fs-xl-1 fs fw-black mb-4"><span class="text-primary me-3">PLAN OPERACIONAL</span>CREADO<br>2024</h1>
              <p class="mb-5">"¡Bienvenido al plan operacional creado en 2024! Por favor, comuníquese con el administrador para obtener más detalles y orientación sobre su implementación. Su colaboración es crucial para el éxito de nuestras operaciones. ¡Gracias!"</p>
            </div>
          </div>
        </div>
      </section>
    @endif
       
        <footer class="footer position-absolute">
          <div class="row g-0 justify-content-between align-items-center h-100">
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 mt-2 mt-sm-0 text-body">Gracias por crear con CodigoIzi<span class="d-none d-sm-inline-block"></span><span class="d-none d-sm-inline-block mx-1">|</span><br class="d-sm-none">2024 ©<a class="mx-1" href="#">UNAMAD</a></p>
            </div>
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 text-body-tertiary text-opacity-85">v1.14.0</p>
            </div>
          </div>
        </footer>

@endsection

