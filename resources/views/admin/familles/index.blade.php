@extends('layouts.admin',['menu' => 'produits'])

@section('content')
<h3>Mes familles de  produits</h3>
<a href="{{route('')}}" class="btn btn-primary my-5">Ajouter une famille</a>

<table class="table table-hovered table-striped">

@foreach ($familles as $famille )
    <tr>
        <td><a href="#">Voir les produits</a></td>
        <td><a href="#">Parametres de la famille</a></td>
        <td>{{$famille->id}}</td>
        <td>{{$famille->name}}</td>
    </tr>
@endforeach
</table>

@endsection