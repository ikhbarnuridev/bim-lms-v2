@extends('layouts.app')

@section('content')
    <div class="row row-gap-32">
        <div class="col-12">
            <div class="row row-gap-3">
                <div class="col-12 col-lg-6">
                    <x-section.app.page-title title="{{ $title }}"/>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="d-flex justify-content-lg-end gap-2 flex-wrap">
                        <a href="{{ route('material.index') }}"
                           class="btn btn-light border"
                        >
                            <x-heroicon-s-arrow-left height="20" width="20" />
                            {{ __('Back') }}
                        </a>

                        <a href="{{ route('material.edit', $material) }}"
                           class="btn btn-success"
                        >
                            <x-heroicon-o-pencil-square height="20" width="20" />
                            {{ __('Edit') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
        </div>
    </div>
@endsection
