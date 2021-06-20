<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
      <div class="sidebar-brand-text mx-3"><img src="{{ asset('img/logo_gdp_v.png') }}"/></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Tableau de bord</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    

@if(Auth::user()->type_user == "director")
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#administrator" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-desktop"></i>
      <span>Administrateur</span>
    </a>
    <div id="administrator" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Menu:</h6>
        <a class="collapse-item" href="{{ route('user') }}">Prescripteurs</a>
        <a class="collapse-item" href="{{ route('ordonan.getall') }}">Toutes les ordonnances</a>
        <a class="collapse-item" href="{{ route('emprunt.getall') }}">Toutes les lunettes</a>
        <a class="collapse-item" href="{{ route('medicamplusvendus') }}">Statistiques</a>
        <a class="collapse-item" href="{{ route('roleuser') }}">Donner les roles</a>
        <a class="collapse-item" href="{{ route('centre.centre') }}">Centres</a>
        <a class="collapse-item" href="{{ route('ville.ville') }}">Villes</a>
        <a class="collapse-item" href="{{ route('medicam') }}">Médicaments</a>
        <a class="collapse-item" href="{{ route('person') }}">Employés</a>
      </div>
    </div>
  </li>
  
@else
@endif
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#consultations" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-id-card fa-2x"></i>
      <span>Consultations</span>
    </a>
    <div id="consultations" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Menu:</h6>
        <a class="collapse-item" href="{{ route('ordonan') }}">Nouvelle Ordonnance</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bpc" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-headphones"></i>
        <span>Bon de prises en charge</span>
      </a>
      <div id="bpc" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Menu:</h6>
          <a class="collapse-item" href="#">Vos BPC</a>
          <a class="collapse-item" href="#">Nouveau B.P.C.</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lunettes" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-glasses"></i>
          <span>Lunetterie</span>
        </a>
        <div id="lunettes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu:</h6>
            {{-- <a class="collapse-item" href="#">Vos emprunts</a> --}}
            <a class="collapse-item" href="{{ route('emprunt') }}">Nouvelle paire de lunettes</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#stat" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-signal"></i>
          <span>Statistiques</span>
        </a>
        <div id="stat" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu:</h6>
            <a class="collapse-item" href="#">Vos graphes de données</a>
            <a class="collapse-item" href="#">Prescripteurs</a>
            <a class="collapse-item" href="#">Médicaments</a>
            <a class="collapse-item" href="{{ route('centre.stat') }}">Centres</a>
            <a class="collapse-item" href="#">Ordonnances</a>
            <a class="collapse-item" href="#">Lunettes</a>
            <a class="collapse-item" href="#">BPC</a>
          </div>
        </div>
      </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->