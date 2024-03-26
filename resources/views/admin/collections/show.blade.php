@extends('layouts.admin',['menu' => 'catalogues'])

@section('content')




<div class="sticky-top d-flex">
        <div class="mx-3">
            
            <h6>collection n° {{$collection->id}}</h6>

        </div>
        <div class="mx-3 action" id="btnSave" data-form="mainForm"><i class="fa-regular fa-floppy-disk me-2"></i>Sauvegarde</div>
        {{-- @if ($collection->catalogue->id)
        <a class="mx-3 action" href="{{route('admin.catalogue.photos',['catalogue_id' => $collection->catalogue->id])}}"><i class="fa-solid fa-image me-2"></i>les photos</a>
        <a class="mx-3 action" href="{{route('admin.tarifs',['id' => $collection->catalogue->id])}}"><i class="fa-solid fa-image me-2"></i>grille tarifaire</a>
        <a class="mx-3 action" href="{{route('admin.produits.liste_produits',['catalogue_id' => $collection->catalogue->id])}}"><i class="fa-solid fa-image me-2"></i>les produits</a>
        @endif --}}

    
</div>
<div class="container mt-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">{{$collection->catalogue->name ?? "Nouveau modèle"}}</button>
        </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link" id="article-tab" data-bs-toggle="tab" data-bs-target="#article" type="button" role="tab" aria-controls="categorie" aria-selected="false">Articles</button>
        </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Attributs</button>
        </li>

    </ul>


    <div class="mt-5">
        <form action="{{route('admin.catalogue.create')}}" method="POST" id="mainForm">
            @csrf
            <input type="hidden" name="id" value="{{$collection->catalogue->id}}">
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
                            <input type="text" class="form-control" value="{{$collection->catalogue->marque_id}}">
                            
                        </div>
            
                        <div class="form-group">
                            <label for="">nom</label>
                            <input type="text" name="name" value="{{$collection->catalogue->name}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">référence</label>
                            <input type="text" name="reference" value="{{$collection->catalogue->reference}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">description</label>
                            <textarea class="form-control" name="description" id="" cols="30" rows="10">{{$collection->catalogue->description}}</textarea>
                            
                        </div>
            
                        {{-- <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            @if ($collection->catalogue->id)
                            <a type="button" class="btn btn-success" href="{{route('admin.tarifs',['id' => $collection->catalogue->id])}}">Grille tarifaire</a>                
                                                @if ($produits->isEmpty())
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createcatalogueModal">Créer des produits dans cette catalogue</button>
                            @else
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createcatalogueModal">Ajouter des produits dans cette catalogue</button>
                            @endif
                            @endif
                        </div> --}}
        
            
                    
                </div>
                <div class="tab-pane fade" id="article" role="tabpanel" aria-labelledby="article-tab">


                </div>    
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
{{--                     
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
                    </div> --}}
                

            </div>

        </form>
    </div>    
</div>



<!-- Modal -->
{{-- <div class="modal fade" id="listeAttributsModal" tabindex="-1" aria-labelledby="listeAttributsModal" aria-hidden="true">
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
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="choixAttribut" data-catalogue="{{$collection->catalogue->id}}">Choisir</button>
        </div>
      </div>
    </div>
  </div> --}}



@endsection
