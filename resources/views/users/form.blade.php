<div class="row">
    <div class="col-6 mx-auto">
        <div class="card">

            <div class="card-header">
                <h5 class="card-title">{{$mode}} {{$model}}</h5>
            </div>

            @if($mode=='Crear')
                <form action="{{ route($route.'.store') }}"  method="POST">
            @endif

            @if($mode=='Mostrar')
                <form  method="POST">
                @method('HEAD')
            @endif

            @if($mode=='Editar')
                <form action="{{ route($route.'.update', [$user->id]) }}"  method="POST">
                @method('PUT')
            @endif
                @csrf

                    <div class="card-body">


                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nombres" class="col-form-label">Nombres:</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres" value="{{isset($user->nombres)?$user->nombres:''}}" {{$mode == 'Mostrar' || $mode == 'Editar' ?'disabled':''}}>
                                </div>

                                <div class="form-group col-6">
                                    <label for="apellidos" class="col-form-label">Apellidos:</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{isset($user->apellidos)?$user->apellidos:''}}" {{$mode == 'Mostrar' || $mode == 'Editar'?'disabled':''}}>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="identificacion" class="col-form-label">Identificación:</label>
                                    <input type="number" class="form-control" id="identificacion" name="identificacion" value="{{isset($user->identificacion)?$user->identificacion:''}}" {{$mode == 'Mostrar' || $mode == 'Editar' ?'disabled':''}}>
                                </div>
                                <div class="form-group col-6">
                                    <label for="email" class="col-form-label">Correo institucional:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{isset($user->email)?$user->email:''}}" {{$mode == 'Mostrar' || $mode == 'Editar' ?'disabled':''}}>
                                </div>
                            </div>



                            @if($mode == 'Crear' )
                            <div class="form-group">
                                <label for="password" class="col-form-label">Contraseña:</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" {{$mode=='Crear'?'required':''}} autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-form-label">Confirmar contraseña:</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" {{$mode=='Crear'?'required':''}} autocomplete="new-password">
                            </div>
                            @endif

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="jefe" class="col-form-label">Jefe inmediato:</label>
                                    <select class="form-control" name="jefe" id="jefe" {{$mode == 'Mostrar'?'disabled':''}}>
                                        <option type="text" class="form-control" >Seleccione... </option>
                                        @foreach($jefes as $jefe)
                                        <option type="text" class="form-control" value="{{$jefe->id}}"
                                            @isset($user->id)
                                                {{$jefeActual->identificacion_jefe == $jefe->identificacion ?'selected':'' }}
                                            @endisset

                                        >{{$jefe->nombres}} {{$jefe->apellidos}} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label for="estado" class="col-form-label">Estado:</label>
                                    <select class="form-control" name="estado" id="estado" {{$mode == 'Mostrar'?'disabled':''}}>

                                        <option type="text" class="form-control" value="ACTIVO"
                                            @isset($user->estado)
                                                {{$user->estado =='ACTIVO'?'selected':'' }}
                                            @endisset
                                        >ACTIVO</option>

                                        <option type="text" class="form-control" value="INACTIVO"
                                            @isset($user->estado)
                                                {{$user->estado =='INACTIVO'?'selected':'' }}
                                            @endisset
                                        >INACTIVO</option>
                                    </select>
                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="card-footer text-right">

                        <a type='button' class="btn btn-danger" href="{{url('/'.$route.'/')}}">Cancelar</a>
                        @if($mode=='Crear' || $mode=='Editar')
                        <button type="submit" class="btn btn-primary ">{{$mode}}</button>
                        @endif

                    </div>



            </form>

            <div class="card-footer text-right">
                <form action="{{ url('/docentes/'. $user->id).'/reset_password' }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button  class="btn btn-danger"  type="submit" onclick="return confirm('¿Seguro que quieres restaurar la contraseña?')">
                        Restaurar contraseña
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>




