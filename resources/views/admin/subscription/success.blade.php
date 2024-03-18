@extends('layouts.admin', ['menu' => 'tarifs'])

@section('content')

  <div class="card">

    <div class="card-body">

        <h5>Merci ! Votre abonnement a été souscrit.</h5>

        <p>Vous pouvez dès à présent profiter de toutes les fonctionnalités de l'application {{ config('app.name')}}.</p>

        <a class="btn btn-primary" href="{{ route('admin.dashboard') }}">Retour au tableau de bord</a>
      
    </div>

  </div>

@endsection