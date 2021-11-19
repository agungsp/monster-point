@php
    $user = auth()->user();
    $merchant = $user->merchant;
@endphp
@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

@endsection

{{-- TITLE --}}
@section('title', 'Profile')

{{-- CONTENT --}}
@section('content')
    @if (session('status'))
        <div class="alert alert-success mb-4 alert-dismissible fade show rounded-xl">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ route('profile.update', auth()->id()) }}" method="post">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card rounded-xxl card-auto-resize">
                    <div class="card-body">
                        <h4 class="mb-5">Merchant Info</h4>

                        <div class="row justify-content-center mb-3">
                            <div class="col-md-4">
                                <label for="merchant_name">Name</label>
                            </div>
                            <div class="col-md-8">
                                <input name="merchant_name" id="merchant_name" type="text" class="form-control rounded-xl @error('merchant_name') is-invalid @enderror" autofocus autocomplete="off" value="{{ old('merchant_name', $merchant->Nama) }}">
                                @error('merchant_name')
                                    <em class="small text-danger">
                                        {{ $message }}
                                    </em>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-4">
                                <label for="merchant_address">Address</label>
                            </div>
                            <div class="col-md-8">
                                <input name="merchant_address" id="merchant_address" type="text" class="form-control rounded-xl @error('merchant_address') is-invalid @enderror" autocomplete="off" value="{{ old('merchant_address', $merchant->Alamat) }}">
                                @error('merchant_address')
                                    <em class="small text-danger">
                                        {{ $message }}
                                    </em>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-4">
                                <label for="pic">PIC</label>
                            </div>
                            <div class="col-md-8">
                                <input name="pic" id="pic" type="text" class="form-control rounded-xl @error('pic') is-invalid @enderror" autocomplete="off" value="{{ old('pic', $merchant->Pic) }}">
                                @error('pic')
                                    <em class="small text-danger">
                                        {{ $message }}
                                    </em>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-4">
                                <label for="pic_phone">PIC Phone</label>
                            </div>
                            <div class="col-md-8">
                                <input name="pic_phone" id="pic_phone" type="text" class="form-control rounded-xl @error('pic_phone') is-invalid @enderror" autocomplete="off" value="{{ old('pic_phone', $merchant->PicTelp) }}">
                                @error('pic_phone')
                                    <em class="small text-danger">
                                        {{ $message }}
                                    </em>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-4">
                                <label for="use_for">Use For</label>
                            </div>
                            <div class="col-md-8">
                                <input name="use_for" id="use_for" type="text" class="form-control rounded-xl @error('use_for') is-invalid @enderror" autocomplete="off" value="{{ old('use_for', $merchant->Kebutuhan) }}">
                                @error('use_for')
                                    <em class="small text-danger">
                                        {{ $message }}
                                    </em>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card rounded-xxl card-auto-resize">
                    <div class="card-body">
                        <h4 class="mb-5">Credentials</h4>

                        <div class="row justify-content-center mb-3">
                            <div class="col-md-4">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-md-8">
                                <input name="email" id="email" type="email" class="form-control rounded-xl @error('email') is-invalid @enderror" autocomplete="on" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <em class="small text-danger">
                                        {{ $message }}
                                    </em>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center mt-4 mb-3">
                            <div class="col-md-4">
                                <label for="token">Token</label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input name="token" id="token" type="text" class="form-control rounded-xl-start border-end-0 @error('token') is-invalid @enderror" aria-describedby="copyToken" readonly value="{{ $merchant->Token }}">
                                    <button id="btnCopyToken" class="btn rounded-xl-end border border-start-0" style="background-color: var(--ekky-light-gray);" type="button" onclick="">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                    @error('token')
                                        <em class="small text-danger">
                                            {{ $message }}
                                        </em>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-divider">
                            <label>Change Password</label>
                        </div>

                        <div class="row justify-content-center mt-4 mb-3">
                            <div class="col-md-4">
                                <label for="old_password">Old Password</label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input name="old_password" id="old_password" type="password" class="form-control rounded-xl-start border-end-0 @error('old_password') is-invalid @enderror" aria-describedby="showOldPassword">
                                    <button id="btnShowOldPassword" class="btn rounded-xl-end border border-start-0" style="background-color: var(--ekky-light-gray);" type="button" onclick="toogleShowPassword('old');">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('old_password')
                                    <em class="small text-danger">
                                        {{ $message }}
                                    </em>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center mb-3">
                            <div class="col-md-4">
                                <label for="new_password">New Password</label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input name="new_password" id="new_password" type="password" class="form-control rounded-xl-start border-end-0 @error('new_password') is-invalid @enderror" aria-describedby="showNewPassword">
                                    <button id="btnShowNewPassword" class="btn rounded-xl-end border border-start-0" style="background-color: var(--ekky-light-gray);" type="button" onclick="toogleShowPassword();">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('new_password')
                                    <em class="small text-danger">
                                        {{ $message }}
                                    </em>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center mb-3">
                            <div class="col-md-4">
                                <label for="new_password_confirmation">Confirm New Password</label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input name="new_password_confirmation" id="new_password_confirmation" type="password" class="form-control rounded-xl-start border-end-0 @error('new_password_confirmation') is-invalid @enderror" aria-describedby="showNewPasswordConfirmation">
                                    <button id="btnShowNewPasswordConfirmation" class="btn rounded-xl-end border border-start-0" style="background-color: var(--ekky-light-gray);" type="button" onclick="toogleShowPassword('confirm');">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('new_password_confirmation')
                                    <em class="small text-danger">
                                        {{ $message }}
                                    </em>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card rounded-xxl">
            <div class="card-body row justify-content-end g-2">
                <div class="col-md-2 mb-1 order-2 order-md-1">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-secondary rounded-xxl" onclick="location.href='/dashboard';">
                            Close
                        </button>
                    </div>
                </div>
                <div class="col-md-2 mb-1 order-1 order-md-2">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary rounded-xxl">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

{{-- MODAL --}}
@section('modal')

@endsection

{{-- JS --}}
@section('js')
    <script>
        function toogleShowPassword(mode = '') {
            let passwordField = $(`#${mode === 'old' ? mode + '_' : 'new_'}password${mode === 'confirm' ? '_confirmation' : ''}`);
            let showPasswordBtn = $(`#btnShow${mode === 'old' ? 'Old' : 'New'}Password${mode === 'confirm' ? 'Confirmation' : ''}`);
            if (passwordField.attr('type') == 'password') {
                passwordField.attr('type', 'text');
                showPasswordBtn.html('<i class="fas fa-eye-slash"></i>');
            }
            else {
                passwordField.attr('type', 'password');
                showPasswordBtn.html('<i class="fas fa-eye"></i>');
            }
        }

        $(document).ready(() => {
            $('#btnCopyToken').on('click', function () {
                if (copyToClipboard(document.getElementById("token"))) {
                    Toast.fire({
                        icon: 'success',
                        title: 'The tokens copied successfully'
                    });
                }
            });
        });
    </script>
@endsection
