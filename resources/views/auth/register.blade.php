@extends('layouts.app')

@section('content')

<section class="login py-5 border-top-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 align-item-center">
                <div class="border">
                    <h3 class="bg-gray p-4">Register Now</h3>
                       
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <fieldset class="p-4">
                                <input id="name" placeholder="User Name" type="text" class="border p-3 w-100 my-2 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="con0tact" placeholder="Contact" type="text" class="border p-3 w-100 my-2 form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus>
                                @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                
                                <input id="email" placeholder="Email*" type="email" class="border p-3 w-100 my-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="password" placeholder="Password*" type="password" class="border p-3 w-100 my-2 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    
                                <input id="password-confirm" placeholder="Confirm Password*"  type="password" class="border p-3 w-100 my-2 form-control" name="password_confirmation" required autocomplete="new-password">

                                <div class="loggedin-forgot d-inline-flex my-3">
                                    <input name = 'terms' type="checkbox" id="registering" class="mt-1">
                                    <label for="registering" class="px-2">By registering, you accept our <a class="text-primary font-weight-bold" href="/Terms-and-conditions">Terms & Conditions</a></label>
                                
                                </div>
                                @error('terms')
                                        <div style="color: red;"><strong>*{{$errors->first('terms')}}</strong></div>
                                    @enderror
                                


                                <button type="submit" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold">
                                    {{ __('Register') }}
                                </button>

                        <fieldset class="p-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

