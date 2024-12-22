<nav class="navbar fixed-top navbar-expand-lg p-lg-0 shadow-bottom bg-white" style="min-height: 64px">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 d-none d-lg-block py-3" href="{{ url()->current() }}"
           style="margin-right: 120px">
            <img src="{{ asset('assets/images/bim-logo.png') }}" alt="" width="62" height="60">
            <span class="fw-semibold">BIM LMS</span>
        </a>

        <button class="btn no-outline px-0 d-lg-none" type="button" data-coreui-toggle="offcanvas"
                data-coreui-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <x-heroicon-o-bars-3 height="30" width="30"/>
        </button>

        @if(auth()->user())
            <ul class="header-nav d-lg-none">
                <li class="nav-item dropdown">
                    <a class="nav-link p-0 rounded-circle bg-transparent" data-coreui-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true"
                       aria-expanded="false">
                        <img class="avatar avatar-md" src="{{ auth()?->user()?->getPhotoUrl() }}" alt="Photo Profile">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pt-0 mt-3">
                        <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top"
                             style="width: 200px;">
                            Akun
                        </div>

                        <div class="px-3 mt-2">
                            <div class="d-flex flex-column">
                                <span class="fw-bold"
                                      style="font-size: 14px;">{{ Str::limit(auth()?->user()?->name, 20, '') }}</span>
                                <span class="small">{{ auth()?->user()?->email }}</span>
                                <span class="small">{{ auth()?->user()?->getRoleNames()[0] }}</span>
                            </div>
                        </div>

                        <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2">
                            <div class="fw-semibold">Pengaturan</div>
                        </div>

                        <a class="dropdown-item" href="{{ route('my-home') }}">
                            <x-heroicon-o-home class="pb-1" height="24" width="24"/>
                            {{ __('My Home') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <x-heroicon-o-user class="pb-1" width="24" height="24"/>
                            {{ __('Profile') }}
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <x-heroicon-o-arrow-left-end-on-rectangle class="pb-1" width="24" height="24"/>
                            {{ __('Logout') }}
                        </a>
                    </div>
                </li>
            </ul>
        @endif

        <div class="offcanvas offcanvas-start border-0" tabindex="-1" id="offcanvasNavbar"
             aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header align-items-center justify-content-between shadow-bottom" style="height: 102px">
                <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                    <img src="{{ asset('assets/images/bim-logo.png') }}" alt="" width="62" height="60">
                    <span class="fw-semibold">BIM LMS</span>
                </a>
                <button type="button"
                        class="btn no-outline px-0"
                        data-coreui-dismiss="offcanvas"
                >
                    <x-heroicon-o-x-mark height="30" width="30"/>
                </button>
            </div>
            <div class="offcanvas-body" style="min-height: 92px">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link p-3 {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
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
                    @if(auth()->user())
                        <li class="nav-item dropdown d-none d-lg-flex align-items-center justify-content-center">
                            <a class="nav-link p-0 bg-transparent" data-coreui-toggle="dropdown" href="#"
                               role="button"
                               aria-haspopup="true"
                               aria-expanded="false">
                                <img class="avatar avatar-md" src="{{ auth()?->user()?->getPhotoUrl() }}"
                                     alt="Photo Profile">
                                <small class="ms-2 d-none d-lg-inline">{{ Str::limit(auth()?->user()?->name, 20, '') }}</small>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end pt-0 mt-2">
                                <div
                                    class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top"
                                    style="width: 200px;">
                                    Akun
                                </div>

                                <div class="px-3 mt-2">
                                    <div class="d-flex flex-column">
                                <span class="fw-bold"
                                      style="font-size: 14px;">{{ Str::limit(auth()?->user()?->name, 20, '') }}</span>
                                        <span class="small">{{ auth()?->user()?->email }}</span>
                                        <span class="small">{{ auth()?->user()?->getRoleNames()[0] }}</span>
                                    </div>
                                </div>

                                <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2">
                                    <div class="fw-semibold">Pengaturan</div>
                                </div>

                                <a class="dropdown-item" href="{{ route('my-home') }}">
                                    <x-heroicon-o-home class="pb-1" height="24" width="24"/>
                                    {{ __('My Home') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <x-heroicon-o-user class="pb-1" width="24" height="24"/>
                                    {{ __('Profile') }}
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <x-heroicon-o-arrow-left-end-on-rectangle class="pb-1" width="24" height="24"/>
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>

                        <li class="nav-item d-lg-none">
                            <a class="nav-link p-3 {{ request()->is('auth/login') ? 'active' : '' }}"
                               href="{{ route('login') }}">
                                <x-heroicon-o-home class="me-2" height="24" width="24"/>
                                {{ __('My Home') }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link p-3 {{ request()->is('auth/login') ? 'active' : '' }}"
                               href="{{ route('login') }}">
                                <x-heroicon-m-arrow-right-start-on-rectangle class="me-2" height="24" width="24"/>
                                Login
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>
