<div class="row">
    <div class="col-6 mx-auto">
        <div class="card">

            <div class="card-header">
                <h5 class="card-title">{{$mode}} Facultad</h5>
            </div>

            @if($mode=='Crear')
                <form action="{{ route('facultades.store') }}"  method="POST">
            @endif

            @if($mode=='Mostrar')
                <form  method="POST">
                @method('HEAD')
            @endif

            @if($mode=='Editar')
                <form action="{{ route('facultades.update', [$facultad->id]) }}"  method="POST">
                @method('PUT')
            @endif
                @csrf
                    
                    <div class="card-body">
                        

                        <div class="form-group">
                            
                            
                            
                            <div class="form-group">
                                <label for="nombre" class="col-form-label">Nombre de Facultad:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{isset($facultad->nombre)?$facultad->nombre:''}}" {{$mode == 'Mostrar'?'disabled':''}}>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <a type='button' class="btn btn-danger" href="{{url('facultades/')}}">Cancelar</a>
                        @if($mode=='Crear' || $mode=='Editar')
                        <button type="submit" class="btn btn-primary ">{{$mode}}</button>
                        @endif
                    </div>
                
            </form>
        </div>
    </div>
</div>
        



