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
            <h1 class="m-0">DOCENTES</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header row">
                <div class="form-group col-3">
                    <form action="{{ url('/jefes/import/') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name='documento' id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Escoger archivo</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit">Importar Jefes</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="form-group col-2">
                    <a class="btn btn-success" href="{{ url('/docentes/export/') }}">Exportar Jefes</a>
                    @csrf
                </div>
                <div class="form-group col-3">
                    <form action="{{ url('/docentes/import/') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name='documento' id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Escoger archivo</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit">Importar Docentes</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="form-group col-2">
                    <a class="btn btn-success" href="{{ url('/docentes/export/') }}">Exportar Docentes</a>
                    @csrf
                </div>

                <div class="form-group col-2">
                    <div class="form-group">
                        <form class="row "  action="{{ route('asignaciones.año') }}" method="POST">
                            @csrf
                            <select class="form-control col-7" name="año_periodo_seleccionado" id="año_periodo_seleccionado">
                                @foreach ($años_periodos as $año_periodo)
                                <option type="text" class="form-control" value="{{$año_periodo->año}}-{{$año_periodo->periodo}}"
                                    {{$año_periodo->año==$año && $año_periodo->periodo==$periodo?'selected':''}}>
                                    {{$año_periodo->año}} - 0{{$año_periodo->periodo}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append col-5     ">
                                <button class="btn btn-success " type="submit">Mostrar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


            <div class="card-body">

                <!-- Agregar Curso-->
                <div class="card-body">
                    <div class="box-title">
                        <a class="btn btn-success" href="{{ url('/'.$route.'/create/') }}">Añadir docente</a>
                        @csrf
                    </div><br>

                    <!-- Listar Asignaturas -->
                    <table id="users" class="table table-bordered table-striped rounded">
                        <thead>
                            <tr>
                                <th>Nombres</th>
                                <th>Identificacion</th>
                                <th>Correo</th>
                                <th>Jefe</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td> {{$user->nombres}} {{$user->apellidos}} </td>
                                <td> {{$user->identificacion}}  </td>
                                <td> {{$user->email}} </td>
                                <td> {{$user->nombres}} {{$user->apellidos}} </td>


                                @if ($user->estado=='ACTIVO')
                                    <td><span class="btn btn-block btn-success btn-sm ">{{$user->estado}}</span> </td>
                                @elseif ($user->estado=='INACTIVO')
                                    <td><span class="btn btn-block btn-secondary btn-sm">{{$user->estado}}</span> </td>
                                @endif
                                <td>
                                    <div class="row">
                                        <!-- Mostrar -->
                                        <div class="col-sm">
                                            <a href="{{ url('/'.$route.'/'. $user->id )}}" class="btn btn-default">
                                                @csrf
                                                <i class="fa fa-eye" style='color: black'></i>
                                                <!-- <input type="submit" name='show' value="show"> -->
                                            </a>
                                        </div>
                                        <!-- Editar -->
                                        <div class="col-sm">
                                            <a href="{{ url('/'.$route.'/'. $user->id . '/edit/' ) }}" class="btn btn-info">
                                                <i class="fa fa-pencil-alt" style='color: white'></i>
                                                <!-- <input type="submit" name='edit' value="edit"> -->
                                            </a>
                                        </div>

                                        <!-- Borrar -->
                                        <div class="col-sm">
                                            <form action="{{ url('/'.$route.'/'. $user->id) }}" method="POST">
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
                                <th>Nombres</th>
                                <th>Correo</th>
                                <th>Identificacion</th>
                                <th>Jefe</th>
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
