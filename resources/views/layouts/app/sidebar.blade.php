<aside class="sidebar sidebar-fixed bg-primary" id="sidebar">
    <div class="sidebar-header" style="min-height: 64px">
        <div class="sidebar-brand">
            <a class="sidebar-brand-full d-flex align-items-center text-decoration-none m-0"
               href="{{ url()->current() }}"
               tabindex="-1"
            >
                <img src="{{ asset('assets/images/bim-logo.png') }}" alt="Logo"/>
                <span class="ms-2 fw-semibold text-light" style="font-size: 20px">
                    BIM LMS
                </span>
            </a>

            <div class="sidebar-brand-narrow">
                <img src="{{ asset('assets/images/bim-logo.png') }}" height="20" alt="Logo"/>
            </div>
        </div>

        <button class="btn no-outline px-0 d-lg-none text-light" type="button" data-coreui-dismiss="offcanvas"
                data-coreui-theme="dark"
                aria-label="Close"
                onclick="coreui.Sidebar.getInstance(document.querySelector(&quot;#sidebar&quot;)).toggle()">
            <x-heroicon-o-x-mark height="30" width="30"/>
        </button>
    </div>

    <ul class="sidebar-nav" data-coreui="navigation" tabindex="-1" style="padding: 32px 0;">
        <li class="nav-item">
            <a class="nav-link py-3 @if(request()->is('my-home')) active @endif"
               href="{{ route('my-home') }}"
            >
                <x-heroicon-o-home class="me-2" height="24" width="24"/>
                {{ __('Home') }}
            </a>
        </li>

        <li class="nav-title">Manajemen Data</li>

        <li class="nav-item">
            <a class="nav-link py-3 @if(request()->is('student*')) active @endif"
               href="{{ route('student.index') }}"
            >
                <x-heroicon-o-users class="me-2" height="24" width="24"/>
                {{ __('Student') }}
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link py-3 @if(request()->is('material*')) active @endif"
               href="{{ route('material.index') }}"
            >
                <x-heroicon-o-book-open class="me-2" height="24" width="24"/>
                {{ __('Material') }}
            </a>
        </li>

        <li class="nav-title">Bantuan dan Referensi</li>

        <li class="nav-item">
            <a class="nav-link py-3 @if(request()->is('guide*')) active @endif"
               href="#"
            >
                <x-heroicon-o-information-circle class="me-2" height="24" width="24"/>
                {{ __('User Guide') }}
            </a>
        </li>
    </ul>
</aside>
