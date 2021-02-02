<!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-dark-olive">
    <!-- Brand Logo -->
    <a href="{{url('/admin/dashboard')}}"" class="brand-link">
      <img src="{{asset('images/admin_images/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Rio</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ucfirst(Auth::guard('admin')->user()->name)}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                @if(Session::get('page') == 'dashboard')
                <?php $active = "active"?>
                @else
                <?php $active = ""?>
                @endif
            <a href="{{url('/admin/dashboard')}}" class="nav-link {{$active}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

             @if(Session::get('page') == 'settings' || Session::get('page') == 'updateAdminDetails')
                <?php $active = "active"?>
                @else
                <?php $active = ""?>
                @endif
          <li class="nav-item has-treeview menu-open">
             <a  class="nav-link {{$active}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                @if(Session::get('page') == 'updateAdminDetails')
                <?php $active = "active"?>
                @else
                <?php $active = ""?>
                @endif
              <li class="nav-item">
              <a href="{{url('/admin/updateAdminDetails')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Details</p>
                </a>
              </li>
              <li class="nav-item">
                  @if(Session::get('page') == 'settings')
                <?php $active = "active"?>
                @else
                <?php $active = ""?>
                @endif
              <a  href="{{url('/admin/settings')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Password</p>
                </a>
              </li>
            </ul>
          </li>

           @if(Session::get('page') == 'sections' || Session::get('page') == 'categories' || Session::get('page') == 'brands' || Session::get('page') == 'products' )
                <?php $active = "active"?>
                @else
                <?php $active = ""?>
                @endif
          <li class="nav-item has-treeview menu-open">
             <a  class="nav-link {{$active}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Catalogues
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                @if(Session::get('page') == 'sections')
                <?php $active = "active"?>
                @else
                <?php $active = ""?>
                @endif
              <li class="nav-item">
              <a href="{{url('/admin/sections')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Section</p>
                </a>
              </li>
              @if(Session::get('page') == 'banners')
              <?php $active = "active"?>
              @else
              <?php $active = ""?>
              @endif
            <li class="nav-item">
            <a href="{{url('/admin/banners')}}" class="nav-link {{$active}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Banners</p>
              </a>
            </li>

              @if(Session::get('page') == 'brands')
              <?php $active = "active"?>
              @else
              <?php $active = ""?>
              @endif
            <li class="nav-item">
            <a href="{{url('/admin/brands')}}" class="nav-link {{$active}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Brands</p>
              </a>
            </li>


               @if(Session::get('page') == 'categories')
                <?php $active = "active"?>
                @else
                <?php $active = ""?>
                @endif
              <li class="nav-item">
              <a href="{{url('/admin/categories')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>

               @if(Session::get('page') == 'products')
                <?php $active = "active"?>
                @else
                <?php $active = ""?>
                @endif
              <li class="nav-item">
              <a href="{{url('/admin/products')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>products</p>
                </a>
              </li>

              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>