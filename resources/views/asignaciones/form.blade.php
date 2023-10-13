<div class="row">
    <div class="col-6 mx-auto">
        <div class="card">

            <div class="card-header">
                <h5 class="card-title">{{$mode}} asignatura</h5>
            </div>

            @if($mode=='Crear')
                <form action="{{ route('asignaciones.store') }}"  method="POST">
            @endif

            @if($mode=='Mostrar')
                <form  method="POST">
                @method('HEAD')
            @endif

            @if($mode=='Editar')
                <form action="{{ route('asignaciones.update', [$asignacion->id]) }}"  method="POST">
                @method('PUT')
            @endif
                @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <div class="form-group ">
                                <label for="horas_dedicadas" class="col-form-label">Horas dedicadas:</label>
                                <select class="form-control" name="horas_dedicadas" id="horas_dedicadas" {{$mode == 'Mostrar'?'disabled':''}}>
                                    <option type="text" class="form-control" value="40" {{$asignacion->horas_dedicacion=='40' ? 'selected':''}}>Tiempo Completo (40h)</option>
                                    <option type="text" class="form-control" value="20" {{$asignacion->horas_dedicacion=='20' ? 'selected':''}}>Medio Tiempo (20h)</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label  class="col-form-label">Funciones administrativas:</label>
                            </div>

                            <div class="row">
                                <div class="form-group col-8" id="funciones">
                                    @foreach($funcionesSeleccionadas as $key => $fs)
                                    <div class="" id="r-f{{$key+1}}">
                                        <div class="form-group">
                                            <select class="form-control" name="funcion_{{$key+1}}" id="funcion_{{$key+1}}" {{$mode == 'Mostrar'?'disabled':''}}>
                                                <option type="text" class="form-control" value="">Seleccione...</option>
                                                @foreach($funciones as $funcion)
                                                <option type="text" class="form-control" value="{{$funcion->id}}"
                                                    @if(isset($funcionesSeleccionadas[$key]))
                                                        {{($funcion->id==$funcionesSeleccionadas[$key] ? 'selected':'')}}
                                                    @endif>
                                                        {{$funcion->funcion}} - {{$funcion->descarga *100 }}%</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class=" col-4 row" id="botones">
                                        <div class="col-6">
                                            <a  class="btn btn-primary" id="add_funcion">
                                                <i class="fas fa-plus-square fa-rotate-270 fa-lg" style='color: white'></i>
                                                <!-- <input type="submit" name='edit' value="edit"> -->
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a  class="btn btn-danger" id="remove_funcion">
                                                <i class="fas fa-minus-square fa-lg" style='color: white'></i>
                                                <!-- <input type="submit" name='edit' value="edit"> -->
                                            </a>
                                        </div>

                                </div>

                            </div>




                            <div class="row">
                                <div class="form-group col-md">
                                    <label for="descarga_investigacion" class="col-form-label">Descarga por Investigación</label>
                                    <input type="number" min="0" max='99' class="form-control" id="descarga_investigacion" name="descarga_investigacion" value="{{isset($asignacion->descarga_investigacion)?$asignacion->descarga_investigacion:'0'}}" {{$mode == 'Mostrar'?'disabled':''}}>
                                </div>
                                <div class="form-group col-md">
                                    <label for="descarga_extension" class="col-form-label">Descarga por Extensión</label>
                                    <input type="number" min="0" max='99' class="form-control" id="descarga_extension" name="descarga_extension" value="{{isset($asignacion->descarga_extension)?$asignacion->descarga_extension:'0'}}" {{$mode == 'Mostrar'?'disabled':''}}>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="soporte" class="col-form-label">Soporte</label>
                                <input type="text" class="form-control" id="soporte" name="soporte" value="{{isset($asignacion->soporte)?$asignacion->soporte:''}}" {{$mode == 'Mostrar'?'disabled':''}}>
                            </div>
                            <div class="form-group">
                                <label for="observaciones" class="col-form-label">Observaciones</label>
                                <textarea  type="text" class="form-control" id="observaciones" name="observaciones" value="{{isset($asignacion->observaciones)?$asignacion->observaciones:''}}" {{$mode == 'Mostrar'?'disabled':''}}></textarea >
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

                    <div class="card-footer">
                        <a type='button' class="btn btn-danger" href="{{url('/asignaciones/')}}">Cancelar</a>
                        @if($mode=='Crear' || $mode=='Editar')
                        <button type="submit" class="btn btn-primary ">Guardar</button>
                        @endif
                    </div>

            </form>
        </div>
    </div>
</div>

<script>
    var contador=0;


    $( document ).ready(function() {
        @isset($key)
            contador= '{{$key + 1}}';
        @endisset
        /*contador= $('#funciones').childElementCount;*/
        console.log( "ready! contador= " + contador);
    });

    $('#remove_funcion').on('click', function(){
        if(contador>0){
            $("#r-f"+ contador +"").remove();
            contador --;
            console.log('Remove - Contador= ' + contador);
        }

    });

    $('#add_funcion').on('click', function(){
        //$("#add_funcion").remove();
        contador++;
        console.log('Add - Contador= '+contador);
        $('#funciones').append(`
                <div id="r-f${contador}">
                    <div class="form-group">
                        <select class="form-control" name="funcion_${contador}" id="funcion_${contador}" {{$mode == 'Mostrar'?'disabled':''}}>
                            <option type="text" class="form-control" value="">Seleccione...</option>
                            @foreach($funciones as $funcion)
                            <option type="text" class="form-control" value="{{$funcion->id}}">
                                {{$funcion->funcion}} - {{$funcion->descarga *100 }}%
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

        `);
    });

</script>




