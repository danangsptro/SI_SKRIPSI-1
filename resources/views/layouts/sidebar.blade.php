<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon ">
            <img src="{{ asset('assets/img/stok-logo-5.png') }}" width="50px" alt="">

        </div>
        <div class="sidebar-brand-text mx-3">{{ Auth::user()->user_role }} <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->

    {{-- <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Utilities Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        All Data
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @if (Auth::user()->user_role === 'Pegawai')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Kelola Arsip</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Arsip :</h6>
                    <a class="collapse-item" href="{{ route('KelolaArsipDataBaru') }}">Kelola Arsip Baru</a>
                    <a class="collapse-item" href="{{ route('kelola-data-arsip-lama') }}">Kelola Arsip Lama</a>
                </div>
            </div>
        </li>
    @endif

    {{-- <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> --}}

    <!-- Nav Item - Tables -->
    @if (Auth::user()->user_role === 'Pegawai')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('data-pasangan') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Pasangan</span></a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('data-pernikahan') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Akta Pernikahan</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('data-arsip-pernikahan') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Arsip Pernikahan</span></a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('data-jadwal-pasangan') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Jadwal Pasangan</span></a>
        </li>
    @elseif(Auth::user()->user_role === 'Penghulu')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('data-jadwal-pasangan') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Jadwal Pasangan</span></a>
        </li>
    @endif


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">


    @if (Auth::user()->user_role === 'Pegawai' || Auth::user()->user_role === 'Kepala-KUA')
        <div class="sidebar-heading">
            Laporan
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('laporan-arsip') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Laporan Arsip</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('laporan-pernikahan') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Laporan Data Pernikahan</span></a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
    @endif

    @if (Auth::user()->user_role === 'Pegawai')
        <div class="sidebar-heading">
            Register Pegawai
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register-pegawai') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Register Akun</span></a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
    @endif

    <div class="sidebar-heading">
        Profile
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{route('profile')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span></a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
