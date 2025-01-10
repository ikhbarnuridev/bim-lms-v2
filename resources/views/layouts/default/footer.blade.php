<footer class="bg-dark text-light">
    <div class="container">
        <div class="row row-gap-5">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <a class="navbar-brand d-flex align-items-center gap-2 py-3" href="{{ url()->current() }}"
                           style="margin-right: 120px">
                            <img src="{{ asset('assets/images/bim-logo.png') }}" alt="" width="62" height="60">
                            <span class="fw-semibold fs-5">{{ env('APP_NAME') }}</span>
                        </a>
                    </div>
                    <div class="col-12 col-lg-5 mt-5 mt-lg-3 offset-lg-1">
                        <h6 class="fw-bold mb-3 text-uppercase">Tentang Kami</h6>
                        <p class="small">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet distinctio doloremque
                            doloribus error illum laborum numquam quaerat sed tenetur. Cumque distinctio dolorem et
                            fugit hic ipsum maiores nihil quod soluta.
                        </p>
                    </div>
                    <div class="col-12 col-lg-2 mt-4 mt-lg-3 ps-lg-5 offset-lg-1">
                        <h6 class="fw-bold mb-3 text-uppercase">Menu</h6>
                        <div class="row">
                            <div class="col-6 col-lg-12">
                                <ul class="navbar-nav small">
                                    <li class="nav-item mb-3">
                                        <a class="text-decoration-none text-light" href="{{ route('home') }}">
                                            Beranda
                                        </a>
                                    </li>
                                    <li class="nav-item mb-3">
                                        <a class="text-decoration-none text-light" href="{{ route('help') }}">
                                            Bantuan
                                        </a>
                                    </li>
                                    <li class="nav-item mb-lg-3">
                                        <a class="text-decoration-none text-light" href="{{ route('faq') }}">
                                            FAQ
                                        </a>
                                    </li>

                                    @if(!auth()->user())
                                        <li class="nav-item mb-lg-3">
                                            <a class="text-decoration-none text-light" href="{{ route('auth.login') }}">
                                                Login
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex flex-column flex-lg-row gap-4 justify-content-lg-center border-top pt-5 small">
                    <a class="text-decoration-none text-light" href="{{ route('privacy-policy') }}">Privacy Policy</a>
                    <a class="text-decoration-none text-light" href="{{ route('term-of-service') }}">Term of Service</a>
                    <a class="text-decoration-none text-light" href="{{ route('contact-us') }}">Contact Us</a>
                </div>
            </div>
            <div class="col-12">
                <p class="text-center small">
                    © 2024
                    <a class="text-decoration-none text-light fw-semibold" href="https://bina-iman.com" target="_blank">
                        BINA INSAN MADANI
                    </a>
                    ALL RIGHTS RESERVED.
                </p>
            </div>
        </div>
    </div>
</footer>
