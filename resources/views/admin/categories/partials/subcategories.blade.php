@foreach($categories as $category)


    <li style="margin-left: {{$lvl * 25}}px">{{ $category->name }}
        @if ($lvl < 2)
        <span class="ms-2 deployCategorie" data-id="{{$category->id}}" >
            @if($category->children->isNotEmpty())
            <i class="fa-solid fa-chevron-down"></i>
            @endif
        </span>    
        @endif
    </li>
    <ul data-id="{{$category->id}}">
        @if($category->children->isNotEmpty())
            @include('admin.categories.partials.subcategories', ['categories' => $category->children, 'lvl' => $lvl + 1])
        @endif          
    </ul>
  
  

@endforeach