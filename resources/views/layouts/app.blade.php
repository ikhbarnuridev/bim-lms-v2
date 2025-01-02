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
    <title>{{ $title ?? 'Page Title' }} - {{ env('APP_NAME') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body id="app" class="bg-body-tertiary">

@include('layouts.app.sidebar')

<div class="wrapper d-flex flex-column min-vh-100">
    @include('layouts.app.header')

    <main class="body flex-grow-1">
        <div class="container-lg">
            @yield('content')
        </div>
    </main>
</div>

<x-section.impersonate/>

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
                window.location = "{{ route('auth.logout') }}"
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
            title: "{{ session('error') }}",
            icon: "error",
        });
        @endif
    });
</script>

{{-- Page Specific Script --}}
@stack('script')

</body>
</html>
