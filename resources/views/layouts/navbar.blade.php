<nav class="navbar navbar-header navbar-expand navbar-light">
    <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
    <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
            <li class="dropdown">
                <a href="#" data-bs-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="d-none d-md-block d-lg-inline-block">Hi, {{ Auth::user()->name }} <i data-feather="chevron-down"></i></div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ url('profile') }}"><i data-feather="user" ></i> Account</a>
                    <div class="dropdown-divider" ></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
    
                        <a class="dropdown-item"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    this.closest('form').submit();"><i data-feather="log-out"></i>{{ __('Logout') }}</a>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>