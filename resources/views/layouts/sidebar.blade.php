 <!-- Sidebar Menu -->
 <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/admin/dashboard" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Menu Utama
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/pesanan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelola Pesanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/menu" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelola Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/meja" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelola Meja</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="nav-link btn btn-link" style="width:100%;text-align:left;">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Logout</p>
                  </button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->