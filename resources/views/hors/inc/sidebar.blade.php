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

    <!-- Heading -->
    <div class="sidebar-heading">
      Roles directeur
    </div>
<!-- Nav Item - Charts -->
<li class="nav-item">
  <a class="nav-link" href="{{ route('user') }}">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Prescripteurs</span></a>
</li>
    <!-- Nav Item - Charts -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('roleuser') }}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Donner les roles</span></a>
    </li>
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('centre.centre') }}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Centres</span></a>
      </li>
      <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ville.ville') }}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Villes</span></a>
      </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('medicam') }}">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Médicaments</span></a>
  </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('getmedecin') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Liste des médécins</span></a>
    </li>

   
  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('ordonan') }}">
      <i class="fas fa-fw fa-table"></i>
      <span>Ordonnance</span></a>
  </li>

   <!-- Nav Item - Tables -->
   <li class="nav-item">
    <a class="nav-link" href="{{ route('person') }}">
      <i class="fas fa-fw fa-user"></i>
      <span>Employés</span></a>
  </li>

    

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->