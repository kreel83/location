<div class="form-group row my-2" class="line_attribut" data-id="{{$attribut->id}}">
    <div class="col-md-6 text-end">
        <label class="text-end" for="">{{$attribut->name}}</label>
    </div>
    <div class="col-md-5">
        <input type="text" class="form-control" value="{{$collection->getvalue($attribut->id) ?? null}}" name="attribut[collection][{{$attribut->id}}]">
    </div>
    <div class="col-md-1">
        {{$attribut->suffixe}}
    </div>
</div>