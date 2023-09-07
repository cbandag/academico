<div class="row">
    <div class="col-6 mx-auto">
        <div class="card">

            <div class="card-header">
                <h5 class="card-title">{{$mode}} Programa</h5>
            </div>

            @if($mode=='Crear')
                <form action="{{ route('programas.store') }}"  method="POST">
            @endif

            @if($mode=='Mostrar')
                <form  method="POST">
                @method('HEAD')
            @endif

            @if($mode=='Editar')
                <form action="{{ route('programas.update', [$programa->id]) }}"  method="POST">
                @method('PUT')
            @endif
                @csrf
                    
                    <div class="card-body">
                        

                        <div class="form-group">
                            
                            
                            
                            <div class="form-group">
                                <label for="nombre" class="col-form-label">Nombre del programa:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{isset($programa->nombre)?$programa->nombre:''}}" {{$mode == 'Mostrar'?'disabled':''}}>
                            </div>

                            <div class="form-group">
                                <label for="facultad_id" class="col-form-label">Facultad</label>
                                <select class="form-control" name="facultad_id" id="facultad_id" {{$mode == 'Mostrar'?'disabled':''}}>
                                    @foreach($facultades as $facultad)
                                    <option type="text" class="form-control" value="{{$facultad->id}}">{{$facultad->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a type='button' class="btn btn-danger" href="{{url('programas/')}}">Cancelar</a>
                        @if($mode=='Crear' || $mode=='Editar')
                        <button type="submit" class="btn btn-primary ">{{$mode}}</button>
                        @endif
                    </div>
                
            </form>
        </div>
    </div>
</div>
        



