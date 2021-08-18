
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Bibliiotek</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-house-user"></i>
          <span>Inicio</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Comercial
      </div>
      <li class="nav-item" id="clientes_menu" name="clientes_menu">
        
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true"
          aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-users-cog"></i>
          <span>Personas</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledy="headingTwo" data-parient="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">            
            <h6 class="collapse-header">Afiliados</h6>
            <a class="collapse-item" href="usuarios.php">Usuarios</a>
            <a class="collapse-item" href="perfiles.php">Perfiles</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
          aria-controls="collapsePages">
          <i class="fas fa-fw fa-book"></i>
          <span>Libros</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledy="headingTwo" data-parient="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">            
            <h6 class="collapse-header">Inventario</h6>
            <a class="collapse-item" href="usuarios.php">Libros</a>
            <a class="collapse-item" href="perfiles.php">Cargue Masivo</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Utilidades
      </div>
      <li class="nav-item">
        <a class="nav-link" href="informes.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Informes</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ajustes.php">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Ajustes</span>
        </a>
      </li>
      <hr class="sidebar-divider d-none d-md-block">
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>