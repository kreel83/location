<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link {{ $menuActive == 'coordonnees' ? 'active' : ''}}" href="{{ route('admin.store.edit.coordonnees', ['store_id' => $store->id]) }}">Coordonnées</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $menuActive == 'horaires' ? 'active' : ''}}" href="{{ route('admin.store.edit.horaires', ['store_id' => $store->id]) }}">Horaires</a>
      {{-- <a class="nav-link disabled" aria-disabled="true">Disabled</a> --}}
    </li>    
    <li class="nav-item">
        <a class="nav-link {{ $menuActive == 'conges' ? 'active' : ''}}" href="{{ route('admin.store.edit.conges', ['store_id' => $store->id]) }}">Congés</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $menuActive == 'infos' ? 'active' : ''}}" href="{{ route('admin.store.edit.infos', ['store_id' => $store->id]) }}">Plus d'infos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $menuActive == 'logo' ? 'active' : ''}}" href="{{ route('admin.store.edit.logo', ['store_id' => $store->id]) }}">Logo</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $menuActive == 'photos' ? 'active' : ''}}" href="{{ route('admin.store.edit.photos', ['store_id' => $store->id]) }}">Photos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $menuActive == 'social' ? 'active' : ''}}" href="{{ route('admin.store.edit.social', ['store_id' => $store->id]) }}">Réseaux sociaux</a>
    </li>
</ul>