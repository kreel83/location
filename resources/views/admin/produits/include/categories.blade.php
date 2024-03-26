@php
    $defaut = 9;
@endphp

<style>
    .liste_categories tr {
        cursor: pointer;
    }
</style>

    <div class="row mt-3">
        <form action="" method="GET">
            <div class="col-md-4">
                <input type="hidden" id="choice_categorie_id" name="categorie_id">
                <input type="text" class="form-control my-2" id="choice_categorie" name="categorie_id">
               
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary mt-2">Sauvegarder</button>
            </div>

        </form>
    </div>
    <div class="row mt-3 liste_categories">
        <div class="col-md-3 premier">
        
        <table class="table table-bordered table-hover">
        @foreach ($categories as $categorie)
            <tr data-id="{{$categorie->id}}" data-parent="null" class="line">
                <td class="texte">{{$categorie->name}}</td>
            </tr>
            @endforeach
        </table>
        </div>
        <div class="col-md-3 deuxieme">
        
            <table class="table table-bordered table-hover">
                @foreach ($categories as $categorie)
                    @if($categorie->children->isNotEmpty())
                        @foreach( $categorie->children as $category)
                        <tr data-parent="{{$categorie->id}}" data-id="{{$category->id}}" class="d-none line">
                            <td class="texte">{{$category->name}}</td>
                        </tr>
                        @endforeach
                    @endif
                @endforeach
            </table>
        </div>
        <div class="col-md-3 troisieme">
       
        <table class="table table-bordered table-hover mb-0">
            @foreach ($categories as $categorie)
                @if($categorie->children->isNotEmpty())
                    @foreach( $categorie->children as $category)
                        @if($category->children->isNotEmpty())
                            @foreach( $category->children as $cat)
                            <tr data-parent="{{$category->id}}" data-id="{{$cat->id}}" class="d-none line">
                                <td class="texte">{{$cat->name}}</td>
                            </tr>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
        </table>     
       

        <input type="text" class="form-control m-0 d-none" id="new_cat3">
    </div>

</div>