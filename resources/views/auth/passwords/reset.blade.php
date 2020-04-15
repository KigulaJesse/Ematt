@extends('layouts.app')

@section('content')
<section class="login py-5 border-top-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 align-item-center">
                <div class="border">
                    <h3 class="bg-gray p-4">Reset Password</h3>
                    
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <fieldset class="p-4">
                             <input type="hidden" name="token" value="{{ $token }}">

                                <input id="email" placeholder = "Email" type="email" class="border p-3 w-100 my-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        
                                <input id="password" placeholder="Password" type="password" class="border p-3 w-100 my-2 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        
                                <input id="password-confirm" placeholder="Confirm Password" type="password" class="border p-3 w-100 my-2 form-control" name="password_confirmation" required autocomplete="new-password">
                                
                                <button type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">
                                    {{ __('Reset Password') }}
                                </button>
                               
                      </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
