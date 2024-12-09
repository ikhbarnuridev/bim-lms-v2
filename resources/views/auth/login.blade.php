@extends('layouts.default')

@section('content')
    <x-section.page-title title="Log In"/>

    <main id="login">
        <section id="login-form">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-4 offset-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    BIM LMS
                                    &nbsp;›&nbsp;
                                    Log In
                                </h5>
                                <hr>

                                <form action="{{ route('login.submit') }}" method="post">
                                    @csrf

                                    <div class="mb-4">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Email address
                                        </label>
                                        <input type="email"
                                               class="form-control"
                                               id="exampleFormControlInput1"
                                               placeholder="name@example.com"
                                        >
                                    </div>

                                    <div class="mb-4">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Email address
                                        </label>
                                        <input type="email"
                                               class="form-control"
                                               id="exampleFormControlInput1"
                                               placeholder="name@example.com"
                                        >
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        Log in
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
