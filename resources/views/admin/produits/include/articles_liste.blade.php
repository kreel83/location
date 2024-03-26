<div class="mt-5">
    <button class="btn btn-primary" data-bs-target="#createproduitModal" data-bs-toggle="modal">Ajouter des articles à louer</button>

    <table class="table table-bordered table-hovered mt-3">
        @foreach ($articles as $article)
            <tr>
                <td><a href="{{route('admin.produits.new',['produit_id' => $article->id])}}">voir</a> </td>
                <td>{{$article->id}}</td>
                <td>{{$article->name}}</td>
                
            </tr>
        @endforeach
        </table>
</div>


<div class="modal fade" id="createproduitModal" tabindex="-1" aria-labelledby="listeAttributsModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('admin.produits.add_produits')}}" method="POST">
            @csrf
            <input type="hidden" name="produit" value="{{$produit->id}}" >
        
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="">Nombre de produits à ajouter à la location</label>
                <input type="number" class="form-control" name="nb" value="1">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="createproduit" data-produit="{{$produit->id}}">Créer la produit</button>
        </div>
        </form>
      </div>
    </div>
  </div>