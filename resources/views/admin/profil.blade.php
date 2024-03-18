@extends('layouts.admin',['menu' => 'Mon profil'])

@section('content')

{{-- <link href="https://api.mapbox.com/mapbox-assembly/v1.3.0/assembly.min.css" rel="stylesheet">
<script id="search-js" defer="" src="https://api.mapbox.com/search-js/v1.0.0-beta.18/web.js"></script>

 --}}
    {{-- <style>
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
    </script> --}}

    {{-- @if (Auth::user()->adresse1 == null)
        <div class="alert alert-info">Veuillez compléter votre profil pour publier vos annonces.</div>
    @endif --}}

    @include('include.display_msg_error')

    <form action="{{ route('admin.profil.save') }}" method="post">
    @csrf



        <div class="card mb-3">

            <div class="card-header text-bg-info">
                Mon profil
            </div>

            <div class="card-body">

                <div class="row mb-3 gy-2 gx-3 align-items-center">
                    <div class="col-md-4">
                        <label for="civilite">Civilité *</label>
                        <select class="form-select" name="civilite" id="civilite" aria-label="Civilite" required>
                            <option selected></option>
                            <option value="M" {{ old('civilite', Auth::user()->civilite) == 'M' ? 'selected' : '' }}>Monsieur</option>
                            <option value="MME" {{ old('civilite', Auth::user()->civilite) == 'MME' ? 'selected' : '' }}>Madame</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="prenom">Prénom *</label>
                        <input type="text" class="form-control" name="prenom" id="prenom" value="{{ old('prenom', Auth::user()->prenom) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="name">Nom *</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required>
                    </div>
                </div>

                <div class="row mb-3 gy-2 gx-3 align-items-center">

                    <div class="col-md-6">
                        <label>Adresse email *</label>
                        <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled required>
                    </div>

                    <div class="col-md-6">
                        <label for="phone">Téléphone personnel</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone) }}">
                    </div>
                </div>

                <!-- Form buttons -->
                <div>
                    {{-- <button type="reset" class="btn btn-secondary" id="btn-reset">
                    Reset
                    </button> --}}

                    <button type="submit" class="btn btn-primary" id="btn-confirm">
                    Sauvegarder
                    </button>

                </div>

            </div>
        </div>

        <div class="card mb-3">

            <div class="card-header text-bg-info">
                Mes établissements
            </div>

            <div class="card-body">

                <div class="d-flex">
                    {{-- <a class="btn btn-primary btn-sm" href="{{ route('admin.store.edit', ['store_id' => 'new']) }}">Ajouter un établissement</a> --}}
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.store.edit.coordonnees', ['store_id' => 'new']) }}">Ajouter un établissement</a>
                </div>

                <table class="table table-striped">
                <thead>
                    <th></th>
                    <th>Nom</th>
                    <th>Code postal</th>
                    <th>Ville</th>
                </thead>
                <tbody class="table-group-divider align-middle">
                    @foreach ($stores as $store)
                        <tr>
                            @if (file_exists(public_path('storage/'.Auth::user()->pathToAsset.$store->logo)) && !is_null($store->logo))
                                <td>
                                    <img src="{{ asset('storage/'.Auth::user()->pathToAsset.$store->logo) }}">
                                </td>
                            @else
                                <td></td>
                            @endif
                            {{-- <td><a href="{{ route('admin.store.edit', ['store_id' => $store->id]) }}">{{ $store->name }}</a></td> --}}
                            <td><a href="{{ route('admin.store.edit.coordonnees', ['store_id' => $store->id]) }}">{{ $store->name }}</a></td>
                            <td>{{ $store->cp }}</td>
                            <td>{{ $store->ville }}</td>
                        </tr>
                    @endforeach
                </tbody>
                </table>

            </div>
        </div>

    </form>

@endsection