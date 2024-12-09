<nav class="navbar fixed-top navbar-expand-lg p-lg-0 shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 d-none d-lg-block py-3" href="{{ url()->current() }}"
           style="margin-right: 120px">
            <img src="{{ asset('assets/images/bim-logo.png') }}" alt="" width="62" height="60">
            <span class="fw-semibold">BIM-LMS</span>
        </a>

        <button class="btn no-outline d-lg-none" type="button" data-coreui-toggle="offcanvas"
                data-coreui-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <x-heroicon-o-bars-3 height="30" width="30"/>
        </button>

        <ul class="header-nav d-lg-none">
            <li class="nav-item dropdown">
                <a class="nav-link p-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false">
                    <img class="rounded-circle" src="https://xsgames.co/randomusers/avatar.php?g=pixel" alt=""
                         style="height: 40px;width: 40px">
                    <small class="ms-1 d-none d-lg-inline"></small>
                </a>
                <div class="dropdown-menu dropdown-menu-end mt-3">
                    <a class="dropdown-item" href="{{ route('login') }}">

                        Log in
                    </a>
                </div>
            </li>
        </ul>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
             aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header align-items-center justify-content-between">
                <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                    <img src="{{ asset('assets/images/bim-logo.png') }}" alt="" width="62" height="60">
                    <span class="fw-semibold">BIM-LMS</span>
                </a>
                <button type="button"
                        class="btn no-outline"
                        data-coreui-dismiss="offcanvas"
                >
                    <x-heroicon-o-x-mark height="30" width="30"/>
                </button>
            </div>
            <div class="offcanvas-body px-0 border-top" style="min-height: 92px">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link p-3 {{ request()->is('/') ? 'active' : '' }}" href="{{ route('landing') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-3 {{ request()->is('help') ? 'active' : '' }}" href="{{ route('help') }}">Bantuan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-3 {{ request()->is('faq') ? 'active' : '' }}"
                           href="{{ route('faq') }}">FAQ</a>
                    </li>
                </ul>

                <ul id="login-nav" class="navbar-nav justify-content-end flex-grow-1 mt-5 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link p-3 d-flex gap-2 align-items-center {{ request()->is('auth/login') ? 'active' : '' }}"
                           href="{{ route('login') }}">
                            <x-heroicon-m-arrow-right-start-on-rectangle height="24" width="24"/>
                            Log In
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
