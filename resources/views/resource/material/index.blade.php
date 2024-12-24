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
            <div class="card border-0">
                <div class="card-header border-0 px-0">
                    <div class="d-flex justify-content-end">
                        <input type="email" class="form-control w-100" id="exampleFormControlInput1"
                               placeholder="Cari" style="width: 255px">
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="row row-gap-48">
                        @if(!empty($materials) && $materials->count() > 0)
                            @foreach($materials as $index => $material)
                                <div class="col-12 col-md-4 col-xl-3">
                                    <a href="#" class="text-decoration-none">
                                        <div class="card h-100">
                                            <img src="https://picsum.photos/200" class="card-img-top" alt="Cover"
                                                 height="140">

                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size: 21px">
                                                    {{ Str::limit($material->title, 33, '...') }}
                                                </h5>
                                                <p class="card-text small">Some quick example text to build on the card title and
                                                    make up the bulk of the card's content.</p>
                                            </div>

                                            <div class="card-footer">

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    {{ $materials->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
