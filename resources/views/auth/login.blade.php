@extends('layouts.default')

@section('content')
    <x-section.page-title title="Log In"/>

    <main id="login">
        <section id="login-form">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-4 offset-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    BIM LMS
                                    &nbsp;›&nbsp;
                                    Log In
                                </h5>
                                <hr>

                                @if(session()->has('error'))
                                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <x-heroicon-o-exclamation-triangle class="me-2" height="24" width="24"/>
                                        <div>
                                            {{ session()->get('error') }}
                                        </div>
                                    </div>
                                @endif

                                <form action="{{ route('login.submit') }}" method="post">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="username" class="form-label">
                                            Username
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control {{ $errors->first('username') != null ? 'is-invalid' : '' }}"
                                            id="username"
                                            name="username"
                                            value="{{ old('username') }}"
                                        >
                                        <div class="invalid-feedback">
                                            {{ $errors->first('username') }}
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">
                                            Password
                                        </label>
                                        <input
                                            type="password"
                                            class="form-control {{ $errors->first('password') != null ? 'is-invalid' : '' }}"
                                            id="password"
                                            name="password"
                                            value="{{ old('password') }}"
                                        >
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox"
                                               class="form-check-input"
                                               id="rememberMe"
                                               name="remember_me"
                                               value="1"
                                            {{ old('remember_me') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                               for="rememberMe">{{ __('Remember me') }}</label>
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        Log In
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
