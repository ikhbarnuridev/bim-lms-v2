@extends('layouts.app')

@section('content')
    <div class="row row-gap-24">
        <div class="col-12">
            <div class="row row-gap-3">
                <div class="col-12 col-lg-6">
                    <x-section.app.page-title title="{{ $title }}"/>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="d-flex justify-content-lg-end gap-2 flex-wrap">
                        <a href="{{ route('material.show', $material) }}"
                           class="btn btn-light border"
                        >
                            <x-heroicon-s-arrow-left height="20" width="20"/>
                            {{ __('Back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('exam.store', $material) }}" method="post" novalidate>
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label required">
                                        {{ __('Title') }}
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control {{ $errors->first('title') != null ? 'is-invalid' : '' }}"
                                        id="title"
                                        name="title"
                                        value="{{ old('title') }}"
                                        maxlength="255"
                                    >
                                    <div class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="duration" class="form-label required">
                                    {{ __('Duration') }}
                                </label>
                                <div class="input-group mb-3">
                                    <input
                                        type="number"
                                        class="form-control {{ $errors->first('duration') != null ? 'is-invalid' : '' }}"
                                        id="duration"
                                        name="duration"
                                        value="{{ old('duration', 1) }}"
                                        min="1"
                                    >
                                    <span class="input-group-text">Menit</span>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('duration') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">
                                <x-fas-save height="20" width="20"/>
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
