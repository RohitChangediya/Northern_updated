var Gallery ={
    init:function() {
       this.bind_events();
       this.loadImage();
    },
  
    bind_events :function() {
          var self=this;
          $('#reset').on('click', function(event) {
              self.resetForm();
          });
          $('.btn-add-photo').on('click',function() {
                $('#gallery-modal').modal('show');
                $('.gallery-img-class').hide();
                $('.gallery-img-class').find('img').attr('src',"#");
          });
          $("#form").on('submit',this.onSubmitForm);
          $('.image-div').on('click','.gallery-image-edit',this.onEditImage);
          $('.image-div').on('click','.gallery-image-delete',this.onDeleteImage);
         //$( "#datatable" ).on( "click", ".view", this.onViewEnquiry);
   },
   onDeleteImage:function(){
         var self=this;
        var $this = $( this );
        var $id = $this.attr( 'image-id' );
        var cate="";
        var $formData = { action: "getimage", id: $id };

        $.ajax( {
                url: 'includes/gallery.php',
                type: 'POST',
                 dataType: "JSON",
                data: $formData,
            } )
            .done( function( data ) {
                if (data.status) {                
                  cate=data.msg;
                  swal({
                    title: 'Are you sure ?',
                    text: "Delete Image "+cate,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                  }).then(function () {
                  var $formData = { action: "delete", id: $id };

                  $.ajax({
                          url: 'includes/gallery.php',
                          type: 'POST',
                           dataType: "JSON",
                          data: $formData,
                      })
                      .done( function( data ) {
                          if (data.status) {                
                             Gallery.loadImage();
                              Gallery.resetForm();
                             Gallery.displaysucess(data.msg);

                          } else {
                           
                             Gallery.displaywarning(data.msg);
                        
                          }
                      });
                      swal(
                          'Deleted!',
                          'Your record has been deleted.',
                          'success'
                        )
                  }, function (dismiss) {
                    if (dismiss === 'cancel') {
                        swal(
                          'Cancelled',
                          'Your record is safe :)',
                          'error'
                        )
                    }
                  })
               } 
               else {
                     displaywarning(data.msg);
                  }
            });
   },
   onEditImage:function(){
        $('#myModalLabel').html('Edit Image');
        $('#gallery-modal').modal('show');
      $('.gallery-img-class').show();
      $('#image').removeAttr('required');
      var $this = $( this );
      var $id = $this.attr( 'image-id' );
      var $formData = { action: "edit", id: $id ,from:'edtiform'};
        $.ajax({
              url: 'includes/gallery.php',
              type: 'POST',
              dataType: 'json',
              data: $formData,
          })
          .done( function( $resp ) {
              if( typeof $resp !== 'undefined' ) {
                  var resp=$resp;
                  for (var i  in resp) {
                    if(i!="image")
                       $('#form [name='+i+']').val(resp[i]);
                  }
                  $('.gallery-img-class').find('img').attr('src',resp['image_path']);
              }

          })
       .always( function( $resp ){});
   },
   onSubmitForm:function(){
         var self=this;
      event.preventDefault();
      var inputFile = $('input[type=file]');   
        
      var fileToUpload1 = inputFile[0].files[0];

      var $form_data = new FormData();
      
      $('form#form').serializeArray().forEach(function(field){
              $form_data.append(field.name, field.value);
      });
      if (fileToUpload1 != 'undefined') {
          $form_data.append('image', fileToUpload1);
      } 
      
      $form_data.append("action", "save");
       // ajax adding data to database
       console.log($form_data);
       var $request = $.ajax({
            url :'includes/gallery.php',
            type: "POST",
            data: $form_data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request  
       });
       $request.done(function(data) {
        //if success close modal and reload ajax table
          if (data.status) { 
             Gallery.resetForm();
             Gallery.displaysucess(data.msg);
             $('#gallery-modal').modal("hide");
             Gallery.loadImage();
              setTimeout(function() {
             $('#reply').html('');
              },2000);
          } else {
            Gallery.resetForm();
            Gallery.displaywarning(data.msg);
            $('#gallery-modal').modal("hide");
            Gallery.loadImage();
            setTimeout(function() {
             $('#reply').html('');
              },2000);
          }
        });
        $request.always(function(data) {
           /* Book.reDrawDataTable();*/
         console.log(data);
        });
   },
   loadImage:function(){
        var $request = $.ajax({
            url :'includes/gallery.php',
            type: "POST",
            data: {"action":"list"},
            dataType: 'json'
       });
       $request.done(function(data) {
        //if success close modal and reload ajax table
          if (data.length) {
                var html="";
                for (var i in data) {
                   html+='<div class="col-lg-3 col-md-4 col-xs-6" style="border: 1px solid #ddd !important;padding: 0px;margin:2px;">\
                              <a href="#" class="d-block mb-4 h-100">\
                                <img class="img-fluid img-thumbnail" style="border:none;" src="'+data[i].image_path+'" alt="">\
                              </a>\
                            <div class="col-md-1" style="padding:0px;width:12%;">\
                                <a class="gallery-image-a gallery-image-edit left" image-id="'+data[i].id+'">\
                                    <i class="fa fa-pencil" ></i>\
                                </a>\
                            </div>\
                            <div class="col-md-9" style="padding:0px;">\
                              <h4 class="gallery-title">'+data[i].image_title+'</h4>\
                              </div>\
                            <div class="col-md-1" style="padding:0px;width:12%;">\
                                <a class="gallery-image-a gallery-image-delete right" image-id="'+data[i].id+'">\
                                <i class="fa fa-trash" ></i>\
                                </a>\
                            </div>\
                            </div>';
                }
                $('.image-div').html(html);
          }
        });
   },
    displaysucess:function(msg)
    {
        swal("Success!", msg, "success")
    },
   displaywarning:function(msg)
    {
        swal("Error!", msg, "error")
    },
    resetForm:function(){
        $('#form .form-control').val('');
         $('.gallery-img-class').hide();
        $('.gallery-img-class').find('img').attr('src',"#");
        $('#image').attr('required',"");
    }
};