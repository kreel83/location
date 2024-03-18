<div>

    @foreach ($attributs_produit  as $attribut )
        
  
        <div class="form-group row my-2">
            <div class="col-md-6 text-end">
                <label class="text-end" for="">{{$attribut->attribut->name}}</label>
            </div>

            <div class="col-md-5">
                <input type="text" class="form-control" value="{{$attribut->getvalue()}}" name="attribut[catalogue][{{$attribut->attribut_id}}]">
            </div>
 
            <div class="col-md-1">
                {{$attribut->attribut->suffixe}}
            </div>
        </div>
    @endforeach
</div>