<div class="row">
    <div class="col-6 mx-auto">
        <div class="card">

            <div class="card-header">
                <h5 class="card-title">{{$mode}} asignatura</h5>
            </div>

            @if($mode=='Crear')
                <form action="{{ route('periodo.store') }}"  method="POST">
            @endif

            @if($mode=='Mostrar')
                <form  method="POST">
                @method('HEAD')
            @endif

            @if($mode=='Editar')
                <form action="{{ route('periodo.update', [$periodo->id]) }}"  method="POST">
                @method('PUT')
            @endif
                @csrf
                    
                    <div class="card-body">
                        

                        <div class="form-group">
                            
                            
                            
                            <div class="form-group">
                                <label for="anio" class="col-form-label">Nombre de periodo</label>
                                <input type="text" class="form-control" id="anio" anio="anio" value="{{isset($periodo->anio)?$periodo->anio:''}}" {{$mode == 'Mostrar'?'disabled':''}}>
                            </div>
                            
                            <div class="form-group">
                                <label for="code" class="col-form-label">estado</label>
                                <input type="text" class="form-control" id="code" anio="code" value="{{isset($periodo->code)?$periodo->code:''}}" {{$mode == 'Mostrar'?'disabled':''}}>
                            </div>
                            
                            
                        
                            <div class="form-group">
                                <br>

                                <div class="custom-control custom-switch">
                                    @if($mode == 'Mostrar' || $mode == 'Editar')
                                    <input type="checkbox" anio="status" class="custom-control-input" id="customSwitch1" value="1" {{ $periodo->status == 'ACTIVA'?'checked': ''}} {{$mode == 'Mostrar'?'disabled':''}}>
                                    @else
                                    <input type="checkbox" anio="status" class="custom-control-input" id="customSwitch1" value="1" checked {{$mode == 'Mostrar'?'disabled':''}}>
                                    @endif
                                    <label   class="custom-control-label" for="customSwitch1">Estado de la Asignatura</label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a type='button' class="btn btn-danger" href="{{url('/periodo/')}}">Cancelar</a>
                        @if($mode=='Crear' || $mode=='Editar')
                        <button type="submit" class="btn btn-primary ">{{$mode}}</button>
                        @endif
                    </div>
                
            </form>
        </div>
    </div>
</div>
        



