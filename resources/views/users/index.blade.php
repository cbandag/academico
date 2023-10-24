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
                <div class="box-title col-1">
                    <a class="btn btn-success" href="{{ url('/'.$route.'/create/') }}">Añadir docente</a>
                    @csrf
                </div>

                <div class="form-group col-2">
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
                    <a class="btn btn-success" href="{{ url('/jefes/export/') }}">Exportar Jefes</a>
                    @csrf
                </div>

                <div class="form-group col-2">
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

                <!-- Agregar Usuarios-->


                <div class="card-body ">

                    <!-- Listar Jefes -->
                    <div class="row">
                        <div class="card-body  col-5">
                            <table  class="table table-bordered table-striped rounded ">
                            <thead>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Ident.</th>
                                    <th>Correo</th>
                                    <th>Cant.</th>
                                    <th>Ir</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($jefes as $jefe)
                                <tr>
                                    <td> <small>{{explode(" ",$jefe->nombres)[0]}} {{explode(" ",$jefe->apellidos)[0]}} </small></td>
                                    <td>{{$jefe->identificacion}}</td>
                                    <td> <small> {{$jefe->email}} </small></td>



                                    @if ($jefe->estado=='ACTIVO')
                                        <td><span class="btn btn-block btn-success btn-sm ">{{$jefe->estado}}</span> </td>
                                    @elseif ($jefe->estado=='INACTIVO')
                                        <td><span class="btn btn-block btn-secondary btn-sm">{{$jefe->estado}}</span> </td>
                                    @endif
                                    <td>
                                        <div class="row">
                                            <!-- Mostrar -->
                                            <div class="col-sm">
                                                <a href="{{ url('/'.$route.'/'. $jefe->id )}}" class="btn btn-default">
                                                    @csrf
                                                    <i class="fa fa-eye" style='color: black'></i>
                                                    <!-- <input type="submit" name='show' value="show"> -->
                                                </a>
                                            </div>



                                        </div>

                                    </td>
                                    <td>
                                        <div class="row">
                                            <!-- Ir -->
                                            <div class="col-sm">
                                                <a id="idJefe" value="{{ $jefe->id }}" class="btn btn-default" onclick="listarDocentesJefe({{ $jefe->identificacion }})">
                                                    @csrf
                                                    <i class="fa fa-arrow-right" style='color: black'></i>
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
                                    <th>Nombres</th>
                                    <th>Ident.</th>
                                    <th>Correo</th>
                                    <th>Cant.</th>
                                    <th>Ir</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                        <div class="card-body  col-6">
                            <table  class="table table-bordered table-striped rounded "id="listaDocentes">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Ident.</th>
                                        <th>Correo</th>
                                        <th>Jefe</th>
                                    </tr>
                                </thead>


                                <tbody id="tbody">
                                @foreach($docentes as $docente)
                                    <tr class="tr">
                                        <td><small>{{ explode(" ",$docente->nombres)[0]}} {{explode(" ",$docente->apellidos)[0]}} </small></td>
                                        <td> {{$docente->identificacion}} </td>
                                        <td> <small>{{$docente->email}} </small></td>
                                        <td class="{{$docente->identificacion_jefe == null ? 'p-3 mb-2 bg-warning text-dark':''}}">
                                            <small> {{explode(" ",$docente->nombre_jefe)[0]}} {{explode(" ",$docente->apellido_jefe)[0] }}</small></td>


                                        @if ($docente->estado=='ACTIVO')
                                            <td><span class="btn btn-block btn-success btn-sm ">{{$docente->estado}}</span> </td>
                                        @elseif ($docente->estado=='INACTIVO')
                                            <td><span class="btn btn-block btn-secondary btn-sm">{{$docente->estado}}</span> </td>
                                        @endif



                                    </tr>
                                @endforeach
                                </tbody>

                                <tfoot id="tfoot">
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Ident.</th>
                                        <th>Correo</th>
                                        <th>Jefe</th>
                                    </tr>
                                </tfoot>



                            </table>
                        </div>
                    </div>


                </div>
            </div><!-- card-body -->




    </section>
</div>



<script>


   function listarDocentesJefe(e){
    console.log('Listar docentes de identificacion_jefe: ' + e);

    fetch('/academico/public/docentes/jefe/'+ e+'/')
    .then(function(response){
        //console.log(response.json());
        return response.json();
    })
    .then(function(jsonData){
        listartabla(jsonData);

    });

   }

   function listartabla(docentes){

    $('.tr').remove();
    docentes.forEach(function(docente, indice, arreglo){
        console.log( indice + ' ' + docente['nombres']  );
        $('#tbody').append( `
                    <tr class="tr">
                        <td><small>${docente['nombres']} ${docente['apellidos']} </small></td>
                        <td> ${docente['identificacion']} </td>
                        <td> <small>${docente['email']} </small></td>
                        <td class="${docente['identificacion_jefe'] == null ? 'p-3 mb-2 bg-warning text-dark':''}">
                            <small> ${docente['nombre_jefe']} ${docente['apellido_jefe']}</small></td>

                        @if ($docente->estado=='ACTIVO')
                            <td><span class="btn btn-block btn-success btn-sm ">${docente['estado']}</span> </td>
                        @elseif ($docente->estado=='INACTIVO')
                            <td><span class="btn btn-block btn-secondary btn-sm">${docente['estado']}</span> </td>
                        @endif

                    </tr>
        `);
    })

   }



    $('#click').on('click', function(){
        //$("#add_funcion").remove();
        console.log('Remove - Contador= ' + contador);
        /*fetch('/docentesporjefe/'+);*/

    });

</script>

@endsection



