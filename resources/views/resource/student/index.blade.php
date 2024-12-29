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
                        <table class="table m-0 align-middle">
                            <thead>
                            <tr>
                                <th class="bg-body-tertiary text-center" scope="col" width="5%">No</th>
                                <th class="bg-body-tertiary" scope="col">Nama Lengkap</th>
                                <th class="bg-body-tertiary" scope="col" width="15%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($students) && $students->count() > 0)
                                @foreach($students as $index => $student)
                                    <tr class="align-middle">
                                        <th class="text-nowrap text-center">{{ $index + $students->firstItem() }}</th>
                                        <td class="text-nowrap">
                                            <div class="d-flex align-items-center">
                                                <img class="avatar avatar-md me-3"
                                                     src="{{ $student->user->getPhotoUrl() }}"
                                                     alt="{{ $student->user->name }}"
                                                >
                                                <div class="d-flex flex-column">
                                                    <span>{{ $student->user->name }}</span>
                                                    <div>
                                                        <span class="small border border-info badge text-info">
                                                            {{ $student->nis }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-nowrap text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('impersonate', $student->user->id) }}"
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
                                                               href="{{ route('student.edit', $student->id) }}"
                                                            >
                                                                <x-heroicon-m-pencil-square
                                                                    style="height: 20px;width: 20px"/>
                                                                Ubah
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <button
                                                                class="text-decoration-none fw-bold text-danger d-flex align-items-center gap-2 dropdown-item"
                                                                onclick="handleDelete({{ $student->id }})"
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
                                <tr class="align-middle">
                                    <td class="text-center py-3" colspan="3">
                                        {{ __('No Data Available in Table') }}
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
         aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('student.store') }}" method="post">
                    @csrf

                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="createModalLabel">{{ __('Add Student') }}</h5>
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
                            <label for="nis" class="form-label required">
                                {{ __('NIS') }}
                            </label>
                            <div class="alert alert-info d-flex mb-2" role="alert">
                                <div>
                                    <x-heroicon-o-information-circle class="me-3" height="24" width="24"/>
                                </div>
                                <div>
                                    <b>NIS</b> akan digunakan sebagai <b>Username</b> dan <b>Password</b> pada akun
                                    peserta didik
                                </div>
                            </div>
                            <input
                                type="text"
                                class="form-control {{ $errors->first('nis') != null ? 'is-invalid' : '' }}"
                                id="nis"
                                name="nis"
                                value="{{ old('nis') }}"
                                maxlength="9"
                            >
                            <div class="invalid-feedback">
                                {{ $errors->first('nis') }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-2">
                        <button type="reset" class="btn btn-secondary my-0"
                                data-coreui-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary my-0">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @php $student = session('student') @endphp
    @if($student != null)
        <div class="modal fade" id="editModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
             aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('student.update', $student) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="editModalLabel">{{ __('Edit Student') }}</h5>
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
                                    value="{{ old('name') ?? $student->user->name }}"
                                    maxlength="255"
                                >
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="edit_nis" class="form-label required">
                                    {{ __('NIS') }}
                                </label>
                                <div class="alert alert-info d-flex mb-2" role="alert">
                                    <div>
                                        <x-heroicon-o-information-circle class="me-3" height="24" width="24"/>
                                    </div>
                                    <div>
                                        <b>NIS</b> akan digunakan sebagai <b>Username</b> dan <b>Password</b> pada akun
                                        peserta didik
                                    </div>
                                </div>
                                <input
                                    type="text"
                                    class="form-control {{ $errors->first('nis') != null ? 'is-invalid' : '' }}"
                                    id="edit_nis"
                                    name="nis"
                                    value="{{ old('nis') ?? $student->nis }}"
                                    maxlength="9"
                                >
                                <div class="invalid-feedback">
                                    {{ $errors->first('nis') }}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-2">
                            <button type="reset" class="btn btn-secondary my-0"
                                    data-coreui-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary my-0">{{ __('Save') }}</button>
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
                title: "Hapus Peserta Didik?",
                text: "Peserta didik akan terhapus secara permanen!",
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
                    let url = `{{ route('student.destroy', ['']) }}/${id}`;
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
