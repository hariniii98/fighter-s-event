
      <ul class="sidebar-menu">

        <li class="dropdown active">
          <a href="{{url('/')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>

        </li>
        @role('admin')
        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-gear"></i> <span>Settings</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{route('settings.index')}}">Settings</a></li>
              <li><a class="nav-link" href="{{route('roles.index')}}">Roles</a></li>

            </ul>
          </li>
          <li class="dropdown">
            <a href="{{route('users')}}" class="nav-link"><i class="fas fa-user"></i><span>Users</span></a>

          </li>
        @endrole


      </ul>

