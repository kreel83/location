<div class="mt-5">
    <div class="btn btn-primary" data-bs-target="#addCaracteristiquesModal" data-bs-toggle="modal">Ajouter une caractéristique</div>
    <table class="table table-striped table-bordered mt-3">
        @foreach ($caracteristiques as $caracteristique)
        <tr>
            <td>{{$caracteristique->id}}</td>
            <td>{{$caracteristique->attribut->name}}</td>
            <td>{{$caracteristique->value}} {{$caracteristique->attribut->suffixe}}</td>
        </tr>
        @endforeach
    </table>
</div>

  <!-- Modal -->
  <div class="modal fade" id="addCaracteristiquesModal" tabindex="-1" aria-labelledby="addCaracteristiquesModal" aria-hidden="true">
    <div class="modal-dialog" style="top: 200px">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="">Attribut</label>
                <select id="select_attribut">
                    
                    @foreach ($attributs as $attribut )
                        <option data-liste="{{$attribut->type_param}}" value="{{$attribut->id}}" data-type="{{$attribut->type}}" data-suffixe="{{$attribut->suffixe}}">{{$attribut->name}}</option>
                    @endforeach
                </select>
            </div>

          
            <div class="form-group my-3 bloc_valeur {{$attribut->type == 'liste' ? null : 'd-none' }}" data-type="liste"  >
            
              <label for="">Valeur</label>
              <div class="input-group">                    
                <select class="form-select" id="type_param">
                
              </select>
              </div>
             
          </div>               
           
              <div class="form-group my-3 bloc_valeur {{$attribut->type != 'liste' ? null : 'd-none' }}" data-type="autre" >
                  <label for="">Valeur</label>
                  <div class="input-group">                    
                      <input type="text" class="form-control" id="valeur" aria-label="valeur" aria-describedby="attribut_suffixe">
                      <span class="input-group-text d-none" id="attribut_suffixe"></span>
                  </div>
              </div>            
            


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="button" id="addCaracteristiques" data-bs-dismiss="modal" data-item="{{$produit->id}}" class="btn btn-primary">Ajouter l'attribut</button>
        </div>
      </div>
    </div>
  </div>