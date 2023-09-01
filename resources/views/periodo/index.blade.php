
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
            <h1 class="m-0">Asignaturas</h1>
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
                    <a class="btn btn-success" href="{{ url('course/create/') }}">Crear asignatura</a>
                    @csrf
                </div><br>

                <!-- Listar Asignaturas -->
                <table id="users" class="table table-bordered table-striped rounded">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Asignatura</th>
                            <th>Profesor</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($periodos as $periodo)
                        <tr>
                            <td> {{$periodo->code}} </td>
                            <td> {{$periodo->name}} </td>
                            <td> {{$periodo->teacher->user->name}} {{$periodo->teacher->user->lastname}} </td>
                            @if ($periodo->status=='ACTIVA')
                                <td><span class="btn btn-block btn-success btn-sm ">{{$periodo->status}}</span> </td>
                            @elseif ($evaluation->status=='INACTIVA')
                            <td><span class="btn btn-block btn-secondary btn-sm">{{$periodo->status}}</span> </td>
                            @endif
                            <td>
                                <div class="row">
                                    <!-- Mostrar -->
                                    <div class="col-sm">
                                        <a href="{{ url('/course/'. $periodo->id )}}" class="btn btn-default">
                                            @csrf
                                            <i class="fa fa-eye" style='color: black'></i>
                                            <!-- <input type="submit" name='show' value="show"> -->
                                        </a>
                                    </div>
                                    <!-- Editar -->
                                    <div class="col-sm">
                                        <a href="{{ url('/course/'. $periodo->id . '/edit/' ) }}" class="btn btn-info">
                                            <i class="fa fa-pencil-alt" style='color: white'></i>
                                            <!-- <input type="submit" name='edit' value="edit"> -->
                                        </a>
                                    </div>
                                    
                                    <!-- Borrar -->
                                    <div class="col-sm">
                                        <form action="{{ url('/course/'. $periodo->id) }}" method="POST">
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
                            <th>Código</th>
                            <th>Asignatura</th>
                            <th>Profesor</th>
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