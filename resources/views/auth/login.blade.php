<!-- Login 7 - Bootstrap Brain Component -->
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
                @include('include.display_msg_error')
                <form action="{{ route('login_post')}}" method="POST">
                    @csrf
                    <div class="row gy-3 overflow-hidden">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="name@example.com" required>
                        <label for="email" class="form-label">Email</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" placeholder="Password" required>
                        <label for="password" class="form-label">Password</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
                        <label class="form-check-label text-secondary" for="remember_me">
                            Rester connecté
                        </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                        <button class="btn bsb-btn-xl btn-primary" type="submit">Je me connecte</button>
                        </div>
                    </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <hr class="mt-5 mb-4 border-secondary-subtle">
                        <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                            <a href="{{ route('register') }}" class="link-secondary text-decoration-none">Je créé un compte</a>
                            <a href="{{ route('password.request') }}" class="link-secondary text-decoration-none">Mot de passe oublié</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

  </section>

  @endsection
{{-- 

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
