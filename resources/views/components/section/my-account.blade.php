<section class="my-account">
    <div class="row row-gap-32">
        <div class="col-12">
            <x-section.app.page-title title="{{ __('My Account') }}"/>
        </div>
        <div class="col-12">
            <div class="row row-gap-32">
                <div class="col-12 col-lg-3">
                    <ul class="sidebar-nav">
                        <li class="nav-item">
                            <a class="nav-link py-3 @if(request()->is('my-account/profile')) active @endif"
                               href="{{ route('my-account.profile') }}"
                            >
                                <x-heroicon-o-user class="me-2" height="24" width="24"/>
                                {{ __('Profile') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link py-3 @if(request()->is('my-account/change-password')) active @endif"
                               href="{{ route('my-account.change-password') }}"
                            >
                                <x-heroicon-o-key class="me-2" height="24" width="24"/>
                                {{ __('Change Password') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-lg-9">
                    <section class="slot">
                        {{ $slot }}
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>
