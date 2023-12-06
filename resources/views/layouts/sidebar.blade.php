<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header fs-2">
            <a href="# ">Futsal Semar</a>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title pt-1'>Main Menu</li>
                <li class="sidebar-item {{ \Route::is('dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ \Route::is('user.*') ? 'active' : '' }}">
                    <a href="{{route('user.index')}}" class='sidebar-link'>
                        <i data-feather="users" width="20"></i>
                        <span>Data User</span>
                    </a>
                </li>
                <li class="sidebar-item {{ \Route::is('lapangan.*') ? 'active' : '' }}">
                    <a href="{{route('lapangan.index')}}" class='sidebar-link'>
                        <i data-feather="octagon" width="20"></i>
                        <span>Lapangan</span>
                    </a>
                </li>
                <li class="sidebar-item {{ \Route::is('booking.*') ? 'active' : '' }}" >
                    <a href="{{route('booking.index')}}" class='sidebar-link'>
                        <i data-feather="clipboard" width="20"></i>
                        <span>Booking</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>