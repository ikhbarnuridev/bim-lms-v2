@extends('layouts.app')

@section('content')
    <div class="row row-gap-24">
        <div class="col-12">
            <div class="row row-gap-3">
                <div class="col-12">
                    <x-section.app.page-title title="{{ $title }}"/>

                    <x-section.info
                        title="Informasi belum tersedia"
                        message="Halaman ini sedang dalam tahap pengembangan, harap periksa kembali nanti"
                    />
                </div>
            </div>
        </div>
    </div>
@endsection
