@extends('layouts.admin',['menu' => 'Mon profil'])

@section('content')

<link href="https://api.mapbox.com/mapbox-assembly/v1.3.0/assembly.min.css" rel="stylesheet">
<script id="search-js" defer="" src="https://api.mapbox.com/search-js/v1.0.0-beta.18/web.js"></script>

    <style>
    .hide {
    display: none;
    }
    </style>


    <h3>Mon profil</h3>

    <form action="{{ route('admin.profil.save') }}" method="post">
    @csrf

    <div class="row gy-2 gx-3 align-items-center">
        <div class="col-auto">
            <label for="civilite">Civilité</label>
            <select class="form-select" name="civilite" id="civilite" aria-label="Civilite">
                <option selected></option>
                <option value="M">Monsieur</option>
                <option value="MME">Madame</option>
            </select>
        </div>

        <div class="col-auto">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" name="prenom" id="prenom">
        </div>

        <div class="col-auto">
            <label for="name">Nom</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
    </div>

    <div class="row gy-2 gx-3 align-items-center">

        <div class="col-auto">
            <label>Adresse email</label>
            <input type="text" class="form-control" value="{{ Auth::user()->email }}" disabled>
        </div>

        <div class="col-auto">
            <label for="phone">Numéro de téléphone</label>
            <input type="text" class="form-control" name="phone" id="phone">
        </div>
    </div>

    <div class="flex flex--column">
    <div class="grid grid--gut24 mb60">
        <div class="col col--auto-mm w-full">
         
        <!-- Input form -->
        <label class="txt-s txt-bold color-gray mb3">Adresse de l'établissement</label>
        <input class="input mb12" placeholder="Commencez à taper votre adresse, ex. 123 rue..." autocomplete="address-line1" id="mapbox-autofill">
        <div id="manual-entry" class="w180 mt6 link txt-ms border-b color-gray color-black-on-hover">
        Entrez votre adresse manuellement
        </div>
        <div class="secondary-inputs hide">
        <label class="txt-s txt-bold color-gray mb3">Addresse ligne 2</label>
        <input name="adresse2" class="input mb12" placeholder="Complément d'adresse" autocomplete="address-line2">
        <label class="txt-s txt-bold color-gray mb3">Ville</label>
        <input name="ville" class="input mb12" placeholder="Ville" autocomplete="address-level2">
        <label class="txt-s txt-bold color-gray mb3">Région</label>
        <input name="region" class="input mb12" placeholder="Région" autocomplete="address-level1">
        <label class="txt-s txt-bold color-gray mb3">Code postal</label>
        <input name="cp" class="input" placeholder="Code postal" autocomplete="postal-code">
        </div>
        </div>
        <div class="col col--auto-mm">
        <!-- Visual confirmation map -->
        <div id="minimap-container" class="none h240 w360 relative mt18"></div>
        <div id="map" class="none h240 w360 relative mt18"></div>
        </div>
        </div>
    </div>
         
        <!-- Form buttons -->
        <div class="mb30 submit-btns hide">
        <button type="submit" class="btn round" id="btn-confirm">
        Confirm
        </button>
        <button type="button" class="btn round btn--gray-light" id="btn-reset">
        Reset
        </button>
        </div>


    </form>

    <div id="validation-msg" class="mt24 txt-m txt-bold none">Test</div>


    <script>
        // TO MAKE THE EXAMPLE WORK YOU MUST
        // ADD YOUR ACCESS TOKEN FROM
        // https://account.mapbox.com
        const ACCESS_TOKEN = "{{ env('MAPBOX_ACCESS_TOKEN') }}";
         
        let autofillCollection;
        let minimap;
         
        // Form operation functions
        function showMap() {
        const el = document.getElementById("minimap-container");
        el.classList.remove("none");
        }
        function hideMap() {
        const el = document.getElementById("minimap-container");
        el.classList.add("none");
        }
        function expandForm() {
        document.getElementById("manual-entry").classList.add("hide");
        document.querySelector(".secondary-inputs").classList.remove("hide");
        document.querySelector(".submit-btns").classList.remove("hide");
        }
        function collapseForm() {
        document.getElementById("manual-entry").classList.remove("hide");
        document.querySelector(".secondary-inputs").classList.add("hide");
        document.querySelector(".submit-btns").classList.add("hide");
        }
        function setValidationText(color, msg, clear = false) {
        const validationTextElement = document.getElementById("validation-msg");
        if (clear) validationTextElement.classList.add("none");
        validationTextElement.classList.remove("color-green", "color-red");
        validationTextElement.classList.add(`color-${color}`);
        validationTextElement.innerText = msg;
        validationTextElement.classList.remove("none");
        }
        function submitForm() {
        setValidationText("green", "Order successfully submitted.");
        setTimeout(() => {
        resetForm();
        }, 2500);
        }
        function resetForm() {
        const inputs = document.querySelectorAll("input");
        inputs.forEach(input => input.value = "");
        collapseForm();
        setValidationText("green", "", true)
        autofillCollection.update();
        minimap.feature = null;
        }
         
        // Bind functions to HTML buttons
        document
        .getElementById("manual-entry")
        .addEventListener("click", expandForm);
        document.getElementById("btn-reset").addEventListener("click", resetForm);
         
        // Autofill initialization
        document.getElementById("search-js").onload = () => {
        mapboxsearch.config.accessToken = ACCESS_TOKEN;
         
        autofillCollection = mapboxsearch.autofill({});
         
        minimap = new MapboxAddressMinimap();
        minimap.canAdjustMarker = true;
        minimap.satelliteToggle = true;
        minimap.onSaveMarkerLocation = (lnglat) => {
        console.log(`Marker moved to ${lnglat}`);
        };
        const minimapContainer = document.getElementById("minimap-container");
        minimapContainer.appendChild(minimap);
         
        autofillCollection.addEventListener(
        "retrieve",
        async (e) => {
        expandForm();
        if (minimap) {
        minimap.feature = e.detail.features[0];
        showMap();
        }
        }
        );
         
        // Add confirmation prompt to shipping address
        const form = document.querySelector("form");
        form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const result = await mapboxsearch.confirmAddress(form, {
        minimap: true,
        skipConfirmModal: (feature) =>
        ['exact', 'high'].includes(
        feature.properties.match_code.confidence
        )
        });
        // if (result.type === 'nochange') submitForm();
        if (result.type === 'nochange') form.submit();
        });
        }
        </script>

@endsection