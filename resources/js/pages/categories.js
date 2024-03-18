const categories = (Toast) => {

    $(document).on('click','.addCategorie', function() {
       var id = $(this).data('id')
       $('#new_category').attr('data-lvl', id)
    })

    
    $(document).on('click','#addCategorieBtn', function() {
       
       var id = $('#new_category').attr('data-lvl')
       var name = $('#new_category').val()
       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
       $.post({
        method: 'POST',
        url: '/admin/addCategorie',
        data: {
            id: id,
            name: name
        },
        success: function(data) {
            console.log(data)
            const myToastEl = document.getElementById('infoToast') 
            const myToast = new Toast(myToastEl)
          
            myToast.show()
            $(myToastEl).find('.toast-body').html(data['message'])
            
            $('#infoToast').closest('.toast-container').addClass('bg-'+data['status'])
            setTimeout(function() {
                location.reload()

            },2000)
        }
       })
       
    })
}

export {categories}