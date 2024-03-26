import './bootstrap';

import Alpine from 'alpinejs';




// Added: Actual Bootstrap JavaScript dependency
import 'bootstrap';
import 'select2';
import { Modal, Toast } from 'bootstrap'

// Added: Popper.js dependency for popover support in Bootstrap
import '@popperjs/core';
import mapboxgl from 'mapbox-gl';
import { categories } from './pages/categories';
import { produits } from './pages/produits';

// import "/node_modules/select2/dist/css/select2.css";


window.Alpine = Alpine;


$('#select_attribut').select2()

  const quill = new Quill('#editor', {
    theme: 'snow'
  });

  quill.on('text-change', function(delta, oldDelta, source) {
    var t = quill.root.innerHTML;
    console.log(t)
    $('#description_ghost').val(t)
  })


Alpine.start();

// mapboxgl.accessToken = 'pk.eyJ1Ijoia3JlZWwiLCJhIjoiY2s2cWF6Ym1hMG05YzNlcW93ZmJ2MjltOSJ9.5xkYxieaS2vXT506fBOgEA';
// const map = new mapboxgl.Map({
//     container: 'map', // container ID
//     style: 'mapbox://styles/mapbox/streets-v12', // style URL
//     center: [5.929245683829187, 43.124637357989016], // starting position [lng, lat]
//     zoom: 13, // starting zoom
// });




categories(Toast);
produits(Toast);


// Basic

