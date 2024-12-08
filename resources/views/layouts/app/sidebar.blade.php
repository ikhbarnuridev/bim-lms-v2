<aside class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header w-100 border-0" style="height: 84px">
        <div class="sidebar-brand m-auto">
            <a class="sidebar-brand-full d-flex align-items-center text-decoration-none"
               href="{{ url()->current() }}"
               tabindex="-1"
            >
                <img src="{{ asset('assets/images/logo.png') }}" height="36" alt="Logo"/>
                <span class="ms-2 fw-bold text-warning" style="font-size: 1.6rem">
                    Logo
                </span>
            </a>
            <div class="sidebar-brand-narrow">
                <img src="{{ asset('assets/images/logo.png') }}" height="20" alt="Logo"/>
            </div>
        </div>
    </div>

    <ul class="sidebar-nav p-3" data-coreui="navigation" tabindex="-1">
        <li class="nav-item">
            <a class="nav-link @if(request()->is('dashboard')) active @endif"
               href="#"
            >
                <x-heroicon-o-home class="me-2" height="24" width="24"/>
                {{ __('Home') }}
            </a>
        </li>
    </ul>
</aside>
