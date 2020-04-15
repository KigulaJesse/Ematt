@extends('layouts.app')

@section('content')
                          
<section class="login py-5 border-top-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 align-item-center">
                <div class="border">
                    <h3 class="bg-gray p-4">Login Now</h3>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <fieldset class="p-4">
                                <input id="email" placeholder="Email" type="email" class="border p-3 w-100 my-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="password" placeholder="Password" type="password" class="border p-3 w-100 my-2 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                <div class="loggedin-forgot">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="pt-3 pb-2" for="remember" >
                                        {{ __('Keep Me Logged In') }}
                                    </label>
                                </div>
                                <button type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">
                                    {{ __('Login') }}
                                </button>
                               @if (Route::has('password.request'))
                                    <a class="mt-3 d-block  text-primary" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                @if (Route::has('register'))
                            
                                    <a class="mt-3 d-inline-block text-primary" href="{{ route('register') }}">
                                        {{ __('Register') }}
                                    </a>
                               @endif
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
