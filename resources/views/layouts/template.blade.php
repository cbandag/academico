<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ACADÉMICO</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/dropzone/min/dropzone.min.css')}}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0')}}">
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/datatables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

  <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
  <script type="text/javascript" src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/scripts.js')}}"></script>

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Fullscreen
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>-->

      <li class="nav-item">
            <a href="#" class="d-block nav-link">{{Auth::User()->name}} {{Auth::User()->lastname}}</a>
      </li>

      <!-- Logout -->
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">Opciones</a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">Opciones</span>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          <i class="fas fa-arrow-circle-left mr-2"></i>{{ __('Salir') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>

          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer"></a>
        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('home') }}" class="brand-link">
      <img src="{{ asset('dist/img/logo-universidad-blanco.png')}}" alt="AdminLTE Logo" class="img-fluid " style="opacity: .8">
    </a>
    <a href="{{ url('home') }}" class="brand-link">
      <span class="brand-text font-weight-bold"> ACADÉMICO </span><br>
      <h5 class="text-center"> {{Auth::User()->role}} </h5>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!--<div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="image">
          <i class="fa-solid fa-circle-user"></i>
        </div>


        <div class="info">
          <a href="#" class="d-block"></a>

        </div>
      </div>-->

      <!-- SidebarSearch Form
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->



        <!--
          @can('jefes.index')

          <li class="nav-item">
            <a href="{{url('/jefes')}}" class="nav-link">
              <i class="nav-icon fas fa-user" ></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          @endcan

          @can('decanos.index')

          <li class="nav-item">
            <a href="{{url('/decanos')}}" class="nav-link">
              <i class="nav-icon fas fa-user" ></i>
              <p>
                Decanos
              </p>
            </a>
          </li>
          @endcan
        -->

        @can('periodos.index')
          <li class="nav-item">
            <a href="{{url('/periodos')}}" class="nav-link">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>
              Periodos
              </p>
            </a>
          </li>
          @endcan

          @can('docentes.index')

          <li class="nav-item">
            <a href="{{url('/usuarios')}}" class="nav-link">
              <i class="nav-icon fas fa-user" ></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>

          @endcan


<!--
          @can('facultades.index')
          <li class="nav-item">
            <a href="{{url('/facultades')}}" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Facultades
              </p>
            </a>
          </li>
          @endcan



          @can('programas.index')
          <li class="nav-item">
            <a href="{{url('/programas')}}" class="nav-link">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
              Programas
              </p>
            </a>
          </li>
          @endcan
-->



          @can('planes.index')

          <li class="nav-item">
            <a href="{{url('/planes/{}')}}" class="nav-link">

              <i class="nav-icon fas fa-user" ></i>
              <p>
                Planes de trabajo
              </p>
            </a>
          </li>
          @endcan

          @can('asignaciones.index')

          @role('jefe')
                <li class="nav-item">
                    <a href="{{url('/asignaciones/jefe/'.Auth::User()->id.'/')}}" class="nav-link"> <i class="nav-icon fas fa-user" ></i>
                    <p>
                        Mis docentes
                    </p>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{url('/asignaciones')}}" class="nav-link"> <i class="nav-icon fas fa-user" ></i>
                    <p>
                        Asignaciones
                    </p>
                    </a>
                </li>
            @endrole




          @endcan






          @can('programaciones.index')

          <li class="nav-item">
            <a href="{{url('/programaciones')}}" class="nav-link">
              <i class="nav-icon fas fa-user" ></i>
              <p>
                Programaciones (SMA)
              </p>
            </a>
          </li>
          @endcan


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



  <!-- Content Wrapper. Contains page content -->

  @yield('content')

  <!-- /.content-wrapper -->



  <!-- Control Sidebar

  <aside class="control-sidebar control-sidebar-dark"> -->
    <!-- Control sidebar content goes here --> <!--
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  -->
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class=" center-textd-none d-sm-inline">
      Académico
    </div>
    <!-- Default to the left -->
    <strong> Académico &copy; <a href="https://www.unicartagena.edu.co" target="_blank"> Universidad de Cartagena</a>.</strong> Todos los de rechos reservados
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<script src="{{asset('plugins/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js?v=3.2.0')}}"></script>


<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>


<!--bootstrap js CDN
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!--
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}">
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js')}}">
-->


-->
<script>

  /* Funciones Dropdown depending */
/*  function loadOptions(select1, select2, route){
      var ide = select1.val();
      if (ide !=''){
          var promise = $.get(route + '/' + ide +'');
          $.when(promise).done(function (data){
              select2.empty();
              select2.append("<option value=''> Seleccione.. </option>");

              $.each(data, function(index, value){
                  select2.append("<option value='" + index + "'>" + value + "</option>");
              });
          });
      }
  };


  function loadOption(select1, select2, route, route2, id ){
    var ide = select1.val();
    if (ide !=''){
        var promise = $.get( route + '/' + ide +'');
        $.when(promise).done(function (data){
          //console.log(data);
            var promise2 = $.get( id +'/' + route2);
            $.when(promise2).done(function (data2){
              //console.log(data2);
                select2.empty();
                select2.append("<option value=''> Seleccione.. </option>");

                    $.each(data, function(index, value){
                        if(index == data2){
                            select2.append("<option value='" + index + "' selected>" + value + "</option>");
                        }else{
                            select2.append("<option value='" + index + "' >" + value + "</option>");
                        }
                  });
              });
          });
      };
  };
*/


</script>

@yield('course')
@yield('programming')
@yield('student')



</body>
</html>
