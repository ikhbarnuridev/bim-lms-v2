@extends('layouts.app')

@section('content')
    <div class="row row-gap-32">
        <div class="col-12">
            <div class="row row-gap-3">
                <div class="col-12 col-lg-6">
                    <x-section.app.page-title title="{{ $title }}"/>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="text-lg-end">
                        <a href="{{ route('material.create') }}"
                           class="btn btn-primary"
                        >
                            Tambah
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card border-0">
                <div class="card-header border-0 px-0">
                    <div class="d-flex justify-content-end">
                        <div class="w-100">
                            <form action="{{ url()->current() }}" method="get">
                                <input type="text"
                                       class="form-control w-100"
                                       name="s"
                                       placeholder="Cari"
                                       style="width: 255px"
                                       value="{{ $search }}"
                                >
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="row row-gap-48">
                        @if(!empty($materials) && $materials->count() > 0)
                            @foreach($materials as $index => $material)
                                <div class="col-12 col-md-4 col-xl-3">
                                    <a href="#" class="text-decoration-none">
                                        <x-material.card :material="$material"/>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12 text-center my-5">
                                <img src="{{ asset('assets/images/flat/not-found.png') }}" width="250" alt="Not Found"/>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    {{ $materials->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
