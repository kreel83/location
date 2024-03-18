@extends('layouts.admin',['menu' => 'categories'])

@section('content')
<h3>Les catégories<span class="ms-2 addCategorie" style="font-size: 18px" data-id="null" data-bs-toggle="modal" data-bs-target="#addCategorieModal"><i class="fa-solid fa-circle-plus"></i></span> </h3>


<div class="row">
    <div class="col-md-6">
        <div>
            @php
                $lvl= 0;
            @endphp
                @foreach($categories as $category)
                <ul>
                    <li>
                        <span>{{ $category->name }} </span>
                        <span class="ms-2 addCategorie" data-id="{{$category->id}}" data-bs-toggle="modal" data-bs-target="#addCategorieModal"><i class="fa-solid fa-circle-plus"></i></span> 
                    </li>
                   
                    @if($category->children->isNotEmpty())
                    @include('admin.categories.partials.subcategories', ['categories' => $category->children, 'lvl' => $lvl + 1])
                    @endif
                </ul>
            @endforeach              
        

        </div>
    </div>
    <div class="col-md-6">
      <div class="attributs">
        @foreach ($attributs as $attribut)
          <div>{{$attribut->name}}</div>
        @endforeach

      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addCategorieModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une catégorie</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="text" class="form-control form-control-lg" id="new_category" data-lvl="null">
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="button" id="addCategorieBtn" class="btn btn-primary" data-bs-dismiss="modal">Ajouter</button>
        </div>
      </div>
    </div>
  </div>


 
@endsection