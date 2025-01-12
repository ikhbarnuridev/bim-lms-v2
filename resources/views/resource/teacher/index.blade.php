@extends('layouts.app')

@section('content')
    <div class="row row-gap-24">
        <div class="col-12">
            <div class="row row-gap-3">
                <div class="col-12 col-lg-6">
                    <x-section.app.page-title title="{{ $title }}"/>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="text-lg-end">
                        <button
                            class="btn btn-primary"
                            data-coreui-toggle="modal"
                            data-coreui-target="#createModal"
                        >
                            <x-heroicon-o-plus height="20" width="20"/>
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <form action="{{ url()->current() }}" method="get">
                            <input type="text"
                                   class="form-control"
                                   name="s"
                                   placeholder="Cari"
                                   style="width: 255px"
                                   value="{{ $search }}"
                            >
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover m-0 align-middle">
                            <thead>
                            <tr>
                                <th class="bg-body-tertiary text-center" scope="col" width="5%">No</th>
                                <th class="bg-body-tertiary" scope="col">Nama Lengkap</th>
                                <th class="bg-body-tertiary" scope="col" width="15%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($teachers))
                                @foreach($teachers as $index => $teacher)
                                    <tr class="align-middle">
                                        <th class="text-nowrap text-center">{{ $index + $teachers->firstItem() }}</th>
                                        <td class="text-nowrap">
                                            <div class="d-flex align-items-center">
                                                <img class="avatar avatar-md me-3"
                                                     src="{{ $teacher->getPhotoUrl() }}"
                                                     alt="{{ $teacher->name }}"
                                                >
                                                <div class="d-flex flex-column">
                                                    <span>{{ $teacher->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-nowrap text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('impersonate', $teacher->id) }}"
                                                   class="text-decoration-none fw-semibold text-primary d-flex align-items-center gap-1">
                                                    <x-heroicon-o-user height="20" width="20"/>
                                                    Cek Akun
                                                </a>

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
                                                               href="{{ route('teacher.edit', $teacher->id) }}"
                                                            >
                                                                <x-heroicon-m-pencil-square
                                                                    style="height: 20px;width: 20px"/>
                                                                Ubah
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <button
                                                                class="text-decoration-none fw-bold text-danger d-flex align-items-center gap-2 dropdown-item"
                                                                onclick="handleDelete({{ $teacher->id }})"
                                                            >
                                                                <x-heroicon-m-trash style="height: 20px;width: 20px"/>
                                                                Hapus
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="p-0" colspan="3">
                                        <x-section.empty-state/>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $teachers->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
         aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('teacher.store') }}" method="post">
                    @csrf

                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="createModalLabel">{{ __('Add Teacher') }}</h5>
                        <button type="reset" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-0">
                        <div class="mb-3">
                            <label for="name" class="form-label required">
                                {{ __('Full Name') }}
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
                            <label for="username" class="form-label required">
                                {{ __('Username') }}
                            </label>
                            <input
                                type="text"
                                class="form-control {{ $errors->first('username') != null ? 'is-invalid' : '' }}"
                                id="username"
                                name="username"
                                value="{{ old('username') }}"
                                maxlength="255"
                            >
                            <div class="invalid-feedback">
                                {{ $errors->first('username') }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label required">
                                {{ __('Password') }}
                            </label>
                            <input
                                type="password"
                                class="form-control {{ $errors->first('password') != null ? 'is-invalid' : '' }}"
                                id="password"
                                name="password"
                                value="{{ old('password') }}"
                                maxlength="255"
                            >
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label required">
                                {{ __('Password Confirmation') }}
                            </label>
                            <input
                                type="password"
                                class="form-control {{ $errors->first('password_confirmation') != null ? 'is-invalid' : '' }}"
                                id="password_confirmation"
                                name="password_confirmation"
                                value="{{ old('password_confirmation') }}"
                                maxlength="255"
                            >
                            <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-2 justify-content-start">
                        <button type="submit" class="btn btn-primary my-0">
                            <x-fas-save height="20" width="20"/>
                            {{ __('Save') }}
                        </button>
                        <button type="reset" class="btn btn-secondary my-0"
                                data-coreui-dismiss="modal">{{ __('Cancel') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @php $teacher = session('teacher') @endphp
    @if($teacher != null)
        <div class="modal fade" id="editModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
             aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('teacher.update', $teacher) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="editModalLabel">{{ __('Edit Teacher') }}</h5>
                            <button type="reset" class="btn-close" data-coreui-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>

                        <div class="modal-body py-0">
                            <div class="mb-3">
                                <label for="edit_name" class="form-label required">
                                    {{ __('Full Name') }}
                                </label>
                                <input
                                    type="text"
                                    class="form-control {{ $errors->first('name') != null ? 'is-invalid' : '' }}"
                                    id="edit_name"
                                    name="name"
                                    value="{{ old('name') ?? $teacher->name }}"
                                    maxlength="255"
                                >
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="edit_username" class="form-label required">
                                    {{ __('Username') }}
                                </label>
                                <input
                                    type="text"
                                    class="form-control {{ $errors->first('username') != null ? 'is-invalid' : '' }}"
                                    id="edit_username"
                                    name="username"
                                    value="{{ old('username') ?? $teacher->username }}"
                                    maxlength="255"
                                >
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="edit_password" class="form-label">
                                    {{ __('Password') }}
                                    <br>
                                    <span class="form-text">(Hanya diisi ketika ingin merubah password)</span>
                                </label>
                                <input
                                    type="password"
                                    class="form-control {{ $errors->first('password') != null ? 'is-invalid' : '' }}"
                                    id="edit_password"
                                    name="password"
                                    value="{{ old('password') }}"
                                    maxlength="255"
                                >
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="edit_password_confirmation" class="form-label">
                                    {{ __('Password Confirmation') }}
                                </label>
                                <input
                                    type="password"
                                    class="form-control {{ $errors->first('password_confirmation') != null ? 'is-invalid' : '' }}"
                                    id="edit_password_confirmation"
                                    name="password_confirmation"
                                    value="{{ old('password_confirmation') }}"
                                    maxlength="255"
                                >
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-2 justify-content-start">
                            <button type="submit" class="btn btn-primary my-0">
                                <x-fas-save height="20" width="20"/>
                                {{ __('Save') }}
                            </button>
                            <button type="reset" class="btn btn-secondary my-0"
                                    data-coreui-dismiss="modal">{{ __('Cancel') }}
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
                title: "Hapus Guru?",
                text: "Guru akan terhapus secara permanen!",
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
                    let url = `{{ route('teacher.destroy', ['']) }}/${id}`;
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

