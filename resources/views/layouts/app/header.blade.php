<header class="header header-sticky p-0 shadow-bottom border-0">
    <div class="container-fluid" style="max-height: 84px">
        <button class="btn no-outline m-0 p-0" type="button"
                onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"
                style="margin-inline-start: -14px;">
            <x-heroicon-o-bars-3 height="30" width="30"/>
        </button>

        <ul class="header-nav">
            <li class="nav-item dropdown">
                <a class="nav-link p-0 bg-transparent" data-coreui-toggle="dropdown" href="#"
                   role="button" aria-haspopup="true" aria-expanded="false">
                    <img class="avatar avatar-md"
                         src="{{ auth()?->user()?->getPhotoUrl() }}"
                         alt="{{ Str::limit(auth()?->user()?->name, 20, '') }}"
                    >
                    <small class="ms-2 d-none d-lg-inline">{{ Str::limit(auth()?->user()?->name, 20, '') }}</small>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0 mt-3" style="font-size: 14px">
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

                    <a class="dropdown-item" href="{{ route('my-account.profile') }}">
                        <x-heroicon-o-user class="pb-1" width="24" height="24"/>
                        {{ __('Profile') }}
                    </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('auth.logout') }}">
                        <x-heroicon-o-arrow-left-end-on-rectangle class="pb-1" width="24" height="24"/>
                        {{ __('Logout') }}
                    </a>
                </div>
            </li>
        </ul>
    </div>
</header>
