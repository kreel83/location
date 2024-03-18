<!-- Login 7 - Bootstrap Brain Component -->
@extends('layouts.guest')

@section('content')
<section class="bg-light p-3 p-md-4 p-xl-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
          <div class="card border border-light-subtle rounded-4">
           
            <div class="card-body p-3 p-md-4 p-xl-5">
                <div class="row">
                    <div class="col-12">
                    <div class="mb-5">
                        <div class="text-center mb-4">
                        <a href="#!">
                            <img src="./assets/img/bsb-logo.svg" alt="BootstrapBrain Logo" width="175" height="57">
                        </a>
                        </div>
                        @if ($user)
                            @if ($active == 0)
                                <h4 class="mb-3 text-center">Félicitations ! Votre compte est maintenant actif.</h4>
                                <div class="text-center">
                                    <a class="btn btn-primary" href="{{ route('login')}}">Se connecter</a>
                                </div>
                            @else
                                <h4 class="mb-3 text-center">Votre compte est déjà actif.</h4>
                                <div class="text-center">
                                    <a class="btn btn-primary" href="{{ route('login')}}">Se connecter</a>
                                </div> 
                            @endif
                            
                        @else
                            <h4 class="mb-3 text-center">Erreur : aucun compte trouvé.</h4>
                            <p>Le lien de validation n'est pas valide.</p>
                            <p>Si vous avez besoin d'aide, vous pouvez nous contacter en <a href="#">cliquant ici</a>.</p>
                        @endif
                        
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

  </section>

  @endsection
