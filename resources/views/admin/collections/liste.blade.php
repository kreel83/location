@extends('layouts.admin',['menu' => 'produits'])

@section('content')
<h3>Liste des produits</h3>

<a href="{{route('admin.collections.new',['collection_id' => 'new'])}}" class="btn btn-primary my-5">Ajouter une collection</a>
<div>
   
    <table class="table table-bordered table-striped">
        @foreach ($collections as $collection)
        <tr>
            <td>
                <a href="{{route('admin.collections.new',['collection_id' => $collection->id])}}">voir</a>
            </td>
            <td>{{$collection->id}}</td>
            <td>{{$collection->reference}}</td>
            <td>{{$collection->name}}</td>
            <td>{{$collection->description}}</td>
        </tr>
        @endforeach

    </table>

</div>
@endsection