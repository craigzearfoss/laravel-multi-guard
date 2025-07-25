@extends('user.layouts.login')

@section('content')

    <div class="xl:min-w-[450px] px-8">
        <div class="mb-8">
            <h3 class="mb-1">Forgot Password</h3>
            <p>Please enter your email address to receive a password reset link.</p>

            @include('user.includes.login-messages', [$errors])

        </div>
        <div>
            <form action="{{route('forgot_password_submit')}}" method="POST">
                @csrf
                <div class="form-container vertical">
                    <div class="form-item vertical">
                        <input class="input" type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                    </div>
                    <button class="btn btn-solid w-full" type="submit">Send Email</button>
                    <div class="mt-4 text-center">
                        <span>Back to </span>
                        <a class="text-primary-600 hover:underline" href="{{route('login')}}">Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
