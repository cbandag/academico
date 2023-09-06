<div class="row">
    <div class="col-6 mx-auto">
        <div class="card">

            <div class="card-header">
                <h5 class="card-title">{{$mode}} asignatura</h5>
            </div>

            @if($mode=='Crear')
                <form action="{{ route('actividades.store') }}"  method="POST">
            @endif

            @if($mode=='Mostrar')
                <form  method="POST">
                @method('HEAD')
            @endif

            @if($mode=='Editar')
                <form action="{{ route('actividades.update', [$actividad->id]) }}"  method="POST">
                @method('PUT')
            @endif
                @csrf
                    
                    <div class="card-body">
                        

                        <div class="form-group">
                            
                            
                            
                            <div class="form-group">
                                <label for="actividad" class="col-form-label">Periodo (0000-00):</label>
                                <input type="text" class="form-control" id="actividad" name="actividad" value="{{isset($actividad->actividad)?$actividad->actividad:''}}" {{$mode == 'Mostrar'?'disabled':''}}>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="estado" class="col-form-label">Estado:</label>
                                <select class="form-control" name="estado" id="estado" {{$mode == 'Mostrar'?'disabled':''}}>
                                    
                                    <option type="text" class="form-control" value="ACTIVO">ACTIVO</option>
                                    <option type="text" class="form-control" value="INACTIVO">INACTIVO</option>
                                    
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <a type='button' class="btn btn-danger" href="{{url('/actividades/')}}">Cancelar</a>
                        @if($mode=='Crear' || $mode=='Editar')
                        <button type="submit" class="btn btn-primary ">{{$mode}}</button>
                        @endif
                    </div>
                
            </form>
        </div>
    </div>
</div>
        



