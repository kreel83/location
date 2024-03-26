



<div class="row">
    <div class="mx-3 action" data-bs-toggle="modal" data-bs-target="#addTarifModal">
      <i class="fa-solid fa-plus me-2"></i>Ajouter une tarification
    </div>
    <div class="col-md-6 text-center mx-auto mt-5">
        <table class="table table-hovered table-striped">
            @php
                $limit = 1;
            @endphp

            <thead>
                <tr>
                    <td>position</td>
                    <td>nombre de jours</td>
                    <td>tarif</td>
                    <td></td>
                </tr>
            </thead>
            @foreach ($tarifs as $key=>$tarif )
                <tr>
                    <td>{{$tarif->order}}</td>
                    <td>de {{$limit}} à {{$limit + ($tarif->nb_jour - 1)}} jours</td>
                    <td>{{$tarif->tarif}} €</td>
                    <td>
                        @if ($key == sizeof($tarifs)-1) 
                        <a href="{{route('admin.deleteTarif',['grille_id' => $tarif->id, 'id' => $produit->id])}}" style="cursor: pointer; color: red"><i class="fa-solid fa-trash"></i></a>
                        @endif
                    </td>                        
                </tr>
                @php
                    $limit += $tarif->nb_jour;
                @endphp

            @endforeach

        </table>            
    </div>
</div>



    <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="addTarifModal" tabindex="-1" aria-labelledby="addTarifModal" aria-hidden="true">
    <div class="modal-dialog" style="top: 200px">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="">Nombre de jour</label>
                <input type="number" class="form-control" id="nb_jour">
            </div>
            <div class="form-group my-3">
                <label for="">Tarif par jour</label>
                <input type="text" class="form-control" id="tarif">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="button" id="addTarif" data-item="{{$produit->id}}" class="btn btn-primary">Ajouter la ligne</button>
        </div>
      </div>
    </div>
  </div>
