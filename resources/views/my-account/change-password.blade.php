@extends('layouts.app')

@section('content')
    <x-section.my-account>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-2">{{ __('Change Password') }}</h2>
                <p class="text-muted small">
                    Ubah password yang Anda gunakan untuk masuk ke aplikasi. Password harus terdiri dari
                    setidaknya 8 karakter.
                </p>

                <form action="{{ route('my-account.change-password.update') }}" method="post">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="password" class="form-label required">
                                    {{ __('New Password') }}
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

                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label required">
                                    {{ __('Password Confirmation') }}
                                </label>
                                <input
                                    type="password"
                                    class="form-control {{ $errors->first('password_confirmation') != null ? 'is-invalid' : '' }}"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    value="{{ old('password_confirmation') }}"
                                >
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary">
                            <x-fas-save height="20" width="20"/>
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-section.my-account>
@endsection
