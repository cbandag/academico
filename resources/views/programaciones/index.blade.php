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
            <h1 class="m-0">Programaciones</h1>
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
                    <a class="btn btn-success" href="{{ url('/programaciones/docentes/') }}">Importar Docentes</a>
                    @csrf
                </div><br>

                <!-- Listar Programacion -->
                <table id="users" class="table table-bordered table-striped rounded">
                    <thead>
                        <tr>
                            <th>Codigo programa</th>
                            <th>Programa</th>
                            <th>Codigo materia</th>
                            <th>Materia</th>
                            <th>grupo</th>
                            <th>semestre</th>
                            <th>tipo</th>
                            <th>ide</th>
                            <th>nombres</th>
                            <th>apellidos</th>
                            <th>npqprf</th>
                            <th>semanas</th>
                            <th>horas</th>
                            <th>creditos</th>
                            <th>año</th>
                            <th>periodo</th>  
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($programaciones as $programacion)
                        <tr>
                            <td>{{$programacion->codigo_programa}}</td>
                            <td>{{$programacion->programa}}</td>
                            <td>{{$programacion->codigo_materia}}</td>
                            <td>{{$programacion->materia}}</td>
                            <td>{{$programacion->grupo}}</td>
                            <td>{{$programacion->semestre}}</td>
                            <td>{{$programacion->tipo}}</td>
                            <td>{{$programacion->ide}}</td>
                            <td>{{$programacion->nombres}}</td>
                            <td>{{$programacion->apellidos}}</td>
                            <td>{{$programacion->npqprf}}</td>
                            <td>{{$programacion->semanas}}</td>
                            <td>{{$programacion->horas}}</td>
                            <td>{{$programacion->creditos}}</td>
                            <td>{{$programacion->año}}</td>
                            <td>{{$programacion->periodo}}</th>

                            <td>
                                <div class="row">
                                    <!-- Mostrar -->
                                    <div class="col-sm">
                                        <a href="{{ url('/programaciones/'. $programacion->id )}}" class="btn btn-default">
                                            @csrf
                                            <i class="fa fa-eye" style='color: black'></i>
                                            <!-- <input type="submit" name='show' value="show"> -->
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Codigo programa</th>
                            <th>Programa</th>
                            <th>Codigo materia</th>
                            <th>Materia</th>
                            <th>grupo</th>
                            <th>semestre</th>
                            <th>tipo</th>
                            <th>ide</th>
                            <th>nombres</th>
                            <th>apellidos</th>
                            <th>npqprf</th>
                            <th>semanas</th>
                            <th>horas</th>
                            <th>creditos</th>
                            <th>año</th>
                            <th>periodo</th>  
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
                </br></br>

                <!-- Listar Docentes -->
                <table id="users" class="table table-bordered table-striped rounded">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Ide</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Npqprf</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($docentes as $docente)
                        <tr>
                            
                            <td>{{$docente->tipo}}</td>
                            <td>{{$docente->ide}}</td>
                            <td>{{$docente->nombres}}</td>
                            <td>{{$docente->apellidos}}</td>
                            <td>{{$docente->npqprf}}</td>

                            <td>
                                <div class="row">
                                    <!-- Mostrar -->
                                    <div class="col-sm">
                                        <a href="{{ url('/programaciones/'. $programacion->id )}}" class="btn btn-default">
                                            @csrf
                                            <i class="fa fa-eye" style='color: black'></i>
                                            <!-- <input type="submit" name='show' value="show"> -->
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>tipo</th>
                            <th>ide</th>
                            <th>nombres</th>
                            <th>apellidos</th>
                            <th>npqprf</th> 
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
                </br></br>

                <!-- Listar Asignaturas -->
                <table id="users" class="table table-bordered table-striped rounded">
                    <thead>
                        <tr>
                            <th>Ide</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Npqprf</th>
                            <th>Semanas</th>
                            <th>Horas</th>
                            <th>Créditos</th>
                            <th>Año</th>
                            <th>Periodo</th>  
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($programaciones as $programacion)
                        <tr>
                            <td>{{$programacion->ide}}</td>
                            <td>{{$programacion->nombres}}</td>
                            <td>{{$programacion->apellidos}}</td>
                            <td>{{$programacion->npqprf}}</td>
                            <td>{{$programacion->semanas}}</td>
                            <td>{{$programacion->horas}}</td>
                            <td>{{$programacion->creditos}}</td>
                            <td>{{$programacion->año}}</td>
                            <td>{{$programacion->periodo}}</th>

                            <td>
                                <div class="row">
                                    <!-- Mostrar -->
                                    <div class="col-sm">
                                        <a href="{{ url('/programaciones/'. $programacion->id )}}" class="btn btn-default">
                                            @csrf
                                            <i class="fa fa-eye" style='color: black'></i>
                                            <!-- <input type="submit" name='show' value="show"> -->
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Ide</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Npqprf</th>
                            <th>Semanas</th>
                            <th>Horas</th>
                            <th>Creditos</th>
                            <th>Año</th>
                            <th>Periodo</th>  
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
                </br></br>

            </div>
        </div><!-- card-body -->


    </section>
</div>

    



@endsection