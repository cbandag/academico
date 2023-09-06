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
            <h1 class="m-0">Actividades</h1>
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
                    <a class="btn btn-success" href="{{ url('actividades/create/') }}">Añadir actividad</a>
                    @csrf
                </div><br>

                <!-- Listar Asignaturas -->
                <table id="users" class="table table-bordered table-striped rounded">
                    <thead>
                        <tr>
                            <th>periodo</th>
                            <th>docente</th>
                            <th>jefe_inmediato</th>
                            <th>tipo_docente</th>
                            <th>horas_actividad</th>
                            <th>tipo_actividad</th>
                            <th>programa</th>
                            <th>facultad</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($periodos as $actividad)
                        <tr>
                            <td> {{$actividad->actividad}} </td>
                            
                            @if ($actividad->estado=='ACTIVO')
                                <td><span class="btn btn-block btn-success btn-sm ">{{$actividad->estado}}</span> </td>
                            @elseif ($actividad->estado=='INACTIVO')
                            <td><span class="btn btn-block btn-secondary btn-sm">{{$actividad->estado}}</span> </td>
                            @endif
                            <td>
                                <div class="row">
                                    <!-- Mostrar -->
                                    <div class="col-sm">
                                        <a href="{{ url('/actividades/'. $actividad->id )}}" class="btn btn-default">
                                            @csrf
                                            <i class="fa fa-eye" style='color: black'></i>
                                            <!-- <input type="submit" name='show' value="show"> -->
                                        </a>
                                    </div>
                                    <!-- Editar -->
                                    <div class="col-sm">
                                        <a href="{{ url('/actividades/'. $actividad->id . '/edit/' ) }}" class="btn btn-info">
                                            <i class="fa fa-pencil-alt" style='color: white'></i>
                                            <!-- <input type="submit" name='edit' value="edit"> -->
                                        </a>
                                    </div>
                                    
                                    <!-- Borrar -->
                                    <div class="col-sm">
                                        <form action="{{ url('/actividades/'. $actividad->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button  class="btn btn-danger"  type="submit" onclick="return confirm('¿Seguro que quieres borrar?')">
                                                <i class="fa fa-trash" style='color: white'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>periodo</th>
                            <th>docente</th>
                            <th>jefe_inmediato</th>
                            <th>tipo_docente</th>
                            <th>horas_actividad</th>
                            <th>tipo_actividad</th>
                            <th>programa</th>
                            <th>facultad</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div><!-- card-body -->




    </section>
</div>

    



@endsection