@extends('layouts.admin',['menu' => 'Coordonnées de l\'établissement'])

@section('content')

    <h3>Mon établissement</h3>

    @include('include.display_msg_error')

    @include('admin.store.include.menu')

    @if($store)

        <div class="card mb-3">

            <div class="card-header text-bg-info">
                <div class="row">
                    <div class="col-md-6 text-white">
                        Fermetures de l'établissement
                    </div>
                    <div class="col-md-6 text-end text-white">
                        {{ $store->jours_ferie_zone ? 'Zone '.$store->jours_ferie_zone : ''}}
                    </div>
                </div>
            </div>

            <div class="card-body">

                @if (is_null($store->jours_ferie_zone))

                    <p>Pour indiquer les dates de fermeture veuillez au préalable choisir votre zone géographique :</p>
                    <form class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('admin.store.zone') }}" method="post">
                    @csrf
                        <input type="hidden" name="store_id" value="{{ $store->id }}">
                        <div class="col-12">
                            <select class="form-select" name="zone" required>
                                <option selected></option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->zone }}">{{ $zone->zone }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Valider</button>
                        </div>
                    </form>

                @else
                
                    <form action="{{ route('admin.store.save.conges') }}" method="post">
                    @csrf
                    <input type="hidden" name="store_id" value="{{ $store->id }}">
                    <div class="mb-3">
                        Prochaine fermeture du 
                        <input type="date" name="conges_start" value="{{ $store->conges_start }}"> 
                        au 
                        <input type="date" name="conges_end" value="{{ $store->conges_end }}">
                    </div>

                    <div>

                        <div class="card mb-3">
                            <div class="card-header">
                                Année {{ \Carbon\Carbon::now()->format('Y') }}
                            </div>
                            <div class="card-body">
                                @foreach ($joursFeriesAnneeEnCours as $jf)
                                    <div class="form-check form-check-inline">
                                    @php
                                        $selected = $joursFeries->where('id', $jf->id)->first();
                                    @endphp
                                    <input class="form-check-input" type="checkbox" name="jf[]" id="c{{ $jf->id }}" value="{{ $jf->id }}" {{ $selected ? 'checked' : null }}> 
                                    <label class="form-check-label" for="c{{ $jf->id }}" title="{{ \Carbon\Carbon::parse($jf->day)->format('d/m/Y') }}">{{ $jf->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                Année {{ \Carbon\Carbon::now()->addYear()->format('Y') }}
                            </div>
                            <div class="card-body">
                                @foreach ($joursFeriesAnneeSuivante as $jf)
                                    <div class="form-check form-check-inline">
                                    @php
                                        $selected = $joursFeries->where('id', $jf->id)->first();
                                    @endphp
                                    <input class="form-check-input" type="checkbox" name="jf[]" id="c{{ $jf->id }}" value="{{ $jf->id }}" {{ $selected ? 'checked' : null }}> 
                                    <label class="form-check-label" for="c{{ $jf->id }}" title="{{ \Carbon\Carbon::parse($jf->day)->format('d/m/Y') }}">{{ $jf->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <button class="btn btn-primary" type="submit">Sauvegarder</button>

                    </form>

                @endif

            </div>

        </div>
    @endif

@endsection