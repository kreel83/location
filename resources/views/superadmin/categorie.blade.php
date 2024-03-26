@extends('layouts.superadmin')

@section('content')

<a href="{{ route('superadmin.categories') }}">Retour aux catégories</a>

<h3>{{ $categorie->name }}</h3>

<div class="row">

    <div class="col">
        <p>Ajouter des attributs :</p>
        <form action="{{ route('superadmin.attribut.new') }}" method="post">
        @csrf
        <input type="hidden" name="categorie_id" value="{{ $categorie->id }}">
        <input class="form-control mb-2" type="text" name="attributs" placeholder="attributs... a+b+c...">
        <select class="form-select mb-2" name="type">
            <option value="numérique">numérique</option>
            <option value="texte">texte</option>    
            <option value="liste">liste</option>
            <option value="date">date</option>
        </select>
        <input class="form-control mb-2" type="text" name="type_param" placeholder="type_param...  1+2+3...">
        <input class="form-control mb-2" type="text" name="suffixe" placeholder="suffixe">

        <button class="btn btn-primary mt-2" type="submit">Enregistrer</button>
        </form>
    </div>

    <div class="col">
        <form action="{{ route('superadmin.attribut.selection') }}" method="post">
        @csrf
            <input type="hidden" name="categorie_id" value="{{ $categorie->id }}">
            @foreach ($attributs as $attribut)
                <input type="checkbox" name="attributs[]" value="{{ $attribut->id }}" {{ $categorie->attributs->contains('id', $attribut->id) ? 'checked' : '' }}> {{ $attribut->name }}<br>
            @endforeach
            <button class="btn btn-primary mt-2" type="submit">Enregistrer</button>
        </form>
    </div>

</div>

@endsection