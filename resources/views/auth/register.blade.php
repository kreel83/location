<!-- Login 7 - Bootstrap Brain Component -->
@extends('layouts.guest')

@section('content')
<section class="bg-light p-3 p-md-4 p-xl-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
          <div class="card border border-light-subtle rounded-4">
           
                
            <div class="card-body p-3 p-md-4 p-xl-5">
                @include('include.display_msg_error')

                <div class="row">
                    <div class="col-12">
                    <div class="mb-5">
                        <div class="text-center mb-4">
                        <a href="#!">
                            <img src="./assets/img/bsb-logo.svg" alt="BootstrapBrain Logo" width="175" height="57">
                        </a>
                        </div>
                        <h4 class="text-center">Création de mon compte</h4>
                    </div>
                    </div>
                </div>
                <form action="{{ route('register_post')}}" method="POST">
                    @csrf
                    <div class="row gy-3 overflow-hidden">
                    {{-- <div class="col-12">
                        <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" placeholder="Dupont" required>
                        <label for="email" class="form-label">Nom</label>
                        </div>
                    </div> --}}
                    <div class="col-12">
                        <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="name@example.com" required>
                        <label for="email" class="form-label">Votre adresse e-mail</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" required>
                        <label for="password" class="form-label">Choisissez un mot de passe</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}" required>
                        <label for="password" class="form-label">Confirmation du mot de passe</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-grid">
                        <button class="btn bsb-btn-xl btn-primary" type="submit">je créé mon compte</button>
                        </div>
                    </div>
                    </div>
                </form>


            </div>
        </div>
    </div>

  </section>

  @endsection

{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
