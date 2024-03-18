<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<style>
    .action {
        cursor: pointer;
    }
</style>
    <body>
        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Espace Administration</h3>
                </div>
    
                <ul class="list-unstyled components">
                    
                    {{-- <li class="active"> --}}
                    <li>
                        {{-- <a href="#homeSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Accueil</a> --}}
                        <a href="{{ route('admin.dashboard') }}">Tableau de bord</a>
                    </li>
                    
                    <li>
                        @php
                            $collapse = 'collapsed';
                            $show = 'show';
                            if (!in_array('menu',['tarifs','produits','categories']))  $collapse = null;
                            if (in_array('menu',['tarifs','produits','categories']))  $show = null;
                            
                        @endphp

                        <a href="#articleSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle {{$collapse}}">Mes articles</a>
                        <ul class="collapse list-unstyled {{$show}}" id="articleSubmenu" >
                            <li>
                                <a href="{{ route('admin.categories')}}">Les catégories</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.catalogue')}}">Le catalogue</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.collections')}}">Mes collections</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.produits')}}">Mes produits</a>
                            </li>
                            {{-- <li>
                                
                                <a href="#produitSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle {{$collapse}}">Mes produits</a>
                                <ul class="collapse list-unstyled {{$show}}" id="produitSubmenu" style="padding-left: 30px">
                                    <li>
                                        <a href="{{ route('admin.produits.liste')}}">Liste</a>
                                    </li>
                                    <li>
                                        
                                        <a href="{{ route('admin.produits.create')}}">Nouveau</a>
                                    </li>

                                </ul>
                            </li> --}}
                            {{-- <li>
                                <a href="{{ route('admin.tarifs')}}">Grille tarifaire</a>
                            </li> --}}
                        </ul>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Ma page</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="#">Entete de ma page</a>
                            </li>
                            <li>
                                <a href="#">Corps de ma page</a>
                            </li>
                            <li>
                                <a href="#">Pied de ma page</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('admin.profil') }}">Mon profil</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.subscribe.index') }}">Mon abonnement</a>
                    </li>
                    <li>
                        <a href="#">Aide</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contact') }}">Contact</a>
                    </li>
                </ul>
    
                <ul class="list-unstyled CTAs">
                    <li>
                        <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Voir ma page</a>
                    </li>
                    <li>
                        <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Publier ma page</a>
                    </li>
                    <li><a href="{{ route('logout')}}">Se deconnecter</a></li>
                </ul>

            </nav>
    
            <!-- Page Content  -->
            <div id="content">
    
                {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
    
                        <!-- <button type="button" id="sidebarCollapse" class="btn btn-info">
                            <i class="fas fa-align-left"></i>
                            <span>Toggle Sidebar</span>
                        </button>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-align-justify"></i>
                        </button> -->
    
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('logout')}}">Se deconnecter</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav> --}}
    
               @yield("content")
            </div>
        </div>

    </body>
    <div class="toast-container position-fixed bottom-0 end-0 p-3 ">
        <div id="infoToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
           
                <strong class="me-auto">Information</strong>
                
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                
            </div>
        </div>
    </div>  
   
</html>