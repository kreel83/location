@extends('layouts.admin',['menu' => 'Horaires de l\'établissement'])

@section('content')

    <h3>Mon établissement</h3>

    @include('include.display_msg_error')

    @include('admin.store.include.menu')
    {{-- @include('admin.store.include.menu') --}}

    <form action="{{ route('admin.store.save.horaires') }}" method="post">
    @csrf

        <div class="card mb-3">

            <div class="card-header text-bg-info text-white">
                Horaires de l'établissement
            </div>
            <input type="hidden" name="store_id" value="{{ $store->id ?? null}}">
            <div class="card-body">

                <table class="table-responsive table-striped table-sm">
                    {{-- <tr>
                        <th></th>
                        <th class="text-center">Matin</th>
                        <th></th>
                        <th class="text-center">Après-midi</th>
                    </tr> --}}
                @foreach ($jours as $key => $jour)

                    <tr>

                        <td>
                            {{ $jour }}
                        </td>
                        <td>
                            <input type="time" name="h{{$key}}[]" value="{{ $horaires[$key][0]}}"> - <input type="time" name="h{{$key}}[]" value="{{ $horaires[$key][1]}}">
                        </td>
                        <td>/</td>
                        <td>
                            <input type="time" name="h{{$key}}[]" value="{{ $horaires[$key][2]}}"> - <input type="time" name="h{{$key}}[]" value="{{ $horaires[$key][3]}}">
                        </td>

                    </tr>

                    {{-- <div class="row row-cols-lg-auto g-3 align-items-center">

                        <div class="col-12">
                            {{ $jour }}
                        </div>
                        <div class="col-12">
                            <input type="time" name="h{{$key}}[]"> à <input type="time" name="h{{$key}}[]">
                        </div>
                        <div class="col-12">
                            <input type="time" name="h{{$key}}[]"> à <input type="time" name="h{{$key}}[]">
                        </div>
    
                    </div> --}}
                @endforeach
                </table>
                

                

                <!-- Form buttons -->
                <div class="mt-3">
                    <a href="{{ route('admin.profil') }}" class="btn btn-outline-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>

            </div>
        </div>

    </form>

@endsection