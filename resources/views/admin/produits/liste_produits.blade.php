@extends('layouts.admin',['menu' => 'tarifs'])

@section('content')

  <div class="mt-3">
    <table class="table table-bordered table-hovered">
        @foreach ($produits as $produit)
            <tr>
                <td><a href="{{route('admin.produits.new',['produit_id' => $produit->id])}}">voir</a> </td>
                <td>{{$produit->id}}</td>
                <td>{{$produit->name}}</td>
                
            </tr>
        @endforeach
        </table>
</div>
@endsection