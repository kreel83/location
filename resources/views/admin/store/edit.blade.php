@extends('layouts.admin',['menu' => 'Mon profil'])

@section('content')

{{-- <link href="https://api.mapbox.com/mapbox-assembly/v1.3.0/assembly.min.css" rel="stylesheet">
<script id="search-js" defer="" src="https://api.mapbox.com/search-js/v1.0.0-beta.18/web.js"></script>

 --}}
    <style>
    .hide {
    display: none;
    }
    </style>

    <script
    id="search-js"
    defer
    src="https://api.mapbox.com/search-js/v1.0.0-beta.18/web.js"
    >
    </script>
    <script>        
    const script = document.getElementById('search-js');
    script.onload = function() {
    mapboxsearch.autofill({
    accessToken: '{{env('MAPBOX_ACCESS_TOKEN')}}'
    });
    };
    </script>

     <h3>Mon établissement</h3>

    @include('include.display_msg_error')

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Coordonnées</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Congés</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Logo</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Horaires</a>
          {{-- <a class="nav-link disabled" aria-disabled="true">Disabled</a> --}}
        </li>
    </ul>

    <form action="{{ route('admin.store.save') }}" method="post">
    @csrf

        <div class="card mb-3">

            <div class="card-header text-bg-info text-white">
                Mon établissement
            </div>
            <input type="hidden" name="store_id" value="{{ $store->id ?? null}}">
            <div class="card-body">

                <div class="mb-2">
                    <label for="store_name" class="form-label">Nom de l'établissement *</label>
                    <input type="text" class="form-control" name="store_name" id="store_name" value="{{ old('store_name', $store->name ?? null) }}" required>
                </div>

                <div class="row mb-1">
                    <div class="col-md-6">
                        <div class="mb-1">
                            <label for="adresse1" class="form-label">Adresse *</label>
                            <input autocomplete="address-line1" type="text" class="form-control" name="adresse1" id="adresse1" value="{{ old('adresse1', $store->adresse1 ?? null) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-1">
                            <label for="adresse2" class="form-label">Complément</label>
                            <input type="text" class="form-control" name="adresse2" id="adresse2" value="{{ old('adresse2', $store->adresse2 ?? null) }}">
                        </div>
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-md-4 mb-1">
                        <label for="cp" class="form-label">Code postal *</label>
                        <input autocomplete="postal-code" type="text" class="form-control" name="cp" id="cp" value="{{ old('cp', $store->cp ?? null) }}" required>
                    </div>

                    <div class="col-md-4 mb-1">
                        <label for="ville" class="form-label">Ville *</label>
                        <input autocomplete="address-level2" type="text" class="form-control" name="ville" id="ville" value="{{ old('ville', $store->ville ?? null) }}" required>
                    </div>

                    <div class="col-md-4 mb-1">
                        <label for="store_phone" class="form-label">Téléphone professionnel *</label>
                        <input type="text" class="form-control" name="store_phone" id="store_phone" value="{{ old('store_phone', $store->phone ?? null) }}" required>
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-md-12 mb-1">
                        <label for="store_email" class="form-label">Adresse email professionnelle *</label>
                        <input type="email" class="form-control" name="store_email" id="store_email" value="{{ old('store_email', $store->email ?? null) }}" required>
                    </div>
                </div>

                <!-- Form buttons -->
                <div class="mt-3">
                    <a href="{{ route('admin.profil') }}" class="btn btn-outline-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>

            </div>
        </div>

    </form>

    @if($store)
        <div class="card mb-3">

            <div class="card-header text-bg-info">
                <div class="row">
                    <div class="col-md-6 text-white">
                        Fermetures de l'établissement
                    </div>
                    <div class="col-md-6 text-end text-white">
                        {{ $store->jours_ferie_zone ? 'Zone '.$store->jours_ferie_zone : ''}}
                    </div>
                </div>
            </div>

            <div class="card-body">

                @if (is_null($store->jours_ferie_zone))

                    <p>Pour indiquer les dates de fermeture veuillez au préalable choisir votre zone géographique :</p>
                    <form class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('admin.store.zone') }}" method="post">
                    @csrf
                        <input type="hidden" name="store_id" value="{{ $store->id }}">
                        <div class="col-12">
                            <select class="form-select" name="zone" required>
                                <option selected></option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->zone }}">{{ $zone->zone }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Valider</button>
                        </div>
                    </form>

                @else
                
                    <form action="{{ route('admin.store.holidays') }}" method="post">
                    @csrf
                    <input type="hidden" name="store_id" value="{{ $store->id }}">
                    <div class="mb-3">
                        Prochaine fermeture du 
                        <input type="date" name="conges_start" value="{{ $store->conges_start }}"> 
                        au 
                        <input type="date" name="conges_end" value="{{ $store->conges_end }}">
                    </div>

                    <div>

                        <div class="card mb-3">
                            <div class="card-header">
                                Année {{ \Carbon\Carbon::now()->format('Y') }}
                            </div>
                            <div class="card-body">
                                @foreach ($joursFeriesAnneeEnCours as $jf)
                                    <div class="form-check form-check-inline">
                                    @php
                                        $selected = $joursFeries->where('id', $jf->id)->first();
                                    @endphp
                                    <input class="form-check-input" type="checkbox" name="jf[]" id="c{{ $jf->id }}" value="{{ $jf->id }}" {{ $selected ? 'checked' : null }}> 
                                    <label class="form-check-label" for="c{{ $jf->id }}" title="{{ \Carbon\Carbon::parse($jf->day)->format('d/m/Y') }}">{{ $jf->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                Année {{ \Carbon\Carbon::now()->addYear()->format('Y') }}
                            </div>
                            <div class="card-body">
                                @foreach ($joursFeriesAnneeSuivante as $jf)
                                    <div class="form-check form-check-inline">
                                    @php
                                        $selected = $joursFeries->where('id', $jf->id)->first();
                                    @endphp
                                    <input class="form-check-input" type="checkbox" name="jf[]" id="c{{ $jf->id }}" value="{{ $jf->id }}" {{ $selected ? 'checked' : null }}> 
                                    <label class="form-check-label" for="c{{ $jf->id }}" title="{{ \Carbon\Carbon::parse($jf->day)->format('d/m/Y') }}">{{ $jf->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <button class="btn btn-primary" type="submit">Sauvegarder</button>

                    </form>

                @endif

            </div>

        </div>
    @endif

    @if($store)
        <div class="card mb-3">

            <div class="card-header text-bg-info text-white">
                Logo de l'établissement
            </div>

            <div class="card-body">

                <div class="row">
                    @if (file_exists(public_path('storage/'.Auth::user()->pathToAsset.$store->logo)) && !is_null($store->logo))
                        <div class="col-auto">
                            <img src="{{ asset('storage/'.Auth::user()->pathToAsset.$store->logo) }}">
                        </div>
                    @endif
                    <div class="col-auto">
                        <form action="{{ route('admin.store.logo') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="store_id" value="{{ $store->id }}">
                            @csrf
                            Format acceptés : jpg, png, gif. 512 ko maximum.
                            <input type="file" name="file_upload">
                            <input type="submit">
                        </form>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-danger btn-sm" href="{{ route('admin.store.logo.remove', ['store_id' => $store->id]) }}">Supprimer le logo</a>
                    </div>
                </div>

            </div>

        </div>

        <div>
            <a href="{{ route('admin.profil') }}" class="btn btn-primary">Retour aux établissements</a>
        </div>

    @endif

    

@endsection