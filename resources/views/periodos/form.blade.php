<div class="row">
    <div class="col-6 mx-auto">
        <div class="card">

            <div class="card-header">
                <h5 class="card-title">{{$mode}} periodo</h5>
            </div>

            @if($mode=='Crear')
                <form action="{{ route('periodos.store') }}"  method="POST">
            @endif

            @if($mode=='Mostrar')
                <form  method="POST">
                @method('HEAD')
            @endif

            @if($mode=='Editar')
                <form action="{{ route('periodos.update', [$periodo->id]) }}"  method="POST">
                @method('PUT')
            @endif
                @csrf

                    <div class="card-body">


                        <div class="form-group">

                            <div class="row">
                                <div class="form-group col-7">
                                    <label for="año" class="col-form-label">Año:</label>
                                    <input type="number" class="form-control" id="año" name="año"
                                        value="{{isset($periodo->año)?$periodo->año:''}}" {{$mode == 'Mostrar' || $mode == 'Editar' ?'disabled':''}} maxlength="4">
                                </div>



                                <div class="form-group col-5">
                                    <label for="periodo" class="col-form-label">Periodo:</label>
                                    <select class="form-control" name="periodo" id="periodo" {{$mode == 'Mostrar' || $mode == 'Editar'?'disabled':''}}>
                                        <option value="">Seleccione...</option>
                                        <option type="text" class="form-control" value="01"
                                            @isset($periodo->periodo)
                                                {{$periodo->periodo =='01'?'selected':'' }}
                                            @endisset
                                        >01</option>

                                        <option type="text" class="form-control " value="02"
                                            @isset($periodo->periodo)
                                                {{$periodo->periodo =='02'?'selected':'' }}
                                            @endisset
                                        >02</option>
                                    </select>
                                </div>


                            </div>



                            <div class="form-group ">
                                <label for="estado" class="col-form-label">Estado:</label>
                                <select class="form-control" name="estado" id="estado" {{$mode == 'Mostrar'?'disabled':''}}>
                                    <option type="text" class="form-control" value="INACTIVO"
                                        @isset($periodo->estado)
                                            {{$periodo->estado =='INACTIVO'?'selected':'' }}
                                        @endisset
                                    >INACTIVO</option>

                                    <option type="text" class="form-control" value="ACTIVO"
                                        @isset($periodo->estado)
                                            {{$periodo->estado =='ACTIVO'?'selected':'' }}
                                        @endisset
                                    >ACTIVO</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <a type='button' class="btn btn-danger" href="{{url('/periodos/')}}">Cancelar</a>
                        @if($mode=='Crear' || $mode=='Editar')
                        <button type="submit" class="btn btn-primary">{{$mode}}</button>
                        @endif
                    </div>

            </form>
        </div>
    </div>
</div>




