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
                        <a href="{{ route('material.index') }}"
                           class="btn btn-light border"
                        >
                            <x-heroicon-s-arrow-left height="20" width="20"/>
                            {{ __('Back') }}
                        </a>

                        <button class="btn btn-danger"
                                onclick="handleDelete({{ $material->id }})"
                        >
                            <x-heroicon-o-trash height="20" width="20"/>
                            {{ __('Delete') }}
                        </button>

                        <a href="{{ route('material.edit', $material) }}"
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
            <div class="card h-100">
                @if(auth()->user()->isStudent())
                    @if($material->isDone())
                        <div class="ribbon"><span>Selesai</span></div>
                    @endif
                @endif

                <img src="{{ $material->getCoverUrl() }}"
                     class="card-img-top"
                     alt="Cover"
                     style="max-height: 400px"
                >

                <div class="card-body">
                    <h5 class="card-title" style="font-size: 21px">
                        {{ $material->title }}
                    </h5>
                    <p class="card-text small">
                        {{ $material->description }}
                    </p>
                </div>

                <div class="card-footer border">
                    <div class="d-flex align-items-center">
                        <img class="avatar avatar-md me-3"
                             src="{{ $material->teacher->getPhotoUrl() }}"
                             alt="{{ Str::limit($material->teacher->name, 20, '')  }}"
                        >
                        <div class="d-flex flex-column">
                            <span class="small">{{ Str::limit($material->teacher->name, 20, '') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title m-0">Daftar Konten</h2>
                </div>
                <div class="card-header">
                    <div class="d-flex justify-content-lg-center gap-2 flex-wrap">
                        <a
                            href="{{ route('article.create', $material) }}"
                            class="text-decoration-none btn btn-primary flex-fill"
                            style="width: 100px;height: 100px"
                        >
                            <div class="h-100 d-flex flex-column justify-content-center align-items-center">
                                <x-heroicon-o-plus height="40" width="40"/>
                                <div class="small mt-1">
                                    <span>Tambah</span>
                                    Artikel
                                </div>
                            </div>
                        </a>

                        <button
                            class="text-decoration-none btn btn-primary flex-fill"
                            style="width: 100px;height: 100px"
                            data-coreui-toggle="modal"
                            data-coreui-target="#fileUploadModal"
                        >
                            <div class="h-100 d-flex flex-column justify-content-center align-items-center">
                                <x-heroicon-o-plus height="40" width="40"/>
                                <div class="small mt-1">
                                    <span>Upload</span>
                                    Berkas
                                </div>
                            </div>
                        </button>

                        <a
                            href="{{ route('exam.create', $material) }}"
                            class="text-decoration-none btn btn-primary flex-fill"
                            style="width: 100px;height: 100px"
                        >
                            <div class="h-100 d-flex flex-column justify-content-center align-items-center">
                                <x-heroicon-o-plus height="40" width="40"/>
                                <div class="small mt-1">
                                    <span>Tambah</span>
                                    Latihan
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(count($material->contents))
                        <div class="row row-gap-2">
                            @foreach($material->contents as $content)
                                <div class="col-12">
                                    @if($content->type == 'article')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row row-gap-24">
                                                    <div class="col-12 col-lg-10">
                                                        <div
                                                            class="text-primary d-flex flex-row align-items-center small">
                                                            <span class="me-2">
                                                                <x-heroicon-o-document-text height="24" width="24"/>
                                                            </span>
                                                            <div>{{ $content->article->title }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <div class="d-flex justify-content-lg-end gap-2 flex-wrap">
                                                    <a class="btn btn-secondary flex-fill flex-lg-grow-0"
                                                       href="{{ route('content.order.edit', $content) }}"
                                                    >
                                                        <x-heroicon-o-arrow-path height="20" width="20"/>
                                                        {{ __('Reorder') }}
                                                    </a>

                                                    <a class="btn btn-info flex-fill flex-lg-grow-0"
                                                       href="{{ route('article.show', [$material, $content->article]) }}"
                                                    >
                                                        <x-heroicon-o-eye height="20" width="20"/>
                                                        {{ __('See') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($content->type == 'file')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row row-gap-24">
                                                    <div class="col-12 col-lg-10">
                                                        <div
                                                            class="text-primary d-flex flex-row align-items-center small">
                                                            <span class="me-2">
                                                                <x-heroicon-o-document-arrow-down
                                                                    height="24"
                                                                    width="24"
                                                                />
                                                            </span>
                                                            <div>{{ $content->file->name }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <div class="d-flex justify-content-lg-end gap-2 flex-wrap">
                                                    <a class="btn btn-secondary flex-fill flex-lg-grow-0"
                                                       href="{{ route('content.order.edit', $content) }}"
                                                    >
                                                        <x-heroicon-o-arrow-path height="20" width="20"/>
                                                        {{ __('Reorder') }}
                                                    </a>

                                                    <a class="btn btn-info flex-fill flex-lg-grow-0"
                                                       href="{{ route('file.show', [$material, $content->file]) }}"
                                                    >
                                                        <x-heroicon-o-eye height="20" width="20"/>
                                                        {{ __('See') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($content->type == 'exam')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row row-gap-24">
                                                    <div class="col-12 col-lg-10">
                                                        <div
                                                            class="text-primary d-flex flex-row align-items-center small">
                                                            <span class="me-2">
                                                                <x-heroicon-o-computer-desktop
                                                                    height="24"
                                                                    width="24"
                                                                />
                                                            </span>
                                                            <div>{{ $content->exam->title }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <div class="d-flex justify-content-lg-end gap-2 flex-wrap">
                                                    <a class="btn btn-secondary flex-fill flex-lg-grow-0"
                                                       href="{{ route('content.order.edit', $content) }}"
                                                    >
                                                        <x-heroicon-o-arrow-path height="20" width="20"/>
                                                        {{ __('Reorder') }}
                                                    </a>

                                                    <a class="btn btn-info flex-fill flex-lg-grow-0"
                                                       href="{{ route('exam.show', [$material, $content->exam]) }}"
                                                    >
                                                        <x-heroicon-o-eye height="20" width="20"/>
                                                        {{ __('See') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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

    <div class="modal fade" id="fileUploadModal" data-coreui-backdrop="static" data-coreui-keyboard="false"
         tabindex="-1"
         aria-labelledby="fileUploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('file.store', $material) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="fileUploadModalLabel">{{ __('Upload File') }}</h5>
                        <button type="reset" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-0">
                        <div class="mb-3">
                            <label for="name" class="form-label required">
                                {{ __('Name') }}
                            </label>
                            <input
                                type="text"
                                class="form-control {{ $errors->first('name') != null ? 'is-invalid' : '' }}"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                maxlength="255"
                            >
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label required">
                                {{ __('File') }}
                            </label>
                            <input
                                type="file"
                                class="form-control {{ $errors->first('file') != null ? 'is-invalid' : '' }}"
                                id="file"
                                name="file"
                            >
                            <div class="invalid-feedback">
                                {{ $errors->first('file') }}
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

    @php $content = session('content') @endphp
    @php $availableOrders = session('availableOrders') @endphp
    @if($content != null)
        <div class="modal fade" id="reorderModal" data-coreui-backdrop="static" data-coreui-keyboard="false"
             tabindex="-1"
             aria-labelledby="reorderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('content.order.update', $content) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="reorderModalLabel">{{ __('Reorder') }}</h5>
                            <button type="reset" class="btn-close" data-coreui-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>

                        <div class="modal-body py-0">
                            <div class="mb-3">
                                <label for="from" class="form-label required">
                                    {{ __('Posisi Awal') }}
                                </label>
                                <input
                                    type="number"
                                    class="form-control {{ $errors->first('from') != null ? 'is-invalid' : '' }}"
                                    id="from"
                                    name="from"
                                    value="{{ $content->order }}"
                                    disabled
                                >
                                <div class="invalid-feedback">
                                    {{ $errors->first('from') }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="to" class="form-label required">
                                    {{ __('Posisi Tujuan') }}
                                </label>
                                <select
                                    class="form-select {{ $errors->first('to') != null ? 'is-invalid' : '' }}"
                                    id="to"
                                    name="to"
                                    required
                                >
                                    <option value="" selected>Pilih salah satu opsi</option>

                                    @foreach($availableOrders as $order)
                                        <option
                                            value="{{ $order }}"
                                            @if(old('to') == $order)
                                                selected
                                            @endif
                                        >
                                            {{ $order }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {{ $errors->first('to') }}
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
    @endif
@endsection

@push('script')
    {!! session('script') !!}

    <script>
        function handleDelete(id) {
            new Swal({
                title: "Hapus Materi",
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
                    let url = `{{ route('material.destroy', ['materialId']) }}`.replace('materialId', id);
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
