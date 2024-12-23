@extends('layouts.app')

@section('content')
    <x-section.my-account>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-2">{{ __('Profile') }}</h2>
                <p class="text-muted small">
                    Kelola data diri Anda untuk komunikasi dan personalisasi sistem.
                </p>

                <form action="{{ route('my-account.change-password.update') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">
                                    {{ __('Full Name') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputPassword">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">
                                    {{ __('NIS ') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputPassword">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">
                                    {{ __('Photo') }}
                                </label>
                                <div class="col-sm-6">
                                    <div class="d-flex flex-column flex-lg-row align-items-center">
                                        <img class="avatar avatar-80 me-3 mb-3 mb-lg-0"
                                             src="{{ auth()->user()->getPhotoUrl() }}"
                                             alt="{{ auth()->user()->name }}"
                                        >
                                        <input type="file" class="form-control" id="inputPassword">
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
