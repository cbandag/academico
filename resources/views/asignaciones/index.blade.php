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

            @can('asignaciones.index')
                <h1 class="m-0">Asignaciones {{isset($año) && isset($periodo)? $año .' - 0'. $periodo : ''}}</h1>
            @endcan





        </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">


                    <div class="form-group col-6 ">
                        @if($siPeriodoActivo == true)
                        <form class="form-group  row "  action="{{ route('asignaciones.año') }}" method="POST">
                            @csrf
                            <select class="form-control col-6" name="año_periodo_seleccionado" id="año_periodo_seleccionado">
                                @foreach ($periodos as $periodo)
                                <option type="text" class="form-control" value="{{$periodo->año}}-{{$periodo->periodo}}"
                                    {{$periodo->año==$periodoActual->año && $periodo->periodo==$periodoActual->periodo?'selected':''}}>
                                    {{$periodo->año}}-{{$periodo->periodo}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append col">
                                <button class="btn btn-success " type="submit">Mostrar</button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>


            <div class="card-body">
                 <!-- Listar Asignaturas -->
                <table id="users" class="table table-sm table-bordered table-striped rounded">
                    <thead>
                        <tr>
                            @hasanyrole('planeacion|admin')
                            <th rowspan="2">JEFE </th>
                            @endhasanyrole
                            <th colspan='4'>INFORMACIÓN DOCENTE</th>
                            <th colspan='6'>DESCARGAS (Hrs.)</th>
                            <th colspan='3'>FUNCION DOCENTE (Hrs.)</th>
                            @can('planes.index')
                                <th colspan='2'>AJUSTE</th>
                            @endcan
                            <th rowspan='2'>Observaciones</th>
                            <th colspan='4'>Asignacion de clases</th>

                            <th rowspan='2'>Estado</th>
                            <th rowspan='2'>Editar</th>
                        </tr>
                        <tr>
                            <th>Nombres</th>
                            <th>Dedicac.</th>
                            <th>Hrs.</th>
                            <th>Funciones</th>
                            <th>Inv.</th>
                            <th>%</th>
                            <th>Ext.</th>
                            <th>%</th>
                            <th>Total</th>
                            <th>Rest.</th>

                            <th>Clases</th>
                            <th>Prep.</th>
                            <th>Estud.</th>
                            @can('planes.index')
                                <th>Prep.</th>
                                <th>Estud.</th>
                            @endcan
                            <th>Asignatura</th>
                            <th>Programa</th>
                            <th>Hrs</th>
                            <th>Total</th>


                        </tr>
                    </thead>

                    <tbody>
                    @foreach($asignaciones as $asignacion)
                        <tr>
                            @hasanyrole('planeacion|admin')
                            <td class="{{isset($asignacion->jefe->nombres) ? '':'p-3 mb-2 bg-warning text-dark'}}"> <small>{{isset($asignacion->jefe->nombres) ? $asignacion->jefe->nombres.' '.$asignacion->jefe->apellidos:''}}</small> </td>
                            @endhasanyrole
                            <td> <small>{{$asignacion->docente->nombres}} {{$asignacion->docente->apellidos}}</small> </td>
                            <td> <small>
                                @if($asignacion->horas_dedicacion=='20')
                                {{'M. TIEMPO'}}
                                @elseif($asignacion->horas_dedicacion=='40')
                                {{'T. COMPLETO'}}
                                @endif
                                </small></td>
                            <td class="text-center"> {{$asignacion->horas_dedicacion}}h</td>
                            <td>
                                @foreach($asignacion->funcion as $key => $funcion)
                                 <small><a href="{{ route('asignaciones.downloadFuncion',['asignacion_id' => $asignacion->id ,'funcion_id' => $funcion->id]) }}">{{$key+1}}. {{$funcion->funcion}} - {{$funcion->descarga *100 }}%</a></br></small>
                                @endforeach

                            </td>
                            <td class="text-center"> <b>{{$asignacion->descarga_investigacion}}</b></td>
                            <td class="text-center"> {{$asignacion->porcentaje_investigacion*100}}%</td>
                            <td class="text-center"> <b>{{$asignacion->descarga_extension}}</b> </td>
                            <td class="text-center"> {{$asignacion->porcentaje_extension*100}}%</td>
                            <td class="text-center"> {{$asignacion->total_descargas*100}}%</td>
                            <td class="text-center"> {{$asignacion->horas_restantes!==null ? $asignacion->horas_restantes.'h':''}} </td>

                            <td class="text-center"> <b>{{$asignacion->horas_clases}}</b> </td>
                            <td class="text-center"> {{$asignacion->horas_preparacion}} </td>
                            <td class="text-center"> {{$asignacion->horas_estudiantes}} </td>
                            @can('planes.index')
                            <td class="text-center"> {{$asignacion->horas_preparacion_ajustada}}</td>
                            <td class="text-center"> {{$asignacion->horas_estudiantes_ajustada}}</td>
                            @endcan
                            <td> {{$asignacion->observaciones}} </td>

                            <td>
                                @foreach ($asignacion->asignaturas as  $asignatura)
                                <small>{{$asignatura->asignatura}}</small><br>
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

                            <td  class="text-center"><b>{{$asignacion->horas_docencia}}</b>
                                <b>({{$asignacion->horas_docencia -$asignacion->horas_clases}})</b>
                            </th>




                            @if ($asignacion->estado=='APROBADO')
                                <td><span class="btn btn-block btn-success btn-sm ">{{$asignacion->estado}}</span> </td>
                            @elseif ($asignacion->estado=='PENDIENTE')
                            <td><span class="btn btn-block btn-secondary btn-sm">Pendiente</span> </td>
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
                                    <!-- Editar -->
                                    <div class="col-sm">
                                        <a href="{{ url('/asignaciones/'. $asignacion->id . '/importasignaturas/' ) }}" class="btn btn-info">
                                            <i class="fa fa-undo" style='color: white'></i>

                                            <!-- <input type="submit" name='refresh' value="refresh"> -->
                                        </a>
                                    </div>

                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            @hasanyrole('planeacion|admin')
                            <th>JEFE </th>
                            @endhasanyrole
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

                            <th>Clases</th>
                            <th>Prep.</th>
                            <th>Estud.</th>
                            @can('planes.index')
                            <th>Prep.</th>
                            <th>Estud.</th>
                            @endcan
                            <th>Observ.</th>
                            <th>Asignatura</th>
                            <th>Programa</th>
                            <th>Hrs</th>
                            <th>Total</th>

                            <th>Estado</th>
                            <th>Editar</th>
                        </tr>
                    </tfoot>
                </table>

            </div>





    </section>
</div>





@endsection
