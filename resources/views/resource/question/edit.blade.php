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
                        <a href="{{ route('question.show', [$material, $exam, $question]) }}"
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
                    <form action="{{ route('question.update', [$material, $exam, $question]) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="text" class="form-label required">
                                        {{ __('Question') }}
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control {{ $errors->first('text') != null ? 'is-invalid' : '' }}"
                                        id="text"
                                        name="text"
                                        value="{{ old('text', $question->text) }}"
                                        maxlength="255"
                                        required
                                    >
                                    <div class="invalid-feedback">
                                        {{ $errors->first('text') }}
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
