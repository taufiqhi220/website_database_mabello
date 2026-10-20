@php
    $menus = [ 
      (object) [
        "title" => "Dashboard",
        "path" => "/distributor/dashboard",
        "icon" => "fas fa-th",
      ],
      (object) [
        "title" => "Produk Keluar",
        "path" => "/distributor/produk-keluar",
        "icon" => "fas fa-th",
      ],
      (object) [
        "title" => "Log out",
        "path" => "/logout",
        "icon" => "fas fa-sign-out-alt",
      ],
    ];
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #405C8F">
    <!-- Brand Logo -->
    <a href="distributor/dashboard">
        <img src="{{ asset('templates/dist/img/Mabello logo.png') }}" alt="Mabello Logo" style="opacity: .8; width: 200px; height: auto; display: block; margin-left: auto; margin-right: auto; margin-top: 20px;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('templates/dist/img/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <!-- Menampilkan nama pengguna yang sedang login -->
                <a href="#" class="d-block">{{ Auth::user()->nama }}</a> <!-- Ganti 'name' dengan kolom yang sesuai -->
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> 

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach ($menus as $menu)
                    <li class="nav-item">
                        @if ($menu->title === 'Log out')
                            <!-- Form Logout -->
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-rounded nav-link {{ request()->path() === $menu->path ? 'active' : '' }}" style="color: white; text-decoration: none; width: 100%; padding: 10px;">
                                    <p>{{ $menu->title }}</p> <!-- Hanya tampilkan teks tanpa ikon -->
                                </button>
                            </form>
                        @else
                            <a href="{{ url($menu->path) }}" class="nav-link {{ request()->is(trim($menu->path, '/')) ? 'active' : '' }}">
                                <i class="nav-icon {{ $menu->icon }}"></i>
                                <p>{{ $menu->title }}</p>
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
