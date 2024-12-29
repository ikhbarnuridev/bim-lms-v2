@extends('layouts.app')

@section('content')
    <div class="row row-gap-24">
        <div class="col-12">
            <div class="row row-gap-3">
                <div class="col-12">
                    <x-section.app.page-title title="{{ $title }}"/>
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
                                <th class="bg-body-tertiary" scope="col">Username</th>
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
                                                    <div>
                                                        <span class="small border border-info badge text-info">
                                                            {{ $user->getRolenames()[0] }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-nowrap">{{ $user->username }}</td>
                                        <td class="text-nowrap">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('impersonate', $user->id) }}"
                                                   class="text-decoration-none fw-semibold text-primary d-flex align-items-center gap-1">
                                                    <x-heroicon-o-user height="20" width="20"/>
                                                    Cek Akun
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="align-middle">
                                    <td class="text-center py-3" colspan="5">
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

    <div class="modal fade" id="createModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
         aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf

                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="createModalLabel">{{ __('Add User') }}</h5>
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
                            <label for="username" class="form-label required">
                                {{ __('Username') }}
                            </label>
                            <input
                                type="text"
                                class="form-control {{ $errors->first('username') != null ? 'is-invalid' : '' }}"
                                id="username"
                                name="username"
                                value="{{ old('username') }}"
                                maxlength="255"
                            >
                            <div class="invalid-feedback">
                                {{ $errors->first('username') }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label required">
                                {{ __('Password') }}
                            </label>
                            <input
                                type="password"
                                class="form-control {{ $errors->first('password') != null ? 'is-invalid' : '' }}"
                                id="password"
                                name="password"
                                value="{{ old('password') }}"
                                maxlength="255"
                            >
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label required">
                                {{ __('Confirm Password') }}
                            </label>
                            <input
                                type="password"
                                class="form-control {{ $errors->first('confirm_password') != null ? 'is-invalid' : '' }}"
                                id="confirm_password"
                                name="confirm_password"
                                value="{{ old('confirm_password') }}"
                                maxlength="255"
                            >
                            <div class="invalid-feedback">
                                {{ $errors->first('confirm_password') }}
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
@endsection
