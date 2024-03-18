@extends('layouts.admin',['menu' => 'Coordonnées de l\'établissement'])

@section('content')

    <h3>Mon établissement</h3>

    @include('include.display_msg_error')

    @include('admin.store.include.menu')

    <form action="{{ route('admin.store.save.infos') }}" method="post">
    @csrf

        <div class="card mb-3">

            <div class="card-header text-bg-info text-white">
                Description de l'entreprise
            </div>
            <input type="hidden" name="store_id" value="{{ $store->id ?? null}}">
            <div class="card-body">

                <label for="store_description" class="form-label">Cette description sera affichée sur votre page</label>
                <textarea rows="5" class="form-control" name="store_description" id="store_description">{{ old('store_description', $store->description ?? null) }}</textarea>

                <!-- Form buttons -->
                <div class="mt-3">
                    <a href="{{ route('admin.profil') }}" class="btn btn-outline-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>

            </div>
        </div>

    </form>

@endsection