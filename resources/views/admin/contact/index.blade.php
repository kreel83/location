@extends('layouts.admin', ['titre' => 'Abonnement', 'menu' => 'resilier'])

@section('content')

<div class="container my-5">

<div class="card mb-3 my-5 mx-auto text-center">

    <div class="card-body">

        <form action="{{ route('admin.contact.store') }}" method="post">
            @csrf

                <div>
                    <h3>Nous contacter</h3>

                    <div class="mb-3">
                    Vous avez des questions ?<br>
                    N'hésitez pas à nous contacter directement.<br>
                    Notre équipe vous répondra dans les meilleurs délais.
                    </div>

                    <div class="mx-auto">
                        @include('include.display_msg_error')
                    </div>

                    <div class="mb-3 mx-auto">
                        <label for="subject">Objet de votre message</label>
                        <input type="text" class="form-control" id="subject" name="subject"
                            value="{{ old('subject') }}" required>
                    </div>

                    <div class="mb-3 mx-auto">
                        <label for="message">Votre message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" value="{{ old('message') }}" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mx-auto">Envoyer le message</button>

                </div>

                <div class="row mt-5 d-flex justify-content-around">

                    {{-- <div class="col">
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                        <p>83000 Toulon</p>
                    </div> --}}

                    {{-- <div class="col">
                        <i class="fas fa-phone fa-2x"></i>
                        <p>06 64 17 41 99</p>
                    </div> --}}

                    {{-- <div class="col">
                        <i class="fas fa-envelope fa-2x"></i>
                        <p>{{ config('mail.from.address') }}</p>
                    </div> --}}
                    
                </div>
            
        </form>

    </div>
    
</div>

@endsection