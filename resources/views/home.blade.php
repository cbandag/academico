@extends('layouts.template')

@section('content')
<div class='content-wrapper'>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">
              Bienvenido
            
            </h1>
          </div>
          
        </div>
      </div>
    </section>


<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="card card-primary card-outline mx-auto text-center">
        <div class="card-header">
          <h3 class="card-title">Bienvenido.</h3>
        </div> <!-- /.card-body -->
        <div class="card-body">
          <strong>{{Auth::user()->nombres}} {{Auth::user()->apellidos}}</strong>
          <p>
            @hasanyrole('Admin')
            Administrador
            @endhasanyrole

            @hasanyrole('Planeación')
            Planeación
            @endhasanyrole

            @hasanyrole('CoordinacionA')
            Coordinacion Academica 
            @endhasanyrole
            
            @hasanyrole('Jefe')
            Jefe inmediato
            @endhasanyrole

            @hasanyrole('Docente')
            Docente
            @endhasanyrole
          </p>
                    
        </div><!-- /.card-body -->
      </div>
    </div>

    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>150</h3>

            <p>New Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>53<sup style="font-size: 20px">%</sup></h3>

            <p>Bounce Rate</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>44</h3>

            <p>User Registrations</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>65</h3>

            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>

    <div class="row">
      
    </div>
  </div>
</section>

</div>

@endsection

