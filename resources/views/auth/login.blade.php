@extends('layouts.auth')

@section('content')

    <x-auth.login>

        <span class="banner_text_login">POINT OF SALE</span>

        <br>
        <br>

        <div>

            <h2 class="hr-lines" style="font-size: 12px">
                <span class="hr-lines-2">Enter your account email and password to login</span>
            </h2>
            <br>

            <div class="row">
                <div class="col-md-8 m-auto">

                    @if($errors->any())
                        <span class="text-danger login_span_error">{{ __('These credentials do not match our records.') }}</span>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                    <div class="form-group">
                        <label class="login-label" for="email" style="text-align: left; display: block; width: 100%;">Email<span style="color: red">*</span></label>
                        <input
                            type="text"
                            name="email"
                            class="form-control login_input @error('email') is-invalid @enderror"
                            placeholder="Email"
                            required
                            value="{{ old('email') }}">
                    </div>

                    <div class="form-group mt-2">
                        <label class="login-label" for="password">Password<span style="color: red">*</span></label>
                        <input
                            type="password"
                            name="password"
                            required
                            class="form-control login_input @error('password') is-invalid @enderror"
                            placeholder="Password">

                    </div>

                    <div class="mt-2 text-start">
                        <a class="forgot_pass" href="#">Forgot Password?</a>
                    </div>

                    <br>

                    <button type="submit" class="btn btn-sm w-100 text-light" style="background-color: #5A61C4">Login</button>

                </form>
            </div>
        </div>
    </div>

</x-auth.login>

@endsection


