<ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" id="cargarListaDeHeroes" href="#">
          <i class="fas fa-fw fa-list-alt"></i>
          <span>Hero List</span>
        </a>
      </li>
      <?php if($this->session->userdata('email') == "rbkraken@gmail.com"){ ?>
        
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-user-alt"></i>
          <span>New Hero</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" id="backUpDatabase" href="#">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>DB Backup</span></a>
      </li>

      <?php } ?>

      <li class="nav-item">
        <a class="nav-link" id="backUpDatabase" href="items">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Items</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" id="backUpDatabase" href="items">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Artifacts</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" id="backUpDatabase" href="items">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>FAQ</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" id="backUpDatabase" href="items">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Role definition</span></a>
      </li>

    </ul>