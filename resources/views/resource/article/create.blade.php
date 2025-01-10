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
                    <form action="{{ route('article.store', $material) }}" method="post" novalidate>
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
                                <div class="mb-3">
                                    <label for="content" class="form-label required">
                                        {{ __('Content') }}
                                    </label>
                                    <textarea
                                        class="form-control {{ $errors->first('content') != null ? 'is-invalid' : '' }}"
                                        id="content"
                                        name="content"
                                        required
                                    >{{ old('content') }}</textarea>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('content') }}
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

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.6.0/tinymce.min.js"
            integrity="sha512-/4EpSbZW47rO/cUIb0AMRs/xWwE8pyOLf8eiDWQ6sQash5RP1Cl8Zi2aqa4QEufjeqnzTK8CLZWX7J5ZjLcc1Q=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
            tinymce.init({
                selector: '#content',
                licensee_key: 'gpl',
                preview_styles: 'font-size color',
                plugins: 'link image media code autolink lists media table',
                toolbar: 'undo redo | styleselect| forecolor  | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image media| code table',
                toolbar_mode: 'floating',
                image_title: true,
                tinycomments_mode: 'embedded',
                tinycomments_author: '{{ auth()->user()->name }}',
            });
        });
    </script>
@endpush
