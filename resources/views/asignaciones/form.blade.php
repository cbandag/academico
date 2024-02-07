<div class="row">
    <div class="col-12 mx-auto">
        <div class="card">

            <div class="card-header">
                <h5 class="card-title">{{$mode}} asignatura</h5>
            </div>

            @if($mode=='Crear')
                <form action="{{ route('asignaciones.store') }}"  method="POST">
            @endif

            @if($mode=='Mostrar')
                <form  method="POST" enctype="multipart/form-data">
                @method('HEAD')
            @endif

            @if($mode=='Editar')
                <form action="{{ route('asignaciones.update', [$asignacion->id]) }}"  method="POST" enctype="multipart/form-data">
                @method('PUT')
            @endif
                @csrf

                    <div class="card-body">

                        <div class="form-group">

                            <div class="form-group">
                                <label  class="col-form-label">Funciones administrativas:</label>
                            </div>

                            <div class="row" id="container-funciones">
                                <div class="form-group col-11" id="funciones">
                                    @foreach($funcionesSeleccionadas as $key => $fs)
                                    <div id="row-funcioncargada{{$key+1}}" >
                                        <div class="form-group row" >
                                            <label  class="col-form-label col-1"> {{$key+1}}.</label>
                                            <select class="form-control col-5" name="funcioncargada[{{$key+1}}]" id="funcion_{{$key+1}}" {{$mode == 'Mostrar'?'disabled':''}} >
                                                <!--<option type="text" class="form-control" value="">Seleccione...</option> -->
                                                @foreach($funciones as $funcion)
                                                    @isset($funcionesSeleccionadas[$key])
                                                        @if($funcion->id==$funcionesSeleccionadas[$key])
                                                            <option type="text" class="form-control" value="{{$funcion->id}}" selected> {{$funcion->funcion}} - {{$funcion->descarga *100 }}%</option>
                                                        @endif
                                                    @endisset

                                                @endforeach
                                            </select>
                                            <div class=" col-5">
                                                <label type="text" class="form-control"   disabled>Soporte cargado</label>
                                            </div>
                                            <div class="col-1">
                                                <a  class="btn btn-danger" name="remove_[{{$key+1}}]" onclick="quitarFila(this)">
                                                    <i class="fas fa-minus-square fa-lg" style='color: white'></i>
                                                    <!-- <input type="submit" name='edit' value="edit"> -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="col-1">
                                        <a  class="btn btn-primary" id="add_funcion" onclick="agregarFila(this)">
                                            <i class="fas fa-plus-square fa-rotate-270 fa-lg" style='color: white'></i>
                                            <!-- <input type="submit" name='edit' value="edit"> -->
                                        </a>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="horas_dedicadas" class="col-form-label">Horas dedicadas:</label>
                                    <select class="form-control" name="horas_dedicadas" id="horas_dedicadas" {{$mode == 'Mostrar' || $mode == 'Editar' ?'disabled':''}}>
                                        <option type="text" class="form-control" value="40" {{$asignacion->horas_dedicacion=='40' ? 'selected':''}}>Tiempo Completo (40h)</option>
                                        <option type="text" class="form-control" value="20" {{$asignacion->horas_dedicacion=='20' ? 'selected':''}}>Medio Tiempo (20h)</option>
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="descarga_investigacion" class="col-form-label">Horas Investigación</label>
                                    <input type="number" min="0" max='99' class="form-control" id="descarga_investigacion" name="descarga_investigacion" onchange="sumaIE(this)"
                                        value="{{isset($asignacion->descarga_investigacion)?$asignacion->descarga_investigacion:'0'}}" {{$mode == 'Mostrar'?'disabled':''}}>
                                </div>
                                <div class="form-group col-3">
                                    <label  class="col-form-label">Horas Extensión:</label>
                                    <input type="number" min="0" max='99' class="form-control" id="descarga_extension" name="descarga_extension" onchange="sumaIE(this)"
                                        value="{{isset($asignacion->descarga_extension)?$asignacion->descarga_extension:'0'}}" {{$mode == 'Mostrar'?'disabled':''}}>
                                </div>
                                <div class="form-group col-3">
                                    <label  class="col-form-label">Total:</label>
                                    <label for="descarga_extension" class="form-control" id="sumaIE">{{$asignacion->horas_dedicacion/2}}hrs max </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">La suma de horas de investigación + extensión no deben superar el 50% de las horas dedicadas</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="observaciones" class="col-form-label">Observaciones:</label>
                                <textarea  type="text" class="form-control" id="observaciones" name="observaciones" >{{isset($asignacion->observaciones)?$asignacion->observaciones:''}} {{$mode == 'Mostrar'?'disabled':''}}</textarea >
                            </div>


                            <div class="form-group">
                                <label for="estado" class="col-form-label">Estado:</label>
                                <select class="form-control" name="estado" id="estado" {{$mode == 'Mostrar'?'disabled':''}}>
                                    <option type="text" class="form-control" value="PENDIENTE" {{$asignacion->estado=='PENDIENTE' ? 'selected':''}}>PENDIENTE</option>
                                    <option type="text" class="form-control" value="APROBADO" {{$asignacion->estado=='APROBADO' ? 'selected':''}}>APROBADO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer  text-right">
                        <a type='button' class="btn btn-danger " href="{{url('/asignaciones/jefe')}}">Cancelar</a>
                        @if($mode=='Crear' || $mode=='Editar')
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        @endif
                    </div>

            </form>
        </div>
    </div>
</div>

<script>
    var contador=0;
    var i = Number(document.getElementById('descarga_investigacion').value);
    var e = Number(document.getElementById('descarga_extension').value);
    var total=0;

    function sumaIE(element){
        let valor = Number(element.value);
        let id = element.id;

        if(id=='descarga_investigacion'){
            i=valor;
        }else if(id=='descarga_extension'){
            e=valor;
        }

        total = i + e;

        console.log("Nombre del elemento " + element.id + ' = ' + valor);
        console.log("Suma = " + total);
        document.getElementById('sumaIE').innerHTML = total;
    }


    $( document ).ready(function() {
        //contador= contador + 1;

        //@isset($key)
            //contador= '{{$key + 1}}';
        //@endisset
        /*contador= $('#funciones').childElementCount;*/
        //console.log( "ready! contador= " + contador);
    });

/*
    $('#remove_funcion').on('click', function(){
    });
    $('#add_funcion').on('click', function(){
    });
*/

    function agregarFila(element){

        console.log("Fila agregada" );
        //*/$("#add_funcion").remove();*/
        //element.remove()
        contador++;
        console.log('Add - Contador= '+contador);
        $('#funciones').append(`
            <div id="row-funcion-${contador}">
                <div class="form-group row ">
                    <label  class="col-form-label col-1 "> ${contador}. </label>
                    <select class="form-control col-5" name="funcion[${contador}]"  {{$mode == 'Mostrar'?'disabled':''}}>
                        <option type="text" class="form-control" value="">Seleccione...</option>
                        @foreach($funciones as $funcion)
                        <option type="text" class="form-control" value="{{$funcion->id}}">
                            {{$funcion->funcion}} - {{$funcion->descarga *100 }}%
                        </option>
                        @endforeach
                    </select>
                    <div class="custom-file col-5">
                        <input type="file" class="custom-file-input" name='input[${contador}]' onchange="cargarfile(this)">
                        <label class="custom-file-label" for="exampleInputFile" id="label[${contador}]">Cargar</label>
                    </div>
                    <div class="col-1">
                        <a  class="btn btn-danger" name="remove_[${contador}]" onclick="quitarFila(this)">
                            <i class="fas fa-minus-square fa-lg" style='color: white'></i>
                            <!-- <input type="submit" name='edit' value="edit"> -->
                        </a>
                    </div>
                </div>
            </div>
        `);


    };

    function quitarFila(element){
        console.log("Fila quitada" );
        element.parentNode.parentNode.remove();

        /*
        if(contador>0){
            $("#row-funcion-"+ contador +"").remove();
            contador --;
            console.log('Remove - Contador= ' + contador);
        }*/
    };



    function cargarfile(elementoFile){

        let archivo = elementoFile.files;
        console.log("Nombre de elemento: " + elementoFile.name);
        console.log("Nombre de archivo: " + archivo[0].name);

        let nuevoNombre = elementoFile.name.replace('input', 'label')
        console.log("Nombre de elemento reemplazado: " + nuevoNombre);
        document.getElementById(nuevoNombre).innerHTML = archivo[0].name;
        /*for (var i = 0; i < files.length; i++) {
            alert("Filename " + files[i].name);
        }*/
    };



</script>




