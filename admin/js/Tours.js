var Tours ={
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
          $('.btn-add-tour').on('click',function(){
              $('#tour-modal').modal("show");
              self.resetForm();
              $('#myModalLabel').html('Add New Tour');
          });
         $("#form").on('submit',this.onSubmitToursForm);
         $('#updatemem').on('click', this.onUpdate);
         $( "#datatable" ).on( "click", ".edit", this.onEditTours);
         $( "#datatable" ).on( "click", ".delete", this.onDeleteTours); 
         $('#reset').on('click',this.resetForm);
         
   },  
   onDeleteTours:function(){
        var self=this;
        var $this = $( this );
        var $id = $this.attr( 'data-id' );
        var cate="";
        var $formData = { action: "getcat", id: $id };

        $.ajax( {
                url: 'includes/Tours.php',
                type: 'POST',
                 dataType: "JSON",
                data: $formData,
            } )
            .done( function( data ) {
                if (data.status) {                
                  cate=data.msg;
                  swal({
                    title: 'Are you sure ?',
                    text: "Delete Tours "+cate,
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
                          url: 'includes/Tours.php',
                          type: 'POST',
                           dataType: "JSON",
                          data: $formData,
                      })
                      .done( function( data ) {
                          if (data.status) {                
                              Tours.reDrawDataTable();
                              Tours.resetForm();
                             Tours.displaysucess(data.msg);

                          } else {
                            Tours.reDrawDataTable();
                             Tours.displaywarning(data.msg);
                        
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
                     Tours.displaywarning(data.msg);
                  }
            });
        },

    onEditTours:function(){
      $('#myModalLabel').html('Edit Tours');
      $('#tour-modal').modal("show");
      var $this = $( this );
      var $id = $this.attr( 'data-id' );
      var $formData = { action: "edit", id: $id ,from:'edtiform'};
        $.ajax({
              url: 'includes/Tours.php',
              type: 'POST',
              dataType: 'json',
              data: $formData,
          })
          .done( function( $resp ) {
              if( typeof $resp !== 'undefined' ) {
                  var resp=$resp;
                  for (var i  in resp) {
                       $('#form [name='+i+']').val(resp[i]);
                    }
                  
              }
          })
       .always( function( $resp ){});
    } ,

   onUpdate:function(){
        event.preventDefault();
       
       var $form_data = $('#form').serialize();
      $form_data+="&action=update";
         
       
        var $request = $.ajax({
              url :'includes/Tours.php',
              type: "POST",
              data: $form_data,
              dataType: "JSON",
              //cache: false,              
             // processData: false, // Don't process the files
              //contentType: false,
            });
            $request.done(function(data) {
              //if success close modal and reload ajax table
               if (data.status) { 
                   Tours.resetForm();
                   Tours.displaysucess(data.status);
                    setTimeout(function() {
                   $('#reply').html('');
                    },2000);
                } else {
                  Tours.resetForm();
                  Tours.displaywarning(data.status);
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
              url: "includes/Tours.php",
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

   onSubmitToursForm:function(){
      var self=this;
      event.preventDefault();
    
      
      /*$('form#form').serializeArray().forEach(function(field){
              $form_data.append(field.name, field.value);
      });*/
     var $form_data = $('#form').serialize();
      $form_data+="&action=save";
       // ajax adding data to database
       var $request = $.ajax({
            url :'includes/Tours.php',
            type: "POST",
            data: $form_data,
            //cache: false,
            dataType: 'json',
            //processData: false, // Don't process the files
            //contentType: false, // Set content type to false as jQuery will tell the server its a query string request  
       });
       $request.done(function(data) {
        //if success close modal and reload ajax table
          if (data.status) { 
             Tours.resetForm();
             Tours.displaysucess(data.msg);
             Tours.reDrawDataTable();
             $('#tour-modal').modal("hide");
              setTimeout(function() {
             $('#reply').html('');
              },2000);
          } else {
            Tours.resetForm();
            Tours.displaywarning(data.msg);
            Tours.reDrawDataTable();
            $('#tour-modal').modal("hide");
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
        $('#myModalLabel').html('Add New Tour');
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