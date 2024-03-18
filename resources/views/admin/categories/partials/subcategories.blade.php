@foreach($categories as $category)

   
    <li style="margin-left: {{$lvl * 25}}px">{{ $category->name }}
        @if ($lvl < 2)
        <span class="ms-2 addCategorie" data-id="{{$category->id}}" data-bs-toggle="modal" data-bs-target="#addCategorieModal"><i class="fa-solid fa-circle-plus"></i></span>    
        @endif
    </li>
   
    @if($category->children->isNotEmpty())
        @include('admin.categories.partials.subcategories', ['categories' => $category->children, 'lvl' => $lvl + 1])
    @endif
@endforeach