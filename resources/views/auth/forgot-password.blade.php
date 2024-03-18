
@extends('layouts.guest')


@section('content')
<section class="bg-light p-3 p-md-4 p-xl-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
          <div class="card border border-light-subtle rounded-4">

                <div class="card-body p-3 p-md-4 p-xl-5">
                <div class="row">
                    <div class="col-12">
                    <div class="mb-5">
                        <div class="text-center mb-4">
                        <a href="#!">
                            <img src="./assets/img/bsb-logo.svg" alt="BootstrapBrain Logo" width="175" height="57">
                        </a>
                        </div>
                        <h4 class="text-center">Welcome back you've been missed!</h4>
                    </div>
                    </div>
                </div>
                <form action="{{ route('password.email')}}" method="POST">
                    @csrf
                    <div class="row gy-3 overflow-hidden">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="name@example.com" required>
                        <label for="email" class="form-label">Email</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                        <button class="btn bsb-btn-xl btn-primary" type="submit">Recevoir mon mot de passer</button>
                        </div>
                    </div>
                    
                </form>


                </div>
            </div>
            </div>
  

  </section>
@endsection
{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form> 
</x-guest-layout>--}}
