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
                        <a href="{{ route('material.index') }}"
                           class="btn btn-light me-2  border"
                        >
                            {{ __('Back') }}
                        </a>

                        <a href="{{ route('material.edit', $material) }}"
                           class="btn btn-success"
                        >
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
