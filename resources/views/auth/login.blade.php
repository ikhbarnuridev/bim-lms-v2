@extends('layouts.default')

@section('content')
    <main id="login">
        <section id="login-form">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-4 offset-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center mb-5 fw-bold">
                                    Login
                                </h4>

                                @if(session()->has('error'))
                                    <x-alert.danger message="{{ session()->get('error') }}" />
                                @endif

                                <form action="{{ route('auth.login.submit') }}" method="post">
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

                                    <button type="submit" class="btn btn-primary w-100">
                                        Login
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
