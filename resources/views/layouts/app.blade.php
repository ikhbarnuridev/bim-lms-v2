<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}"/>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}"/>
    <link rel="manifest" href="{{ asset('site.webmanifest') }}"/>
    <title>{{ $title ?? 'Page Title' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
            href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
            rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet"/>
</head>
<body id="app">

@include('layouts.app.sidebar')

<div class="wrapper d-flex flex-column min-vh-100">
    @include('layouts.app.header')

    <main class="body flex-grow-1">
        <div class="container-lg px-lg-5 pb-5">
            @yield('content')
        </div>
    </main>
</div>

@yield('modals')

@impersonating()
<a href="{{ route('impersonate.leave') }}" class="bg-black text-white text-center w-100 py-3 text-decoration-none"
   style="position: absolute; z-index: 999999; font-size: 14px;">
    <x-heroicon-o-arrow-left-end-on-rectangle/>
    Tinggalkan Pengecekan Akun
</a>
@endImpersonating

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Global Script --}}
<script>
    if (performance.navigation.type == 2) {
        location.reload(true);
    }

    function handleLogout() {
        new Swal({
            title: "Keluar?",
            text: "Anda akan diarahkan kembali ke halaman login.",
            icon: "warning",
            buttons: {
                confirm: {
                    text: 'Ya',
                    className: 'btn btn-danger'
                },
                cancel: {
                    visible: true,
                    text: "Batal",
                    className: 'btn btn-info'
                },
            }
        }).then((Delete) => {
            if (Delete) {
                window.location = "{{ route('logout') }}"
            } else {
                swal.close();
            }
        });
    }

    $(document).ready(function () {
        @if(Session::has('success'))
        new Swal({
            toast: true,
            width: "auto",
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
            title: "{{ session('success') }}",
            icon: "success",
        });
        @endif

        @if(Session::has('error'))
        new Swal({
            title: "Terjadi kesalahan!",
            text: "{{ session('error') }}",
            icon: "error",
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: "Tutup",
            buttonsStyling: false,
            customClass: {
                cancelButton: "btn btn-secondary"
            }
        }).then(function () {
            swal.close();
            @if(isset(session('error')['onClose']))
                    {!! session('error')['onClose'] !!}();
            @endif
        });
        @endif
    });
</script>

{{-- Page Specific Scripts --}}
@stack('scripts')

</body>
</html>
