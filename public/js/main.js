$(document).ready(function () {
  window._token = $('meta[name="csrf-token"]').attr('content')

   
   var allEditors = document.querySelectorAll('.ckeditor');
    for (var i = 0; i < allEditors.length; ++i) {
      ClassicEditor
    .create( allEditors[i], {
        // The language code is defined in the https://en.wikipedia.org/wiki/ISO_639-1 standard.
        language: 'es',

    } )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    //  ClassicEditor.create();
    }


  $('.select-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', 'selected')
    $select2.trigger('change')
  })
  $('.deselect-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', '')
    $select2.trigger('change')
  })


  $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
      
    });

    function readURL(input,tr) {
    
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('#'+tr).attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }


    $(".imgInp").change(function() {
      tr = $(this).data('idimg');
      readURL(this,tr);
    });   


  const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  animation : false,
  timer: 4000
  });

   /*Notificaciones si hay mensaje de confirmacion*/

   if (document.body.dataset.notification == ""){

        var type = document.body.dataset.notificationType;
        var types = ['info', 'warning', 'success', 'error'];

    // Check if `type` is in our `types` array, otherwise default to info.
        Toast.fire({ icon: types.indexOf(type) !== -1 ? type : 'info', title: JSON.parse(document.body.dataset.notificationMessage) });
    
    }

  $('.select2').select2()

  $('.treeview').each(function () {
    var shouldExpand = false
    $(this).find('li').each(function () {
      if ($(this).hasClass('active')) {
        shouldExpand = true
      }
    })
    if (shouldExpand) {
      $(this).addClass('active')
    }
  })

   $('#table').on('click', '.btn-delete[data-remote]', function (e) { 
            e.preventDefault();
            var url = $(this).data('remote');
            
            Swal.fire({
            title: '¿Desea eliminar este registro?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText:'No',
            showLoaderOnConfirm: true,
                preConfirm: () => {

                      axios.delete(url).then(response => {

                        Toast.fire({
                          icon: 'success',
                          title: 'Operacion realizada correctamente'
                        })
                        $('#table').DataTable().draw(false);
                      
                      }).catch(error => {
                        Toast.fire({
                          icon: 'error',
                          title: 'Error de Conexion'
                        })

                      
                        console.error(error.response.data)
                      });

                }
           });
            
        });



})
