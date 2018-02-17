var Clients ={
    init:function() {
       this.bind_events();
       this.reload_table();
        
    },
  
    reDrawDataTable:function() {
        $('#datatable').dataTable().fnDestroy();
        this.reload_table();
    },

    bind_events :function() {
          var self=this;
          $('#resetmem').on('click', function(event) {
              event.preventDefault();
              self.resetmem();
          });
          $('.btn-add-client').on('click',function(){
              $('#client-modal').modal("show");
              self.resetForm();
              $('#myModalLabel').html('Add New Clients');
          });
         $("#form").on('submit',this.onSubmitClientsForm);
         $('#updatemem').on('click', this.onUpdate);
         $( "#datatable" ).on( "click", ".edit", this.onEditClients);
         $( "#datatable" ).on( "click", ".delete", this.onDeleteClients); 
         $('#reset').on('click',this.resetForm);
         
   },  
   onDeleteClients:function(){
        var self=this;
        var $this = $( this );
        var $id = $this.attr( 'data-id' );
        var cate="";
        var $formData = { action: "getcat", id: $id };

        $.ajax( {
                url: 'includes/Clients.php',
                type: 'POST',
                 dataType: "JSON",
                data: $formData,
            } )
            .done( function( data ) {
                if (data.status) {                
                  cate=data.msg;
                  swal({
                    title: 'Are you sure ?',
                    text: "Delete Clients "+cate,
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
                          url: 'includes/Clients.php',
                          type: 'POST',
                           dataType: "JSON",
                          data: $formData,
                      })
                      .done( function( data ) {
                          if (data.status) {                
                              Clients.reDrawDataTable();
                              Clients.resetForm();
                             Clients.displaysucess(data.msg);

                          } else {
                            Clients.reDrawDataTable();
                             Clients.displaywarning(data.msg);
                        
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
                     Clients.displaywarning(data.msg);
                  }
            });
        },

    onEditClients:function(){
      $('#myModalLabel').html('Edit Clients');
      $('#client-modal').modal("show");
       $('.logo-img-class').show();
      $('#image').removeAttr('required');
      var $this = $( this );
      var $id = $this.attr( 'data-id' );
      var $formData = { action: "edit", id: $id ,from:'edtiform'};
        $.ajax({
              url: 'includes/Clients.php',
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
                  $('.logo-img-class').find('img').attr('src',resp['logo']);
                  
              }
          })
       .always( function( $resp ){});
    } ,

   onUpdate:function(){
        event.preventDefault();
       
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
      
      $form_data.append("action", "update");
         
       
        var $request = $.ajax({
              url :'includes/Clients.php',
              type: "POST",
              data: $form_data,
              dataType: "JSON",
              cache: false,              
              processData: false, // Don't process the files
              contentType: false,
            });
            $request.done(function(data) {
              //if success close modal and reload ajax table
               if (data.status) { 
                   Clients.resetForm();
                   Clients.displaysucess(data.status);
                    setTimeout(function() {
                   $('#reply').html('');
                    },2000);
                } else {
                  Clients.resetForm();
                  Clients.displaywarning(data.status);
                  setTimeout(function() {
                   $('#reply').html('');
                    },2000);
                }
            });
    },
    reload_table:function()
    {
      data = {
          "action": "datatable"
      };
        console.log(data);
      Table = $('#datatable').DataTable( {
          "processing": true,
          "language": {
              "processing": "Hang on. Waiting for response..." //add a loading image,simply putting <img src="loader.gif" /> tag.
          },
           "sPaginationType": "full_numbers",
            "bSearchable":true,
            "bFilter": true,
            "bInfo": true,
            "bLengthChange": false,
          "deferRender": true,
          "columnDefs": [ {
              "targets": [ -1 ],
              "orderable": false,
              "searchable": true,
          } ],
          "order": [
              [ 1, 'asc' ]
          ],
          "lengthMenu": [
              [ 10, 100, 100, 50,10,10],
              [ 10, 100, 100, 50,10,10]
          ],
          "ajax": {
              url: "includes/Clients.php",
              // json datasource
              type: "POST",
              // method  , by default get
              data: data,
              error: function( res ) {
                  //$( "#error-msg" ).html( res );
                  console.log( res.responseText );
                  //$( "#msg" ).html( res.responseText );
                  $( "#datatable" ).append( '<tbody class="datatable_error"><tr><th colspan="10">No data found in the server</th></tr></tbody>' );
                  $( "#datatable_processing" ).css( "display", "none" );
              }
          }
      } );

      $( '.datatable_error' ).hide();
    },

   onSubmitClientsForm:function(){
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
       var $request = $.ajax({
            url :'includes/Clients.php',
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
             Clients.resetForm();
             Clients.displaysucess(data.msg);
             Clients.reDrawDataTable();
             $('#client-modal').modal("hide");
              setTimeout(function() {
             $('#reply').html('');
              },2000);
          } else {
            Clients.resetForm();
            Clients.displaywarning(data.msg);
            Clients.reDrawDataTable();
            $('#client-modal').modal("hide");
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
    resetForm:function(){
        $('#form .form-control').val('');
        $('#myModalLabel').html('Add New Clients');
    },
    displaysucess:function(msg)
    {
        swal("Success!", msg, "success")
    },
   displaywarning:function(msg)
    {
        swal("Error!", msg, "error")
    },
  
};