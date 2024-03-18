@extends('layouts.admin',['menu' => 'tarifs'])

@section('content')

<div class="row mb-3">

    <div class="col-md-6">

        <div class="card">

            <div class="card-header">
                <h5 class="card-title">Abonnez-vous au service {{ config('app.name') }}</h5>
            </div>

            <div class="card-body">
            
                @if ($checkout == 'cancel')
                    <div class="mb-3">
                        <div class="alert alert-warning">Votre paiement a été annulé et aucun abonnement n'a été souscrit.</div>
                    </div>     
                @endif

                <p>{{ config('app.name') }} est la plateforme dédiée aux professionnels de la location.</p>

                @include('include.display_msg_error')

                {{-- <p>Choisissez un établissement pour l'adresse de facturation :</p> --}}

                <form action="{{ route('admin.subscribe.checkout') }}" method="post">
                @csrf

                {{-- <div class="mb-3">
                    <select class="form-select" name="store_id">
                        <option></option>
                        @foreach ($stores as $store)
                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                        @endforeach
                    </select>
                </div>

                <p>Ou saisissez une adresse manuellement :</p>

                <div class="mb-3">
                    <input class="form-control" type="text" name="prenom" placeholder="Prénom" value="">
                </div>
                <div class="mb-3">
                    <input class="form-control" type="text" name="nom" placeholder="Nom">
                </div>
                <div class="mb-3">
                    <input class="form-control" type="text" name="societe" placeholder="Société">
                </div>
                <div class="mb-3">
                    <input class="form-control" type="text" name="adresse1" placeholder="Adresse">
                </div>
                <div class="mb-3">
                    <input class="form-control" type="text" name="adresse2" placeholder="Complément">
                </div>
                <div class="mb-3">
                    <input class="form-control" type="text" name="cp" placeholder="Code postal">
                </div>
                <div class="mb-3">
                    <input class="form-control" type="text" name="ville" placeholder="Ville">
                </div> --}}

                <p>Choisissez votre abonnement :</p>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" id="abonnement" name="abonnement" required>
                    <label class="form-check-label" for="abonnement">
                        Abonnement mensuel au prix de 33,25 € HT (39,90 € TTC)
                    </label>
                </div>

                {{-- <h3 class="mb-3">Comment s'abonner ?</h3>
                <ol>
                    <li><strong>Aucun frais cachés</strong> : l'abonnement au service {{ config('app.name') }} est au prix de {{ config('app.custom.prix_abonnement') }} € par mois et sera reconduit automatiquement à la fin de chaque période sauf résiliation de votre part. Vous pourrez résilier votre abonnement à tout moment.</li>
                    <li><strong>Informations de paiement sécurisé</strong> : saisissez vos informations de paiement en toute confiance grâce à notre système sécurisé.</li>
                    <li><strong>Commencez à profiter de tous les avantages</strong> : une fois votre abonnement confirmé, plongez dans l'univers simplifié de la location de matériel avec {{ config('app.name') }}.</li>
                </ol> --}}
 
                {{-- <div class="mb-3">
                    <a class="btn btn-primary w-100" href="{{ route('admin.subscribe.checkout') }}">Je m'abonne</a>
                </div> --}}

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100">Je m'abonne</button>
                </div>

                <h4><i class="fa-brands fa-cc-stripe me-1" style="color: var(--main-color)"></i> Sécurité de paiement garantie</h4>
                <p>La sécurité de vos transactions est notre priorité. Nous utilisons des méthodes de paiement sécurisées pour assurer la protection totale de vos informations financières.</p>

                </form>
                
            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card">

            <div class="card-header">
                <h5 class="card-title">Pourquoi choisir {{ config('app.name') }} ?</h5>
            </div>

            <div class="card-body">

                <div class="row">

                    <h4><i class="fa-regular fa-star me-1" style="color: var(--main-color)"></i> point 1</h4>
                    <p>...</p>

                    <h4><i class="fa-regular fa-pen-to-square me-1" style="color: var(--main-color)"></i> point 2</h4>
                    <p>...</p>

                    {{-- <h4><i class="fa-brands fa-cc-stripe me-1" style="color: var(--main-color)"></i> Sécurité de paiement garantie</h4>
                    <p>La sécurité de vos transactions est notre priorité. Nous utilisons des méthodes de paiement sécurisées pour assurer la protection totale de vos informations financières.</p> --}}

                    <h4><i class="fa-regular fa-face-smile me-1" style="color: var(--main-color)"></i></i> Garantie de satisfaction</h4>
                    <p>Nous sommes convaincus que vous adorerez notre service, c'est pourquoi nous offrons une garantie de satisfaction. Si, pour quelque raison que ce soit, vous n'êtes pas entièrement satisfait(e) dans les 30 jours, nous vous rembourserons intégralement.</p>

                </div>

            </div>

        </div>

    </div>

</div>    

@include('admin.subscription.include.invoice')

@endsection