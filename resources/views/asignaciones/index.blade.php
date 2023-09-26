@extends('layouts.template')
@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @if(Session::has('message'))
    <div class="card-body">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>{{ Session::get('message') }}</h5>
        </div>
    </div>

    @endif

    @if(count($errors)>0)
    <div class="card-body">
        <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @foreach($errors->all() as $error)
            {{$error}}<br>
        @endforeach
        </div>
    </div>
    @endif


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Asignaciones {{isset($asignaciones->first()->año)? $asignaciones->first()->año - $asignaciones->first()->periodo:''}}</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card">

        <div class="card-body">

            <!-- Agregar Curso-->
            <div class="card-body">
                <div class="box-title">
                    <a class="btn btn-success" href="{{ url('/asignaciones/create/') }}">Añadir asignacion</a>
                    @csrf
                </div><br>

                <!-- Listar Asignaturas -->
                <table id="users" class="table table-sm table-bordered table-striped rounded">
                    <thead>
                        <tr>
                            <th colspan='4'>INFORMACIÓN DOCENTE</th>
                            <th colspan='7'>DESCARGAS</th>
                            <th colspan='3'>Horas clases</th>
                            <th rowspan='2'>Observaciones</th>
                            <th rowspan='2'>Horas docencia</th>
                            <th colspan='3'>Asignacion de clases</th>
                            <th rowspan='2'>Estado</th>
                            <th rowspan='2'>Acciones</th>
                        </tr>
                        <tr>
                            <th>Nombres</th>
                            <th>Dedicación</th>
                            <th>Horas Dedic.</th>
                            <th>% Funciones</th>
                            <th>Investigación</th>
                            <th>%</th>
                            <th>Extensión</th>
                            <th>%</th>
                            <th>Total</th>
                            <th>Horas restantes</th>
                            <th>Soporte</th>
                            <th>Horas clases</th>
                            <th>Horas preparacion</th>
                            <th>Horas estudiantes</th>
                            <th>Asignaturas</th>
                            <th>Programa</th>
                            <th>Horas</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($asignaciones as $asignacion)
                        <tr>
                            <td> {{$asignacion->user->nombres}} {{$asignacion->user->apellidos}} </td>
                            <td> {{$asignacion->dedicacion}} </td>
                            <td> {{$asignacion->horas_dedicacion}} </td>
                            <td> {{$asignacion->porcentaje_total_funciones}} </td>
                            <td> {{$asignacion->descarga_investigacion}} </td>
                            <td> {{$asignacion->porcentaje_investigacion}} </td>
                            <td> {{$asignacion->descarga_extension}} </td>
                            <td> {{$asignacion->porcentaje_extension}} </td>
                            <td> {{$asignacion->total_descargas}} </td>
                            <td> {{$asignacion->horas_restantes}} </td>
                            <td> {{$asignacion->soporte}} </td>
                            <td> {{$asignacion->horas_clases}} </td>
                            <td> {{$asignacion->horas_preparacion}} </td>
                            <td> {{$asignacion->horas_estudiantes}} </td>
                            <td> {{$asignacion->observaciones}} </td>
                            <td>{{$asignacion->horas_docencia}}</th>
                            <td>
                                @foreach ($asignacion->asignaturas as  $asignatura)
                                {{substr($asignatura->asignatura,0,10)}}<br>
                                @endforeach
                            </th>
                            <td>
                                @foreach ($asignacion->asignaturas as  $asignatura)
                                {{substr($asignatura->programa,0,12)}} <br>
                                @endforeach
                            </th>
                            <td>
                                @foreach ($asignacion->asignaturas as  $asignatura)
                                {{$asignatura->horas}}<br>
                                @endforeach
                            </th>


                            @if ($asignacion->estado=='LISTO')
                                <td><span class="btn btn-block btn-success btn-sm ">{{$asignacion->estado}}</span> </td>
                            @elseif ($asignacion->estado=='PENDIENTE')
                            <td><span class="btn btn-block btn-secondary btn-sm">{{$asignacion->estado}}</span> </td>
                            @endif
                            <td>
                                <div class="row">

                                    <!-- Editar -->
                                    <div class="col-sm">
                                        <a href="{{ url('/asignaciones/'. $asignacion->id . '/edit/' ) }}" class="btn btn-info">
                                            <i class="fa fa-pencil-alt" style='color: white'></i>
                                            <!-- <input type="submit" name='edit' value="edit"> -->
                                        </a>
                                    </div>


                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Nombres</th>
                            <th>Dedicación</th>
                            <th>Horas Dedic.</th>
                            <th>%</th>
                            <th>Descarga investigación</th>
                            <th>%</th>
                            <th>Descarga extensión</th>
                            <th>%</th>
                            <th>Total</th>
                            <th>Horas restantes</th>
                            <th>Soporte</th>
                            <th>Horas clases</th>
                            <th>Horas preparacion</th>
                            <th>Horas estudiantes</th>
                            <th>Observaciones</th>
                            <th>Horas docencia</th>
                            <th>Asignaturas</th>
                            <th>Programa</th>
                            <th>Horas</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div><!-- card-body -->




    </section>
</div>





@endsection
