@extends('layouts.admin',['menu' => 'tarifs'])

@section('content')
<div class="sticky-top d-flex">
  <div class="me-5">
      @if ($collection->id)
      <h6>Collection n° {{$collection->id}}</h6>
      @else
      <h6>Nouvelle collection</h6>
      @endif
  </div>
  
</div>
  <div class="mt-3">
    <table class="table table-bordered table-hovered">
        @foreach ($produits as $produit)
            <tr>
                <td><a href="{{route('admin.produits.show',['produit_id' => $produit->id])}}">voir</a> </td>
                <td>{{$produit->id}}</td>
                <td>{{$produit->name}}</td>
                <td>{{$produit->active}}</td>
            </tr>
        @endforeach
        </table>
</div>
@endsection