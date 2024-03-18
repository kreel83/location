@extends('layouts.admin',['menu' => 'Mon abonnement'])

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <h5 class="card-title">Mon abonnement</h5>
    </div>
    <div class="card-body">
                          
        <div class="mb-3">
            Votre abonnement se terminera le {{ Carbon\Carbon::parse($expirationDate)->format('d/m/Y')}} et sera reconduit automatiquement pour la même période.
        </div>

        <div class="d-flex flex-row mb-3">
            <div class="me-3">
                @if($onGracePeriode)
                    <a class="btn btn-primary" href="{{ route('admin.subscribe.resume') }}">Réactiver mon abonnement</a>
                @else
                    <a class="btn btn-primary" href="{{ route('admin.subscribe.cancel') }}">Résilier mon abonnement</a>
                @endif
            </div>
        </div>
    </div>
</div>

@include('admin.subscription.include.invoice')

@endsection