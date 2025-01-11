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

                        <a href="{{ route('article.edit', [$material, $article]) }}"
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
                                    value="{{ old('title', $article->title) }}"
                                    maxlength="255"
                                    disabled
                                >
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="content" class="form-label">
                                    {{ __('Content') }}
                                </label>
                                <div>
                                    {!! old('content', $article->content) !!}
                                </div>
                                <div class="invalid-feedback">
                                    {{ $errors->first('content') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {!! session('script') !!}

    <script>
        function handleDelete() {
            new Swal({
                title: "Hapus Artikel",
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
                    let url = `{{ route('article.destroy', [$material, $article]) }}`;
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
