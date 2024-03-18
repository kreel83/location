@extends('layouts.admin',['menu' => 'tarifs'])

@section('content')

    <h3>Tableau de bord</h3>

    {{-- @if ($checkout == 'success')
        <div class="mb-3">
            <div class="alert alert-success">Votre paiement a été annulé et aucun abonnement n'a été souscrit.</div>
        </div>     
    @endif --}}

    @include('include.display_msg_error')

@endsection