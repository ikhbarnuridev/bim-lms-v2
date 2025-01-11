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

                        <button class="btn btn-danger"
                                onclick="handleDelete()"
                        >
                            <x-heroicon-o-trash height="20" width="20"/>
                            {{ __('Delete') }}
                        </button>

                        <a href="{{ route('exam.edit', [$material, $exam]) }}"
                           class="btn btn-success"
                        >
                            <x-heroicon-o-pencil-square height="20" width="20"/>
                            {{ __('Edit') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="title" class="form-label">
                                    {{ __('Title') }}
                                </label>
                                <input
                                    type="text"
                                    class="form-control {{ $errors->first('title') != null ? 'is-invalid' : '' }}"
                                    id="title"
                                    name="title"
                                    value="{{ old('title', $exam->title) }}"
                                    maxlength="255"
                                    disabled
                                >
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="duration" class="form-label">
                                {{ __('Duration') }}
                            </label>
                            <div class="input-group mb-3">
                                <input
                                    type="number"
                                    class="form-control {{ $errors->first('duration') != null ? 'is-invalid' : '' }}"
                                    id="duration"
                                    name="duration"
                                    value="{{ old('duration', $exam->duration) }}"
                                    min="1"
                                    disabled
                                >
                                <span class="input-group-text">Menit</span>
                                <div class="invalid-feedback">
                                    {{ $errors->first('duration') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title m-0">Daftar Soal</h2>
                </div>
                <div class="card-header">
                    <div class="d-flex justify-content-lg-center gap-2 flex-wrap">
                        <button
                            class="text-decoration-none btn btn-primary flex-fill"
                            style="width: 100px;height: 100px"
                            data-coreui-toggle="modal"
                            data-coreui-target="#createModal"
                        >
                            <div class="h-100 d-flex flex-column justify-content-center align-items-center">
                                <x-heroicon-o-plus height="40" width="40"/>
                                <div class="small mt-1">
                                    <span>Tambah</span>
                                    Soal
                                </div>
                            </div>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    @if(count($exam->questions))
                        <div class="row row-gap-2">
                            @foreach($exam->questions as $question)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row row-gap-24">
                                                <div class="col-12 col-lg-10">
                                                    <div
                                                        class="text-primary d-flex flex-row align-items-center small">
                                                            <span class="me-2">
                                                                <x-heroicon-o-question-mark-circle height="24" width="24"/>
                                                            </span>
                                                        <div>{{ $question->text }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <div class="d-flex justify-content-lg-end gap-2 flex-wrap">
                                                <button class="btn btn-secondary flex-fill flex-lg-grow-0"
                                                        onclick="handleDelete({{ $material->id }})"
                                                >
                                                    <x-heroicon-o-arrow-path height="20" width="20"/>
                                                    {{ __('Reorder') }}
                                                </button>

                                                <a class="btn btn-info flex-fill flex-lg-grow-0"
                                                   href="{{ route('question.show', [$material, $exam, $question]) }}"
                                                >
                                                    <x-heroicon-o-eye height="20" width="20"/>
                                                    {{ __('See') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <x-section.empty-state/>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" data-coreui-backdrop="static" data-coreui-keyboard="false"
         tabindex="-1"
         aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('question.store', [$material, $exam]) }}" method="post">
                    @csrf

                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="createModalLabel">{{ __('Add Question') }}</h5>
                        <button type="reset" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-0">
                        <div class="mb-3">
                            <label for="text" class="form-label required">
                                {{ __('Question') }}
                            </label>
                            <input
                                type="text"
                                class="form-control {{ $errors->first('text') != null ? 'is-invalid' : '' }}"
                                id="text"
                                name="text"
                                value="{{ old('text') }}"
                                maxlength="255"
                            >
                            <div class="invalid-feedback">
                                {{ $errors->first('text') }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-2 justify-content-start">
                        <button type="submit" class="btn btn-primary my-0">
                            <x-fas-save height="20" width="20"/>
                            {{ __('Save') }}
                        </button>
                        <button type="reset" class="btn btn-secondary my-0"
                                data-coreui-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {!! session('script') !!}

    <script>
        function handleDelete() {
            new Swal({
                title: "Hapus Latihan",
                text: "Apakah Anda yakin ingin melakukan ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Konfirmasi",
                cancelButtonText: "Batal",
                buttonsStyling: false,
                customClass: {
                    confirmButton: "btn btn-danger text-white",
                    cancelButton: "btn btn-secondary ms-2"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = `{{ route('exam.destroy', [$material, $exam]) }}`;
                    let form = document.createElement('form');
                    form.setAttribute('method', 'post');
                    form.setAttribute('action', url);

                    let csrfField = document.createElement('input');
                    csrfField.setAttribute('type', 'hidden');
                    csrfField.setAttribute('name', '_token');
                    csrfField.setAttribute('value', $('meta[name="csrf-token"]').attr('content'));
                    form.appendChild(csrfField);

                    let methodField = document.createElement('input');
                    methodField.setAttribute('type', 'hidden');
                    methodField.setAttribute('name', '_method');
                    methodField.setAttribute('value', 'DELETE');
                    form.appendChild(methodField);

                    document.body.appendChild(form);
                    form.submit();
                } else {
                    swal.close();
                }
            });
        }
    </script>
@endpush
