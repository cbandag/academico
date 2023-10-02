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
                            <th colspan='3'>Función docente (Horas)</th>
                            <th rowspan='2'>Observ.</th>
                            <th colspan='3'>Asignacion de clases</th>
                            <th rowspan='2'>Total</th>

                            <th rowspan='2'>Estado</th>
                            <th rowspan='2'>Editar</th>
                        </tr>
                        <tr>
                            <th>Nombres</th>
                            <th>Dedicac.</th>
                            <th>Hrs</th>
                            <th>Funciones</th>
                            <th>Inv.</th>
                            <th>%</th>
                            <th>Ext.</th>
                            <th>%</th>
                            <th>Total</th>
                            <th>Rest.</th>
                            <th>Soporte</th>
                            <th>Clases</th>
                            <th>Prep.</th>
                            <th>Estud.</th>
                            <th>Asig.</th>
                            <th>Programa</th>
                            <th>Hrs</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($asignaciones as $asignacion)
                        <tr>
                            <td> <small>{{$asignacion->user->nombres}} {{$asignacion->user->apellidos}}</small> </td>
                            <td> <small>{{$asignacion->dedicacion=('40'?'TIEMPO COMPLETO':($asignacion->dedicacion='20'?'MEDIO TIEMPO':''))}} </small></td>
                            <td> {{$asignacion->horas_dedicacion}}</td>
                            <td>
                                @foreach($asignacion->funcion as $funcion)
                                 <small>{{$funcion->funcion}}</br></small>
                                @endforeach

                            </td>
                            <td> {{$asignacion->descarga_investigacion}} </td>
                            <td> {{100*$asignacion->porcentaje_investigacion}} </td>
                            <td> {{$asignacion->descarga_extension}} </td>
                            <td> {{100*$asignacion->porcentaje_extension}} </td>
                            <td> {{$asignacion->total_descargas}} </td>
                            <td> {{$asignacion->horas_restantes}} </td>
                            <td> {{$asignacion->soporte}} </td>
                            <td> {{$asignacion->horas_clases}} </td>
                            <td> {{$asignacion->horas_preparacion}} </td>
                            <td> {{$asignacion->horas_estudiantes}} </td>
                            <td> {{$asignacion->observaciones}} </td>

                            <td>
                                @foreach ($asignacion->asignaturas as  $asignatura)
                                <small>{{substr($asignatura->asignatura,0,10)}}</small><br>
                                @endforeach
                            </th>
                            <td>
                                @foreach ($asignacion->asignaturas as  $asignatura)
                                <small>{{substr($asignatura->programa,0,12)}} </small><br>
                                @endforeach
                            </th>
                            <td>
                                @foreach ($asignacion->asignaturas as  $asignatura)
                                <small>{{$asignatura->horas}}</small><br>
                                @endforeach
                            </th>
                            <td>{{$asignacion->horas_docencia}}</th>


                            @if ($asignacion->estado=='LISTO')
                                <td><span class="btn btn-block btn-success btn-sm ">{{$asignacion->estado}}</span> </td>
                            @elseif ($asignacion->estado=='PENDIENTE')
                            <td><span class="btn btn-block btn-secondary btn-sm">Pend.</span> </td>
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
                            <th>Dedicac.</th>
                            <th>Hrs</th>
                            <th>Funciones</th>
                            <th>Inv.</th>
                            <th>%</th>
                            <th>Ext.</th>
                            <th>%</th>
                            <th>Total</th>
                            <th>Rest.</th>
                            <th>Soporte</th>
                            <th>Clases</th>
                            <th>Prep.</th>
                            <th>Estud.</th>
                            <th>Observ.</th>
                            <th>Asig.</th>
                            <th>Programa</th>
                            <th>Hrs</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Editar</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div><!-- card-body -->




    </section>
</div>





@endsection
