@extends('layouts.admin', ['menu' => 'produits'])



@section('content')
@php
    dump(session('onglet'))
@endphp
    <style>
        .carre {
            overflow: hidden;
        }

        .imagePreview .plus {
            font-size: 150px;
            color: salmon;
            font-weight: bolder;
        }

        .imagePreview {
            width: 250px;
            height: 250px;
            border-radius: 10px;
            border: 10px salmon solid;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-size: 50px;
            color: salmon;
            background-size: cover;
        }


        .uploadFile {
            display: none
        }
    </style>





    <div class="mt-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ session('onglet') == 'home' ? 'active' : null }}" id="home-tab"
                    data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home"
                    aria-selected="true">Fiche</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link{{ session('onglet') == 'categorie' ? 'active' : null }}" id="categorie-tab"
                    data-bs-toggle="tab" data-bs-target="#categories" type="button" role="tab"
                    aria-controls="categorie" aria-selected="false">Catégorie</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link{{ session('onglet') == 'caracteristique' ? 'active' : null }}"
                    id="caracteristique-tab" data-bs-toggle="tab" data-bs-target="#caracteristiques" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Carateristiques</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ session('onglet') == 'photos' ? 'active' : null }}" id="photos-tab"
                    data-bs-toggle="tab" data-bs-target="#photos" type="button" role="tab" aria-controls="profile"
                    aria-selected="false">Photos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link{{ session('onglet') == 'articles' ? 'active' : null }}" id="articles-tab"
                    data-bs-toggle="tab" data-bs-target="#articles" type="button" role="tab" aria-controls="profile"
                    aria-selected="false">Articles</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link{{ session('onglet') == 'tarifs' ? 'active' : null }}" id="tarifs-tab"
                    data-bs-toggle="tab" data-bs-target="#tarifs" type="button" role="tab" aria-controls="profile"
                    aria-selected="false">Grilles tarifaires</button>
            </li>

        </ul>
        <input type="hidden" name="id" value="{{ $produit->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <div class="row">
            @csrf
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{ session('onglet') == 'home' ? 'show active' : null }}" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-md-12">
                        <form action="{{ route('admin.produits.create') }}" method="POST" id="mainForm">
                            @csrf
                            <input type="hidden" name="item_id" value="{{$produit->id}}">


                            <div class="form-group">
                                <label for="">marque</label>
                                <select name="marque_id" class="form-select">
                                    <option value="">Veuillez sélectionner</option>
                                    @foreach ($marques as $marque)
                                        <option value="{{$marque->id}}" {{$marque->id == $produit->marque_id ? 'selected' : null}}>{{$marque->name}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="">nom</label>
                                <input type="text" name="name" value="{{ $produit->name }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">référence</label>
                                <input type="text" name="reference" value="{{ $produit->reference }}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">description</label>
                                <textarea class="form-control d-none" name="description" id="description_ghost" cols="30" rows="10">{{ $produit->description }}</textarea>

                            </div>
                            <div id="editor"  style="min-height: 300px; height: auto">
                                {!!$produit->description!!}
                              </div>
                            <button type="submit" class="btn btn-primary mt-5">Sauvegarder</button>
                        </form>




                    </div>
                </div>
                <div class="tab-pane fade {{ session('onglet') == 'categories' ? 'show active' : null }}" id="categories" role="tabpanel" aria-labelledby="home-tab">
                    @include('admin.produits.include.categories')

                </div>
                <div class="tab-pane fade {{ session('caracteristiques') == 'categories' ? 'show active' : null }}" id="caracteristiques" role="tabpanel" aria-labelledby="home-tab">
                    @include('admin.produits.include.caracteristiques')
                </div>
                <div class="tab-pane fade {{ session('onglet') == 'photos' ? 'show active' : null }}" id="photos"
                    role="tabpanel" aria-labelledby="home-tab">
                    <form action="{{ route('admin.produits.photos_save') }}" method="POST"
                        enctype="multipart/form-data" class="mt-5">
                        <div class="row px-5">
                            @csrf
                            <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                            <div class="col-md-4">
                                <div class="carre">
                                    {{-- <div class="plus"><i class="fa-solid fa-plus"></i></div> --}}
                                    <div class="imagePreview" data-id="1">
                                        @if ($liste[0])
                                            <img src="{{ $liste[0] }}" alt="" width="220"
                                                height="220">
                                        @else
                                            <i class="fa-solid fa-plus"></i>
                                        @endif
                                    </div>

                                    <input class="uploadFile" type="file" name="image[photo1]" data-id="1" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="carre">
                                    {{-- <div class="plus"><i class="fa-solid fa-plus"></i></div> --}}
                                    <div class="imagePreview" data-id="2">
                                        @if ($liste[1])
                                            <img src="{{ $liste[1] }}" alt="" width="220"
                                                height="220">
                                        @else
                                            <i class="fa-solid fa-plus"></i>
                                        @endif
                                    </div>
                                    <input class="uploadFile" type="file" name="image[photo2]" data-id="2" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="carre">
                                    {{-- <div class="plus"><i class="fa-solid fa-plus"></i></div> --}}
                                    <div class="imagePreview" data-id="3">
                                        @if ($liste[2])
                                            <img src="{{ $liste[2] }}" alt="" width="220"
                                                height="220">
                                        @else
                                            <i class="fa-solid fa-plus"></i>
                                        @endif
                                    </div>
                                    <input class="uploadFile" data-id="3"type="file" name="image[photo3]" />
                                </div>
                            </div>
                            <button class="btn btn-primary mt-5" type="submit" style="width: 220px">Sauvegarder</button>

                        </div>

                    </form>
                </div>
                <div class="tab-pane fade {{ session('onglet') == 'articles' ? 'show active' : null }}" id="articles" role="tabpanel" aria-labelledby="home-tab">
                    @include('admin.produits.include.articles_liste')
                </div>
                <div class="tab-pane fade {{ session('onglet') == 'tarifs' ? 'show active' : null }}" id="tarifs" role="tabpanel" aria-labelledby="home-tab">
                    @include('admin.grilles.tarifs')
                </div>
            </div>



            {{-- <div class="col-md-6">
                <h3>les attributs de catégories</h3>
                <div id="listeAttributs">
                    @if ($produit->id)
                    @include('admin.produits.listeAttributs')
                    
                    @else
                    <div class="alert alert-info">Sélectionnez une catégorie pour voir ses attributs</div>
                    @endif
                </div>
                @php
                
            @endphp
                <h3>les attributs de produits</h3>
    
                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#listeAttributsModal">Ajouter un attribut</button>
    
                
                <div id="listeAttributsproduits">
                    @include('admin.produits.listeAttributsproduits')  
         
                </div>
            </div> --}}

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
                @foreach ($attributs_liste as $attribut)
                    <option value="{{ $attribut->id}}">{{ $attribut->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="choixAttribut" data-produit="{{$produit->id}}">Choisir</button>
        </div>
      </div>
    </div>
  </div> --}}

    <!-- Modal -->
    <div class="modal fade" id="createproduitModal" tabindex="-1" aria-labelledby="listeAttributsModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.produits.add_produits') }}" method="POST">
                    @csrf
                    <input type="hidden" name="produit" value="{{ $produit->id }}">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nombre de produits à louer dans cette produit</label>
                            <input type="number" class="form-control" name="nb" value="1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="createproduit"
                            data-produit="{{ $produit->id }}">Créer la produit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
