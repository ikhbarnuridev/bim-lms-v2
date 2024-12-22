@extends('layouts.app')

@section('content')
    <div class="row row-gap-32">
        <div class="col-12">
            <x-section.app.page-title title="{{ $title }}"/>
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
                                <th class="bg-body-tertiary" scope="col">Judul</th>
                                <th class="bg-body-tertiary" scope="col" width="15%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($materials) && $materials->count() > 0)
                                @foreach($materials as $index => $material)
                                    <tr class="align-middle">
                                        <th class="text-nowrap text-center">{{ $index + $materials->firstItem() }}</th>
                                        <td class="text-nowrap">{{ $material->title }}</td>
                                        <td class="text-nowrap text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="#"
                                                   class="text-decoration-none fw-semibold text-secondary d-flex align-items-center gap-1">
                                                    <x-heroicon-s-eye height="16" width="16"/>
                                                    Lihat
                                                </a>
                                                <a href="#"
                                                   class="text-decoration-none fw-semibold text-info d-flex align-items-center gap-1">
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
                    {{ $materials->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
