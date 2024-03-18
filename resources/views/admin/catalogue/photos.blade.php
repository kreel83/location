@extends('layouts.admin',['menu' => 'tarifs'])

@section('content')
<div class="sticky-top d-flex">
  <div class="me-5">
      @if ($collection->id)
      <h6>Collection n° {{$collection->id}}</h6>
      @else
      <h6>Nouvelle collection</h6>
      @endif
  </div>
  
</div>

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


    .uploadFile{
    display: none
    }
</style>

<form action="{{ route('admin.collections.photos_save')}}" method="POST" enctype="multipart/form-data">
<div class="row px-5">
        @csrf
        <input type="hidden" name="collection_id" value="{{$collection->id}}">
        <div class="col-md-4">
            <div class="carre">
                {{-- <div class="plus"><i class="fa-solid fa-plus"></i></div> --}}
                <div class="imagePreview" data-id="1" >
                    @if ($liste[0])
                    <img src="{{$liste[0]}}" alt="" width="220" height="220">
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
                <div class="imagePreview" data-id="2" >
                    @if ($liste[1])
                    <img src="{{$liste[1]}}" alt="" width="220" height="220">
                    @else
                    <i class="fa-solid fa-plus"></i>
                    @endif
                </div>
                <input class="uploadFile" type="file" name="image[photo2]" data-id="2"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="carre">
                {{-- <div class="plus"><i class="fa-solid fa-plus"></i></div> --}}
                <div class="imagePreview" data-id="3" >
                    @if ($liste[2])
                    <img src="{{$liste[2]}}" alt="" width="220" height="220">
                    @else
                    <i class="fa-solid fa-plus"></i>
                    @endif
                </div>
                <input class="uploadFile"  data-id="3"type="file" name="image[photo3]"  />
            </div>
        </div>  
        <button class="btn btn-primary mt-5" type="submit" style="width: 220px">Sauvegarder</button>      
        
    </div>

</form>

@endsection