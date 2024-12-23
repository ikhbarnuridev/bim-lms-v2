@extends('layouts.app')

@section('content')
    <x-section.my-account>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-2">{{ __('Change Password') }}</h2>
                <p class="text-muted small">
                    Ubah password yang Anda gunakan untuk masuk ke aplikasi. Kata sandi ini harus terdiri dari
                    setidaknya 8 karakter.
                </p>

                <form action="{{ route('my-account.change-password.update') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-12 col-lg-4">
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
                        </div>

                        <div class="col-12 col-lg-4">
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
                        </div>

                        <div class="col-12 col-lg-4">
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
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-section.my-account>
@endsection
