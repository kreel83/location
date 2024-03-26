@extends('layouts.superadmin')

@section('content')

{!! $tree !!}

{{-- <form action="{{ route('superadmin.attributs.post') }}" method="post">
@csrf

<select class="form-select mb-2" name="categorie_id">
@foreach ($categories as $categorie)
    <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
@endforeach
</select>

<input class="form-control mb-2" type="text" name="attributs" placeholder="attributs... a+b+c...">
<select class="form-select mb-2" name="type">
    <option value="numérique">numérique</option>
    <option value="texte">texte</option>    
    <option value="liste">liste</option>
    <option value="date">date</option>
</select>
<input class="form-control mb-2" type="text" name="type_param" placeholder="type_param...  1+2+3...">
<input class="form-control mb-2" type="text" name="suffixe" placeholder="suffixe">

<button type="submit">Enregistrer</button>
</form> --}}

@endsection