@extends('layouts.app')

@section('content')
    <div class="row row-gap-32">
        <div class="col-12">
            <div class="row row-gap-3">
                <div class="col-12 col-lg-6">
                    <x-section.app.page-title title="{{ $title }}"/>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="text-lg-end">
                        <a href="#"
                           class="btn btn-primary"
                        >
                            Tambah
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <input type="email" class="form-control" id="exampleFormControlInput1"
                               placeholder="Cari" style="width: 255px">
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
                                            <div class="d-flex">
                                                <img class="avatar avatar-md me-3"
                                                     src="{{ $student->user->getPhotoUrl() }}"
                                                     alt="{{ $student->user->name }}"
                                                >
                                                <div class="d-flex flex-column">
                                                    <span>{{ $student->user->name }}</span>
                                                    <span class="small text-secondary">{{ $student->nis }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-nowrap text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="#"
                                                   class="text-decoration-none fw-semibold text-secondary d-flex align-items-center gap-1">
                                                    <x-heroicon-s-eye height="16" width="16"/>
                                                    Lihat
                                                </a>
                                                <a href="#"
                                                   class="text-decoration-none fw-semibold text-secondary d-flex align-items-center gap-1">
                                                    <x-heroicon-s-pencil-square height="16" width="16"/>
                                                    Ubah
                                                </a>
                                                <a href="#"
                                                   class="text-decoration-none fw-semibold text-danger d-flex align-items-center gap-1">
                                                    <x-heroicon-s-trash height="16" width="16"/>
                                                    Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="align-middle">
                                    <td class="text-center py-3" colspan="2">
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
@endsection
