@extends('layouts.admin', ['title' => 'Password Reset'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card o-hidden border-o shadow-lg my-5">

                <div class="card-body p-0">
                    <div class="row justify-content-center">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <a href="{{url('/')}}"><img src="{{ asset('img/logo.png') }}" style="width:120px;"></a>
                                    <p>&nbsp;</p>
                                    <h1 class="h5 text-gray-900 mb-4">{{ __('Confirm Password') }}</h1>
                                    {{ __('Please confirm your password before continuing.') }}
                                </div>

                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-mv btn-user">
                                                {{ __('Confirm Password') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
