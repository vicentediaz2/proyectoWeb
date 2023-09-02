<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{$_layoutParams.root}">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul>
        <li>
            <a href="#">Portafolios</a>
        </li>
        <li>
            <a href="{$_layoutParams.root}index/contacto/">Contacto</a>
        </li>
        {if Session::get(autenticate)}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Dropdown
          </a>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{$_layoutParams.root}roles">roles</a></li>
            <li><a class="dropdown-item" href="{$_layoutParams.root}usuarios">Usuarios</a></li>
            <li><a class="dropdown-item" href="{$_layoutParams.root}categories">Cateogiras</a></li>
            <li><a class="dropdown-item" href="{$_layoutParams.root}Productos">Productos</a></li>
            <li><a class="dropdown-item" href="{$_layoutParams.root}img">Imagenes</a></li>
            </ul>
          </li>
        {/if}
          <li>
          <a href="{$_layoutParams.root}login">Login</a>
        </li>
        <li>
          <a href="{$_layoutParams.root}login/logout">Logout</a>
        </li>
    </ul>
    </div>
  </div>
</nav>