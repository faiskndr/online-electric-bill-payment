<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('beranda.index') }}" class="nav-link">Beranda</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{route('tagihan.pelanggan')}}" class="nav-link">Tagihan</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if ($belumBayar->count() > 0)
        <span class="badge badge-warning navbar-badge">{{$belumBayar->count()}}</span>
        @endif
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">{{$belumBayar->count()}} Notifications</span>
        <div class="dropdown-divider"></div>
        @if ($belumBayar->count() > 0)
          <a href="/tagihan-pelanggan" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> {{$belumBayar->count()}} Tagihan
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>
          {{-- <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
        @endif
       
      </div>
    </li>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <li class="nav-item d-none d-sm-inline-block">
        <a href="logout" class="nav-link"  onclick="event.preventDefault();
        this.closest('form').submit();">Logout</a>
      </li>
      {{-- <x-li-item :href="route('logout')"
              onclick="event.preventDefault();
                          this.closest('form').submit();">
          {{ __('Log Out') }}
      </x-li-item> --}}
  </form>
    
  </ul>
</nav>