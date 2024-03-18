@extends('layouts.admin',['menu' => 'Coordonnées de l\'établissement'])

@section('content')

    <h3>Mon établissement</h3>

    @include('include.display_msg_error')

    @include('admin.store.include.menu')

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