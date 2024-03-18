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
