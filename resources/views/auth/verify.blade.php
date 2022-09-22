@extends('layouts.admin', ['title' => 'Verify Your Email Address'])

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
                                    <h1 class="h5 text-gray-900 mb-4">{{ __('Verify Your Email Address') }}</h1>
                                </div>
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif

                                <div class="text-center">
                                    {{ __('Before proceeding, please check your email for a verification link.') }}
                                    {{ __('If you did not receive the email') }},
                                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
