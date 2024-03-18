@extends('layouts.admin',['menu' => 'Coordonnées de l\'établissement'])

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

    @includeWhen($store, 'admin.store.include.menu')
    {{-- @include('admin.store.include.menu') --}}

    <form action="{{ route('admin.store.save.coordonnees') }}" method="post">
    @csrf

        <div class="card mb-3">

            <div class="card-header text-bg-info text-white">
                Adresse de l'établissement
            </div>
            <input type="hidden" name="store_id" value="{{ $store->id ?? null}}">
            <div class="card-body">

                <div class="row mb-1">
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="store_name" class="form-label">Nom de l'établissement *</label>
                            <input type="text" class="form-control" name="store_name" id="store_name" value="{{ old('store_name', $store->name ?? null) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="store_phone" class="form-label">Téléphone professionnel *</label>
                        <input type="text" class="form-control" name="store_phone" id="store_phone" value="{{ old('store_phone', $store->phone ?? null) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="store_email" class="form-label">Adresse email professionnelle *</label>
                        <input type="email" class="form-control" name="store_email" id="store_email" value="{{ old('store_email', $store->email ?? null) }}" required>
                    </div>
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
                    <div class="col-md-6 mb-1">
                        <label for="cp" class="form-label">Code postal *</label>
                        <input autocomplete="postal-code" type="text" class="form-control" name="cp" id="cp" value="{{ old('cp', $store->cp ?? null) }}" required>
                    </div>

                    <div class="col-md-6 mb-1">
                        <label for="ville" class="form-label">Ville *</label>
                        <input autocomplete="address-level2" type="text" class="form-control" name="ville" id="ville" value="{{ old('ville', $store->ville ?? null) }}" required>
                    </div>

                    {{-- <div class="col-md-4 mb-1">
                        <label for="store_phone" class="form-label">Téléphone professionnel *</label>
                        <input type="text" class="form-control" name="store_phone" id="store_phone" value="{{ old('store_phone', $store->phone ?? null) }}" required>
                    </div> --}}
                </div>

                {{-- <div class="row mb-1">
                    <div class="col-md-12 mb-1">
                        <label for="store_email" class="form-label">Adresse email professionnelle *</label>
                        <input type="email" class="form-control" name="store_email" id="store_email" value="{{ old('store_email', $store->email ?? null) }}" required>
                    </div>
                </div> --}}

                <div class="row mb-1">
                    <div class="col-md-12 mb-1">
                        <label for="store_email" class="form-label">URL de votre site Web</label>
                        <div class="d-flex align-items-center">
                            <div class="me-1"><input type="text" class="form-control" value="https://" disabled></div>
                            <input type="text" class="form-control" name="store_url" id="store_url" value="{{ old('store_url', $store->url ?? null) }}">
                        </div>
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


    @if ($store)

        <form action="{{ route('admin.store.save.juridique') }}" method="post">
        @csrf

            <div class="card mb-3">

                <div class="card-header text-bg-info text-white">
                    Informations juridiques
                </div>
                <input type="hidden" name="store_id" value="{{ $store->id ?? null}}">
                <div class="card-body">

                    <div class="row mb-1">
                        <div class="col-md-6">
                            <div class="mb-2">
                                {{-- <label for="store_siret" class="form-label">SIRET</label> --}}
                                <input type="text" class="form-control" name="store_siret" id="store_siret" value="{{ old('store_siret', $store->siret ?? null) }}" placeholder="Siret">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                {{-- <label for="store_siret" class="form-label">SIRET</label> --}}
                                <input type="text" class="form-control" name="store_naf" id="store_naf" value="{{ old('store_naf', $store->naf ?? null) }}" placeholder="Code NAF">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-md-6">
                            <div class="mb-1">
                                {{-- <label for="adresse1" class="form-label">Adresse *</label> --}}
                                <input type="date" class="form-control" name="store_creation" id="store_creation" value="{{ old('store_creation', $store->date_creation ?? null) }}" placeholder="Date de création de l'entreprise">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                {{-- <label for="adresse2" class="form-label">Complément</label> --}}
                                <input type="text" class="form-control" name="store_effectif" id="store_effectif" value="{{ old('store_effectif', $store->effectif ?? null) }}" placeholder="Effectif en salariés">
                            </div>
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
    @endif


@endsection