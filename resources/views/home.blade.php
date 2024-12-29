@extends('layouts.default')

@section('content')
    <main id="home">
        <section id="carousel" class="carousel slide bg-primary" data-coreui-ride="carousel">
            <div class="container">
                <div class="carousel-inner">
                    <div class="carousel-inner py-5">
                        <div class="carousel-item active">
                            <svg class="docs-placeholder-img docs-placeholder-img-lg d-block w-100" width="800" height="550" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: First slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#555" dy=".3em">First slide</text></svg>
                        </div>
                        <div class="carousel-item">
                            <svg class="docs-placeholder-img docs-placeholder-img-lg d-block w-100" width="800" height="550" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Second slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#666"></rect><text x="50%" y="50%" fill="#444" dy=".3em">Second slide</text></svg>

                        </div>
                        <div class="carousel-item">
                            <svg class="docs-placeholder-img docs-placeholder-img-lg d-block w-100" width="800" height="550" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Third slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#555"></rect><text x="50%" y="50%" fill="#333" dy=".3em">Third slide</text></svg>

                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-coreui-target="#carousel"
                        data-coreui-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-coreui-target="#carousel"
                        data-coreui-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <x-section.info
            title="Informasi belum tersedia"
            message="Halaman ini sedang dalam tahap pengembangan, harap periksa kembali nanti"
        />
    </main>
@endsection

@push('script')
    <script>
        const carousel = new coreui.Carousel('#carousel')
    </script>
@endpush
