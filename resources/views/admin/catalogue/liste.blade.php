@extends('layouts.admin',['menu' => 'produits'])

@section('content')
<h3>Liste des produits</h3>

<button class="btn btn-primary my-5" data-bs-toggle="modal" data-bs-target="#newModelModal">Ajouter un modèle</button>
<div>
   
    <table class="table table-bordered table-striped">
        @foreach ($catalogues as $catalogue)
        <tr>
            <td>
                <a href="{{route('admin.catalogue.new',['catalogue_id' => $catalogue->id])}}">voir</a>
            </td>
            <td>{{$catalogue->id}}</td>
            <td>{{$catalogue->reference}}</td>
            <td>{{$catalogue->name}}</td>
            <td>{{$catalogue->description}}</td>
        </tr>
        @endforeach

    </table>

</div>


<!-- Modal -->
<div class="modal fade" id="newModelModal" tabindex="-1" aria-labelledby="newModelModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('admin.catalogue.new',['catalogue_id' => 'new'])}}">
           
        <div class="modal-body">
            <div class="form-group my-2">
                <label for="">catégories</label>
                <select name="categorie_id" id="categorieChoice" name="catalog" class="form-select" >
                    <option value="null">Veuillez selectionner</option>
                    @foreach ($categories as $categorie )
                        <option value="{{$categorie->id}}" {{$categorie->id == $catalogue->categorie_id ? 'selected' : null}}>{{$categorie->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection