@extends('main')

@section('title', ' - Accueil')


@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1>Vos données essentielles</h1>
        </div>
        
        <div class="col-lg-10 col-md-10">
            @if(Auth::user()->type_user == "director")
           <!-- Content Row -->
          <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Nombre d'assurés</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nb_person }}</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
    
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Ordonnances</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $all_ordos }} </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-2x text-gray-300">F CFA</i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
    
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Médicaments prescrits</div>
                          <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $nb_med_pres }}</div>
                            </div>
                            <div class="col">
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-hospital fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
    
                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Nombre d'ordonnances</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $num_ordos }}</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    
              <!-- Content Row -->
              @else
              <h4 class="align-items-center">Bienvenue sur la Gestion des prescriptions 2.0</h4>
              @endif
        </div>
       
    </div>
</div>
@endsection
