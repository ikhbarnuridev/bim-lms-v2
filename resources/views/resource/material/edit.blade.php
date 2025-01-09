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
                    <form action="{{ route('material.update', $material) }}" method="post" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('put')

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
                                        value="{{ old('title', $material->title) }}"
                                        required
                                    >
                                    <div class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label required">
                                        {{ __('Description') }}
                                    </label>
                                    <textarea
                                        type="text"
                                        class="form-control {{ $errors->first('description') != null ? 'is-invalid' : '' }}"
                                        id="description"
                                        name="description"
                                        rows="3"
                                        required
                                    >{{ old('description', $material->description) }}</textarea>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="cover" class="form-label">
                                        {{ __('Cover') }}
                                    </label>
                                    <img src="{{ $material->getCoverUrl() }}"
                                         class="card-img-top border border-bottom-0"
                                         alt="Cover"
                                         style="max-height: 400px"
                                    >
                                    <input
                                        type="file"
                                        class="form-control {{ $errors->first('cover') != null ? 'is-invalid' : '' }} rounded-top-0"
                                        id="cover"
                                        name="cover"
                                        value="{{ old('cover') }}"
                                    >
                                    <div class="invalid-feedback">
                                        {{ $errors->first('cover') }}
                                    </div>
                                </div>
                            </div>

                            @if(auth()->user()->isAdmin())
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="teacher_id" class="form-label required">
                                            {{ __('Teacher') }}
                                        </label>
                                        <select
                                            class="form-select {{ $errors->first('teacher_id') != null ? 'is-invalid' : '' }}"
                                            id="teacher_id"
                                            name="teacher_id"
                                            required
                                        >
                                            <option value="" selected>Pilih salah satu opsi</option>

                                            @foreach($teachers as $teacher)
                                                <option
                                                    value="{{ $teacher->id }}"
                                                    @if(old('teacher_id', $material->teacher_id) == $teacher->id)
                                                        selected
                                                    @endif
                                                >
                                                    {{ $teacher->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('teacher_id') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">
                                <x-fas-save height="20" width="20" />
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
