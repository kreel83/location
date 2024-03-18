@extends('layouts.admin', ['titre' => 'Abonnement', 'menu' => 'resilier'])

@section('content')

<div class="container my-5">

    {{-- <nav class="pb-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('subscribe.index') }}">Mon abonnement</a></li>
        <li class="breadcrumb-item active" aria-current="page">Résilier mon abonnement</li>
        </ol>
    </nav> --}}

    <div class="card mx-auto">
        <div class="card-body">
            <h4 class="card-title mb-3">Résilier mon abonnement</h4>

            @if($onGracePeriode)
                <p>Votre abonnement est maintenant résilié.</p>
                <p>Il restera toutefois actif jusqu'au {{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}} et pourra être réactivé à tout moment jusqu'à cette date.</p>        
                <div class="mt-4">
                    <a class="btn-btn-primary" href="{{ route('admin.subscribe.index') }}">Retour à mon abonnement</a>
                </div>
            @else
                <p>Notre service ne correspond pas à vos attentes ? Aucun problème, vous pouvez résilier votre abonnement en 1 clic.</p>
                <p>Il restera toutefois actif jusqu'au {{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}}.</p>

                <div class="d-flex flex-row mt-4">
                    <div class="me-3">
                        <a class="btn btn-outline-secondary" href="{{ route('admin.subscribe.index') }}">Annuler</a>
                    </div> 
                    <div>
                        <a class="btn btn-primary" href="{{ route('admin.subscribe.cancelsubscription') }}">Résilier mon abonnement</a>
                    </div>
                </div>
            @endif

        </div>
    </div>
  
</div>

@endsection