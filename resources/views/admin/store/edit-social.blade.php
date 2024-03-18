@extends('layouts.admin',['menu' => 'Coordonnées de l\'établissement'])

@section('content')

    <h3>Mon établissement</h3>

    @include('include.display_msg_error')

    @include('admin.store.include.menu')

    <form action="{{ route('admin.store.save.social') }}" method="post">
    @csrf

        <div class="card mb-3">

            <div class="card-header text-bg-info text-white">
                Réseaux sociaux
            </div>
            <input type="hidden" name="store_id" value="{{ $store->id ?? null}}">
            <div class="card-body">

                <div class="row mb-1">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="store_instagram" class="form-label">Instagram</label>
                            <input type="text" class="form-control" name="store_instagram" id="store_instagram" value="{{ old('store_instagram', $store->instagram ?? null) }}" placeholder="Url de votre compte Instagram">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="store_linkedin" class="form-label">LinkedIn</label>
                        <input type="text" class="form-control" name="store_linkedin" id="store_linkedin" value="{{ old('store_linkedin', $store->linkedin ?? null) }}" placeholder="Url de votre compte LinkedIn">
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-md-6">
                        <label for="store_facebook" class="form-label">Facebook</label>
                        <input type="text" class="form-control" name="store_facebook" id="store_facebook" value="{{ old('store_facebook', $store->facebook ?? null) }}" placeholder="Url de votre compte Facebook">
                    </div>
                    <div class="col-md-6">
                        <label for="store_pinterest" class="form-label">Pinterest</label>
                        <input type="text" class="form-control" name="store_pinterest" id="store_pinterest" value="{{ old('store_pinterest', $store->pinterest ?? null) }}" placeholder="Url de votre compte Pinterest">
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

@endsection