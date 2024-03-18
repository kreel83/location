<div>

    @foreach ($attributs_cat  as $attribut )


        <div class="form-group row my-2">
            <div class="col-md-6 text-end">
                <label class="text-end" for="">{{$attribut->attribut->name}}</label>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" value="{{isset($catalogue) ? $attribut->getvalue() : null}}" name="attribut[categorie][{{$attribut->id}}]">
            </div>
            <div class="col-md-1">
                {{$attribut->attribut->suffixe}}
            </div>
        </div>
    @endforeach
</div>