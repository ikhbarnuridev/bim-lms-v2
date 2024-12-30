@extends('layouts.app')

@section('content')
    <x-section.my-account>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-2">{{ __('Profile') }}</h2>
                <p class="text-muted small">
                    Kelola data diri Anda untuk komunikasi dan personalisasi sistem.
                </p>

                <form action="{{ route('my-account.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3 row">
                                <label for="name" class="col-sm-3 col-form-label">
                                    {{ __('Full Name') }}
                                </label>
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control {{ $errors->first('name') != null ? 'is-invalid' : '' }}"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') ?? $user->name }}"
                                        maxlength="255"
                                    >
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3 row">
                                <label for="nis" class="col-sm-3 col-form-label">
                                    {{ __('NIS') }}
                                </label>
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control {{ $errors->first('nis') != null ? 'is-invalid' : '' }}"
                                        id="nis"
                                        name="nis"
                                        value="{{ old('nis') ?? $user->student->nis }}"
                                        disabled
                                    >
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nis') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3 row">
                                <label for="photo" class="col-sm-3 col-form-label">
                                    {{ __('Photo') }}
                                </label>
                                <div class="col-sm-6">
                                    <div class="d-flex flex-column flex-lg-row align-items-center">
                                        <img class="avatar avatar-80 me-3 mb-3 mb-lg-0"
                                             src="{{ auth()->user()->getPhotoUrl() }}"
                                             alt="{{ auth()->user()->name }}"
                                        >
                                        <div>
                                            <input
                                                type="file"
                                                class="form-control {{ $errors->first('photo') != null ? 'is-invalid' : '' }}"
                                                id="photo"
                                                name="photo"
                                                value="{{ old('photo') ?? $user->photo }}"
                                                maxlength="255"
                                            >
                                            <div class="invalid-feedback">
                                                {{ $errors->first('photo') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-section.my-account>
@endsection
