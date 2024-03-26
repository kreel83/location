const produits = (Toast) => {



        $(document).on('change','.uploadFile', function()
        {
            var id = $(this).data('id')
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
    
            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
    
                reader.onloadend = function(){ // set image data as background of div
                    $('.imagePreview[data-id="'+id+'"]').css("background-image", "url("+this.result+")");
                    $('.imagePreview[data-id="'+id+'"]').find('i').css('display','none');
                    $('.imagePreview[data-id="'+id+'"]').find('img').remove();
                }
            }
        });

    
    $(document).on('change','#select_attribut', function() {
        var type = $(this).find(':selected').data('type')
        console.log(type)
        $('.bloc_valeur').addClass('d-none')
        if (type == 'liste') {
            var liste = $(this).find(':selected').data('liste')
           
            console.log('liste', liste[1])
            var s = '';
            for (var l in liste) {               
                s += '<option value="'+liste[l]+'">'+liste[l]+'</option>'
            }
            console.log('s', s)
            $('.bloc_valeur[data-type="liste"]').removeClass('d-none')
            $('#type_param').html(s)
        } else {
            $('.bloc_valeur[data-type="autre"]').removeClass('d-none')
        }
        $('#attribut_suffixe').addClass('d-none')
        var suffixe = $(this).find(':selected').data('suffixe')
        if (suffixe) {
            $('#attribut_suffixe').removeClass('d-none')
            $('#attribut_suffixe').text(suffixe)
        }
    })

    $(document).on('click','#addCaracteristiques', function() {
        var item = $(this).data('item')
        var attribut = $('#select_attribut').val()
        var valeur = $('#valeur').val()
        $.get('/admin/produits/add_caracteristique?item='+item+'&attribut='+attribut+'&valeur='+valeur, function(data) {            
            $('#caracteristiques').html(data)
       })

    })

    $(document).on('click','.liste_categories .premier tr', function(){
        var id = $(this).data('id')
        var texte = $(this).find('.texte').text()
        $('.liste_categories .premier tr').removeClass('active')
        $('.liste_categories .deuxieme tr').removeClass('active')
        $(this).addClass('active')

        $('.liste_categories .deuxieme tr').addClass('d-none')
        $('.liste_categories .troisieme tr').addClass('d-none')
        $('.liste_categories .deuxieme tr[data-parent="'+id+'"]').removeClass('d-none')
        $('.liste_categories .premier input').val(texte)
        $('.liste_categories .premier input').attr('data-id',id)
        $('#new_cat3').addClass('d-none')
    });

    $(document).on('click','.liste_categories .deuxieme tr', function(){
        $('.liste_categories .deuxieme tr').removeClass('active')
        $(this).addClass('active')
        var id = $(this).data('id')
        $('.liste_categories .troisieme tr').addClass('d-none')
        $('.liste_categories .troisieme tr[data-parent="'+id+'"]').removeClass('d-none')
        $('#new_cat3').removeClass('d-none')
    });

    $(document).on('click','.liste_categories .troisieme tr', function(){
        $('.liste_categories .troisieme tr').removeClass('active')
        $(this).addClass('active')
    });

    $(document).on('keyup','.liste_categories #new_cat3', function(e) {
        if (e.key == 'Enter') {
            var texte = $(this).val()
            var parent = $('.deuxieme .active').data('id')
            $.get('/admin/categories/add?texte='+texte+'&parent_id='+parent, function(data) {
                $('.troisieme tbody').append(data)
                $('#new_cat3').val('')
            })            
        }

    });

    $(document).on('click','.liste_categories tr', function(){
        var id = $(this).data('id')
        var texte = $(this).find('.texte').text()
        $('#choice_categorie').val(texte)
        $('#choice_categorie_id').val(id)
        $('#choice_categorie').attr('data-id',id)
    });


    $(document).on('click','.imagePreview', function(){
        var id = $(this).data('id')
        console.log('id', id)
      $('.uploadFile[data-id="'+id+'"]').click();
    });

  
    $(document).on('click','#btnSave', function() {
        var form = $(this).data('form')
        $('#'+form).trigger('submit')
    })
      
   
    
    $(document).on('click','#addTarif', function() {
        var nb_jour = $('#nb_jour').val()
        var tarif = $('#tarif').val()        
        var item = $(this).data('item')
        $.get('/admin/produits/addTarif?item='+item+'&nb_jour='+nb_jour+'&tarif='+tarif, function(data) {            
             window.location.reload()
        })
        // $.get('/admin/produits/produitChoice?cat='+id, function(data) {            
        //      $('#listeAttributs').html(data)
        // })
    })

    $(document).on('change','#categorieChoice', function() {
        var id = $(this).val()
        $.get('/admin/produits/categorieChoice?cat='+id, function(data) {            
             $('#listeAttributs').html(data)
        })
        // $.get('/admin/produits/produitChoice?cat='+id, function(data) {            
        //      $('#listeAttributs').html(data)
        // })
    })

    $(document).on('click','#choixAttribut', function() {
        var id = $("#listeAttributsModal select").find(":selected").val()
        console.log(id)
        var catalogue = $(this).data('catalogue')
        $.get('/admin/catalogue/choixAttribut?attribut='+id+'&catalogue='+catalogue, function(data) {  
            console.log(data)          
             $('#listeAttributsCatalogue').append(data)
        })
        // $.get('/admin/produits/produitChoice?cat='+id, function(data) {            
        //      $('#listeAttributs').html(data)
        // })
    })
}


export {produits}
