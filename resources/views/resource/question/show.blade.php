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
                        <a href="{{ route('exam.show', [$material, $exam]) }}"
                           class="btn btn-light border"
                        >
                            <x-heroicon-s-arrow-left height="20" width="20"/>
                            {{ __('Back') }}
                        </a>

                        <button class="btn btn-danger"
                                onclick="handleDeleteQuestion()"
                        >
                            <x-heroicon-o-trash height="20" width="20"/>
                            {{ __('Delete') }}
                        </button>

                        <a href="{{ route('question.edit', [$material, $exam, $question]) }}"
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
                                <label for="text" class="form-label">
                                    {{ __('Question') }}
                                </label>
                                <input
                                    type="text"
                                    class="form-control {{ $errors->first('text') != null ? 'is-invalid' : '' }}"
                                    id="text"
                                    name="text"
                                    value="{{ old('text', $question->text) }}"
                                    maxlength="255"
                                    disabled
                                >
                                <div class="invalid-feedback">
                                    {{ $errors->first('text') }}
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
                    <h2 class="card-title m-0">Daftar Pilihan</h2>
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
                                    Pilihan
                                </div>
                            </div>
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if(count($question->options))
                        <div class="table-responsive">
                            <table class="table table-hover m-0 align-middle">
                                <thead>
                                <tr>
                                    <th class="bg-body-tertiary text-center ps-4" scope="col" width="5%">No</th>
                                    <th class="bg-body-tertiary" scope="col">Label</th>
                                    <th class="bg-body-tertiary text-center" scope="col">Status</th>
                                    <th class="bg-body-tertiary pe-4" scope="col" width="15%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($question->options as $index => $option)
                                    <tr class="align-middle">
                                        <th class="text-nowrap text-center ps-4">{{ $index + 1 }}</th>
                                        <td class="text-nowrap">{{ $option->label }}</td>
                                        <td class="text-nowrap text-center">{{ $option->is_correct ? 'Benar' : 'Salah' }}</td>
                                        <td class="text-nowrap text-end pe-4">
                                            <div class="d-flex justify-content-end gap-2">
                                                <div class="dropdown d-flex">
                                                    <a class="text-decoration-none fw-bold text-primary d-flex align-items-center gap-1"
                                                       href="#"
                                                       role="button"
                                                       data-coreui-toggle="dropdown" aria-expanded="false"
                                                    >
                                                        <x-heroicon-c-ellipsis-vertical
                                                            style="height: 20px;width: 20px"/>
                                                    </a>

                                                    <ul class="dropdown-menu mt-2"
                                                        style="font-size: 14px; min-width: 200px">
                                                        <li>
                                                            <a class="text-decoration-none fw-bold d-flex align-items-center gap-2 dropdown-item text-secondary"
                                                               href="{{ route('option.edit', $option->id) }}"
                                                            >
                                                                <x-heroicon-m-pencil-square
                                                                    style="height: 20px;width: 20px"/>
                                                                Ubah
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <button
                                                                class="text-decoration-none fw-bold text-danger d-flex align-items-center gap-2 dropdown-item"
                                                                onclick="handleDeleteOption({{ $option->id }})"
                                                            >
                                                                <x-heroicon-m-trash
                                                                    style="height: 20px;width: 20px"/>
                                                                Hapus
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
                <form action="{{ route('option.store',  $question) }}" method="post">
                    @csrf

                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="createModalLabel">{{ __('Add Option') }}</h5>
                        <button type="reset" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-0">
                        <div class="mb-3">
                            <label for="label" class="form-label required">
                                {{ __('Label') }}
                            </label>
                            <input
                                type="text"
                                class="form-control {{ $errors->first('label') != null ? 'is-invalid' : '' }}"
                                id="label"
                                name="label"
                                value="{{ old('label') }}"
                                maxlength="255"
                                required
                            >
                            <div class="invalid-feedback">
                                {{ $errors->first('label') }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="label" class="form-label required">
                                {{ __('Status') }}
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="is_correct"
                                        id="is_correct1"
                                        value="1"
                                        checked
                                    >
                                    <label class="form-check-label" for="is_correct1">
                                        Benar
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="is_correct"
                                        id="is_correct2"
                                        value="0"
                                    >
                                    <label class="form-check-label" for="is_correct2">
                                        Salah
                                    </label>
                                </div>
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

    @php $option = session('option') @endphp
    @if($option != null)
        <div class="modal fade" id="editModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
             aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('option.update', $option) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="editModalLabel">{{ __('Edit Option') }}</h5>
                            <button type="reset" class="btn-close" data-coreui-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>

                        <div class="modal-body py-0">
                            <div class="mb-3">
                                <label for="edit_label" class="form-label required">
                                    {{ __('Label') }}
                                </label>
                                <input
                                    type="text"
                                    class="form-control {{ $errors->first('label') != null ? 'is-invalid' : '' }}"
                                    id="edit_label"
                                    name="label"
                                    value="{{ old('label', $option->label) }}"
                                    maxlength="255"
                                    required
                                >
                                <div class="invalid-feedback">
                                    {{ $errors->first('label') }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="label" class="form-label required">
                                    {{ __('Status') }}
                                </label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="is_correct"
                                            id="edit_is_correct1"
                                            value="1"
                                            {{  $option->is_correct == 1 ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label" for="edit_is_correct1">
                                            Benar
                                        </label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="is_correct"
                                            id="edit_is_correct2"
                                            value="0"
                                            {{  $option->is_correct == 0 ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label" for="edit_is_correct2">
                                            Salah
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer border-0 pt-2 justify-content-start">
                            <button type="submit" class="btn btn-primary my-0">
                                <x-fas-save height="20" width="20"/>
                                {{ __('Save') }}
                            </button>
                            <button type="reset" class="btn btn-secondary my-0"
                                    data-coreui-dismiss="modal">{{ __('Cancel') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('script')
    {!! session('script') !!}

    <script>
        function handleDeleteQuestion() {
            new Swal({
                title: "Hapus Soal",
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
                    let url = `{{ route('question.destroy', [$material, $exam, $question]) }}`;
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

        function handleDeleteOption(id) {
            new Swal({
                title: "Hapus Pilihan?",
                text: "Apakah Anda yakin ingin melakukan ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Batal",
                buttonsStyling: false,
                customClass: {
                    confirmButton: "btn btn-danger text-white",
                    cancelButton: "btn btn-secondary ms-2"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = `{{ route('option.destroy', ['']) }}/${id}`;
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
