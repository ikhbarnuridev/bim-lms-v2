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
    </div>
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
