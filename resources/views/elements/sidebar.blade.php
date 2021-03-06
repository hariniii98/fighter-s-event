
      <ul class="sidebar-menu">

        <li class="dropdown active">
          <a href="{{url('/home')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>

        </li>
        @role('fighter')
        <li>
            <a href="{{route('fighter.instructions')}}" class="nav-link"><i class="fas fa-book"></i><span>Instructions for Touranament</span></a>

        </li>
        <li>
            <a href="{{route('fighter.report',Auth::id())}}" class="nav-link"><i class="fas fa-book"></i><span>My Results</span></a>

        </li>
        @endrole
        @role('admin')
        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-gear"></i> <span>Settings</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{route('settings.index')}}">Settings</a></li>
              <li><a class="nav-link" href="{{route('roles.index')}}">Roles</a></li>

            </ul>
          </li>
          <li>
            <a href="{{route('main_events.index')}}" class="nav-link"><i class="fa fa-calendar"></i><span>Main Events</span></a>

          </li>
          <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-calendar-alt"></i> <span>Events</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{route('events.index')}}">Events</a></li>
              <li><a class="nav-link" href="{{route('event_categories.index')}}">Event Categories</a></li>
              <li><a class="nav-link my-3" href="{{route('event.judges')}}">Assign Judges to Event and Ring</a></li>
              <li><a class="nav-link my-3" href="{{route('event.super_judges')}}">Assign Super Judges to Event and Ring</a></li>
              <li><a class="nav-link my-3" href="{{route('event.referees')}}">Assign Referees to Event and Ring</a></li>
              <li><a class="nav-link" href="{{route('allowances.index')}}">Allowances</a></li>
              <li><a class="nav-link" href="{{route('age_categories.index')}}">Age Categories</a></li>
              <li><a class="nav-link" href="{{route('weight_categories.index')}}">Weight Categories</a></li>
              <li><a class="nav-link" href="{{route('sponsors.index')}}">Sponsors</a></li>
              <li><a class="nav-link" href="{{route('payments.index')}}">Payments</a></li>
              <li><a class="nav-link" href="{{route('extra_ranking_points.index')}}">Extra Ranking Points</a></li>
            </ul>
          <li>
            <a href="{{route('users')}}" class="nav-link"><i class="fas fa-users"></i><span>Users</span></a>

          </li>
          <li>
            <a href="{{route('tournament.draws')}}" class="nav-link"><i class="fas fa-anchor"></i><span>Tournament Draw</span></a>

          </li>
          <li>
            <a href="{{route('tournament.matches.list')}}" class="nav-link"><i class="fas fa-book"></i><span>Matches</span></a>

          </li>

          <li>
            <a href="{{route('player.rankings')}}" class="nav-link"><i class="fas fa-trophy"></i><span>Rankings</span></a>

          </li>

          <li>
            <a href="{{route('whatsapp_push_notification.create')}}" class="nav-link"><i class="fas fa-phone"></i><span>Send Whatsapp Push Notification</span></a>

          </li>




        @endrole


      </ul>

