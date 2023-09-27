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

                            <div class="form-group">
                                <label for="horas_dedicadas" class="col-form-label">Horas dedicadas:</label>
                                <select class="form-control" name="horas_dedicadas" id="horas_dedicadas" {{$mode == 'Mostrar'?'disabled':''}}>
                                    <option type="text" class="form-control" value="40">Tiempo Completo (40h)</option>
                                    <option type="text" class="form-control" value="20">Medio Tiempo (20h)</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="funcion_1" class="col-form-label">Funcion administrativa:</label>
                                <select class="form-control" name="funcion_1" id="funcion_1" {{$mode == 'Mostrar'?'disabled':''}}>
                                    <option type="text" class="form-control" value="0">Selecione...</option>
                                    @foreach($funciones as $funcion)
                                    <option type="text" class="form-control" value="{{$funcion->id}}">{{$funcion->funcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="funcion_2" class="col-form-label">Funcion administrativa:</label>
                                <select class="form-control" name="funcion_2" id="funcion_2" {{$mode == 'Mostrar'?'disabled':''}}>
                                    <option type="text" class="form-control" value="0">Selecione...</option>
                                    @foreach($funciones as $funcion)
                                    <option type="text" class="form-control" value="{{$funcion->id}}">{{$funcion->funcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="funcion_3" class="col-form-label">Funcion administrativa:</label>
                                <select class="form-control" name="funcion_3" id="funcion_3" {{$mode == 'Mostrar'?'disabled':''}}>
                                    <option type="text" class="form-control" value="0">Selecione...</option>
                                    @foreach($funciones as $funcion)
                                    <option type="text" class="form-control" value="{{$funcion->id}}">{{$funcion->funcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="funcion_4" class="col-form-label">Funcion administrativa:</label>
                                <select class="form-control" name="funcion_4" id="funcion_4" {{$mode == 'Mostrar'?'disabled':''}}>
                                    <option type="text" class="form-control" value="0">Selecione...</option>
                                    @foreach($funciones as $funcion)
                                    <option type="text" class="form-control" value="{{$funcion->id}}">{{$funcion->funcion}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="descarga_investigacion" class="col-form-label">Descarga por Investigación</label>
                                <input type="number" min="0" max='99' class="form-control" id="descarga_investigacion" name="descarga_investigacion" value="{{isset($asignacion->descarga_investigacion)?$asignacion->descarga_investigacion:'0'}}" {{$mode == 'Mostrar'?'disabled':''}}>
                            </div>
                            <div class="form-group">
                                <label for="descarga_extension" class="col-form-label">Descarga por Extensión</label>
                                <input type="number" min="0" max='99' class="form-control" id="descarga_extension" name="descarga_extension" value="{{isset($asignacion->descarga_extension)?$asignacion->descarga_extension:'0'}}" {{$mode == 'Mostrar'?'disabled':''}}>
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

                                    <option type="text" class="form-control" value="PENDIENTE">PENDIENTE</option>
                                    <option type="text" class="form-control" value="LISTO">LISTO</option>

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




