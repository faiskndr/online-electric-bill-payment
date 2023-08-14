<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
    <span class="brand-text font-weight-light">Payment Point</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->username }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
   
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      @if (auth()->user()->id_level == 1)
      <li class="nav-item ">
        <x-nav-link-master :href="route('dashboard')" :active="request()->routeIs('dashboard')">
          <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              {{ __('Dashboard') }}
            </p>
        </x-nav-link-master>
      </li>
      {{-- <li class="nav-item">
        <x-nav-link-master :href="route('bank.index')" :active="request()->routeIs('bank.index')">
          <i class="nav-icon fas fa-th"></i>
          <p>
            {{ __('Bank') }}
          </p>
        </x-nav-link-master>
      </li> --}}
      <x-li-item :active="request()">
        <x-nav-link-master :href="route('pelanggan.index')" :active="request()">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            {{ __('Pelanggan') }}
            <i class="fas fa-angle-left right"></i>
          </p>
        </x-nav-link-master>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <x-nav-link-master :href="route('pelanggan.index')" :active="request()->routeIs('pelanggan.index')">
              <i class="far fa-circle nav-icon"></i>
              <p>
                {{ __('Daftar Pelanggan') }}
              </p>
            </x-nav-link-master>
          </li>
          <li class="nav-item">
            <x-nav-link-master :href="route('verify')" :active="request()->routeIs('verify')">
              <i class="far fa-circle nav-icon"></i>
              <p>
                {{ __('Konfirmasi Pelanggan') }}
              </p>
            </x-nav-link-master>
          </li>
        </ul>
      </x-li-item>
      <x-li-item>
        <x-nav-link-master :href="route('tarif.index')" :active="request()->routeIs('tarif.index')">
          <p>
            {{__('Tarif')}}
          </p>
        </x-nav-link-master>
      </x-li-item>
     
      <x-li-item>
        <x-nav-link-master :href="route('tagihan.index')" :active="request()->routeIs('tagihan.index')">
          <p>
            {{__('Tagihan')}}
          </p>
        </x-nav-link-master>
      </x-li-item> <x-li-item>
        <x-nav-link-master :href="route('laporan.index')" :active="request()->routeIs('laporan.index')">
          <p>
            {{__('Laporan')}}
          </p>
        </x-nav-link-master>
      </x-li-item>
     
      @else
      
      <x-li-item>
        <x-nav-link-master :href="route('konfirmasi-pembayaran.index')" :active="request()->routeIs('konfirmasi-pembayaran.index')">
          <p>
            {{__('Pembayaran')}}
          </p>
        </x-nav-link-master>
      </x-li-item>
      @endif
      <x-li-item>
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <x-nav-link-master :href="route('logout')"
                  onclick="event.preventDefault();
                              this.closest('form').submit();">
            <p>
              {{ __('Log Out') }}
            </p>
          </x-nav-link-master>
      </form>
        </x-li-item>  
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>