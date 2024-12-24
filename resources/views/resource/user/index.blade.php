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
                            @if(!empty($users) && $users->count() > 0)
                                @foreach($users as $index => $user)
                                    <tr class="align-middle">
                                        <th class="text-nowrap text-center">{{ $index + $users->firstItem() }}</th>
                                        <td class="text-nowrap">
                                            <div class="d-flex">
                                                <img class="avatar avatar-md me-3"
                                                     src="{{ $user->getPhotoUrl() }}"
                                                     alt="{{ $user->name }}"
                                                >
                                                <div class="d-flex flex-column">
                                                    <span>{{ $user->name }}</span>
                                                    <span
                                                        class="small text-secondary">{{ $user->getRolenames()[0] }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-nowrap text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('impersonate', $user->id) }}"
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
                                                               href="{{ route('user.edit', $user->id) }}"
                                                            >
                                                                <x-heroicon-m-eye
                                                                    style="height: 20px;width: 20px"/>
                                                                Lihat
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a class="text-decoration-none fw-bold d-flex align-items-center gap-2 dropdown-item text-secondary"
                                                               href="{{ route('user.edit', $user->id) }}"
                                                            >
                                                                <x-heroicon-m-pencil-square
                                                                    style="height: 20px;width: 20px"/>
                                                                Ubah
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a class="text-decoration-none fw-bold text-danger d-flex align-items-center gap-2 dropdown-item"
                                                               href="#"
                                                            >
                                                                <x-heroicon-m-trash style="height: 20px;width: 20px"/>
                                                                Hapus
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
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
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
