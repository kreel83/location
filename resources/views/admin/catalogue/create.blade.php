@extends('layouts.admin',['menu' => 'catalogues'])

@section('content')




<div class="sticky-top d-flex">
        <div class="mx-3"action>
            @if ($catalogue->id)
            <h6><a href="{{route('admin.catalogue.new',['catalogue_id' => $catalogue->id ])}}">catalogue n° {{$catalogue->id}}</a></h6>
            @else
            <h6>Nouvelle catalogue</h6>
            @endif
        </div>
        <div class="mx-3 action" id="btnSave" data-form="mainForm"><i class="fa-regular fa-floppy-disk me-2"></i>Sauvegarde</div>
        {{-- @if ($catalogue->id)
        <a class="mx-3 action" href="{{route('admin.catalogue.photos',['catalogue_id' => $catalogue->id])}}"><i class="fa-solid fa-image me-2"></i>les photos</a>
        <a class="mx-3 action" href="{{route('admin.tarifs',['id' => $catalogue->id])}}"><i class="fa-solid fa-image me-2"></i>grille tarifaire</a>
        <a class="mx-3 action" href="{{route('admin.produits.liste_produits',['catalogue_id' => $catalogue->id])}}"><i class="fa-solid fa-image me-2"></i>les produits</a>
        @endif --}}

    
</div>
<div class="container mt-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">{{$catalogue->name ?? "Nouveau modèle"}}</button>
        </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link" id="categorie-tab" data-bs-toggle="tab" data-bs-target="#categorie" type="button" role="tab" aria-controls="categorie" aria-selected="false">Catégorie</button>
        </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Attributs</button>
        </li>

    </ul>


    <div class="mt-5">
        <form action="{{route('admin.catalogue.create')}}" method="POST" id="mainForm">
            @csrf
            <input type="hidden" name="id" value="{{$catalogue->id}}">
            <input type="hidden" name="user_id" value="{{Auth::id()}}">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    

                        {{-- <div class="form-group my-2">
                            <label for="">Liste des sous-catégories</label>
                            <select name="" id="" class="form-select">
                                <option value="null">Veuillez selectionner</option>
                                @foreach ($categories as $categorie )
                                    <option value="">{{$categorie->name}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        {{-- <div class="form-group my-2">
                            <label for="">Liste des sous-sous-catégories</label>
                            <select name="" id="" class="form-select">
                                <option value="null">Veuillez selectionner</option>
                                @foreach ($categories as $categorie )
                                    <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group mb-4">
                            <label for="">Catégorie</label>
                            <div class="d-flex">
                                @foreach ($line_cat as $cat)
                                <div class="tag-cat">{{$cat}}</div>
                                @endforeach
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="">marque</label>
                            <select name="marque_id" id="" class="form-select">
                                <option value="">Veuillez sélectionner</option>
                                @foreach ($marques as $marque )
                                    <option value="{{$marque->id}}">{{$marque->name}}</option>
                                @endforeach
                            </select>
                            
                        </div>
            
                        <div class="form-group">
                            <label for="">nom</label>
                            <input type="text" name="name" value="{{$catalogue->name}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">référence</label>
                            <input type="text" name="reference" value="{{$catalogue->reference}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">description</label>
                            <textarea class="form-control" name="description" id="" cols="30" rows="10">{{$catalogue->description}}</textarea>
                            
                        </div>
            
                        {{-- <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            @if ($catalogue->id)
                            <a type="button" class="btn btn-success" href="{{route('admin.tarifs',['id' => $catalogue->id])}}">Grille tarifaire</a>                
                                                @if ($produits->isEmpty())
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createcatalogueModal">Créer des produits dans cette catalogue</button>
                            @else
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createcatalogueModal">Ajouter des produits dans cette catalogue</button>
                            @endif
                            @endif
                        </div> --}}
        
            
                    
                </div>
                <div class="tab-pane fade" id="categorie" role="tabpanel" aria-labelledby="categorie-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                @php
                                    $lvl= 0;
                                @endphp
                                    @foreach($categories as $category)
                                    
                                        <li class="deployCategorieMain" data-id="{{$category->id}}">
                                            <span>{{ $category->name }} </span>
                                            <span class="ms-2 deployCategorie" data-id="{{$category->id}}" data-bs-toggle="modal" data-bs-target="#addCategorieModal">
                                                @if($category->children->isNotEmpty())
                                                <i class="fa-solid fa-chevron-down"></i>
                                                @endif
                                            </span> 
                                        </li>
                                       <ul data-id="{{$category->id}}">
                                            @if($category->children->isNotEmpty())
                                            @include('admin.categories.partials.subcategories', ['categories' => $category->children, 'lvl' => $lvl + 1])
                                            @endif                                        
                                       </ul>

                                    
                                @endforeach              
                            
                    
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                          <div class="attributs">
                            @foreach ($attributs as $attribut)
                              <div>{{$attribut->name}}</div>
                            @endforeach
                    
                          </div>
                        </div> --}}
                    </div>
                </div>    
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    
                        <h3>les attributs de catégories</h3>
                        <div id="listeAttributs">
                        
                            @include('admin.catalogue.listeAttributsCategories')
        
                        </div>
                        @php
                        
                    @endphp
                        <h3>les attributs de catalogues</h3>
            
                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#listeAttributsModal">Ajouter un attribut</button>
            
                        
                        <div id="listeAttributsCatalogue">
                            @include('admin.catalogue.listeAttributscatalogues')  
                
                        </div>
                    </div>
                

            </div>

        </form>
    </div>    
</div>



<!-- Modal -->
<div class="modal fade" id="listeAttributsModal" tabindex="-1" aria-labelledby="listeAttributsModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <select name="" id="listeAttributs" class="form-select">
                <option value="null">Veuillez selectionner</option>
                @foreach ($attributs_liste as $attribut )
                    <option value="{{ $attribut->id}}">{{ $attribut->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="choixAttribut" data-catalogue="{{$catalogue->id}}">Choisir</button>
        </div>
      </div>
    </div>
  </div>



@endsection