@extends('layouts.app')

@section('content')
    <div class="row row-gap-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <img class="avatar avatar-md me-3"
                             src="{{ auth()?->user()?->getPhotoUrl() }}"
                             alt="{{ auth()?->user()?->name }}"
                        >
                        <div class="d-flex flex-column">
                            <h2 class="fw-bold m-0" style="font-size: 16px">Selamat Datang</h2>
                            <p class="m-0" style="font-size: 14px">{{ auth()->user()->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4 col-xxl-3">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="py-4 px-5 me-3 text-white bg-primary">
                        <x-heroicon-o-users height="24" width="24"/>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">{{ rand(0, 100) }}</div>
                        <div class="text-body-secondary text-uppercase fw-semibold small">
                            {{ __('Student') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4 col-xxl-3">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="py-4 px-5 me-3 text-white bg-primary">
                        <x-heroicon-o-book-open height="24" width="24"/>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">{{ rand(0, 100) }}</div>
                        <div class="text-body-secondary text-uppercase fw-semibold small">
                            {{ __('Material') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4 col-xxl-3">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="py-4 px-5 me-3 text-white bg-primary">
                        <x-heroicon-o-pencil height="24" width="24"/>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">{{ rand(0, 100) }}</div>
                        <div class="text-body-secondary text-uppercase fw-semibold small">
                            {{ __('Exercise') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4 col-xxl-3">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="py-4 px-5 me-3 text-white bg-primary">
                        <x-heroicon-o-document-text height="24" width="24"/>
                    </div>
                    <div>
                        <div class="fs-6 fw-semibold text-primary">{{ rand(0, 100) }}</div>
                        <div class="text-body-secondary text-uppercase fw-semibold small">
                            {{ __('Question') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
