var TourItinerary ={
    init:function() {
       this.bind_events();
       this.reload_table();
       this.loadTours(); 
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
              $('#myModalLabel').html('Add New Tour Itinerary');
          });
         $("#form").on('submit',this.onSubmitTourItineraryForm);
         $('#updatemem').on('click', this.onUpdate);
         $( "#datatable" ).on( "click", ".edit", this.onEditTourItinerary);
         $( "#datatable" ).on( "click", ".delete", this.onDeleteTourItinerary); 
         $('#reset').on('click',this.resetForm);
         
   },  
   onDeleteTourItinerary:function(){
        var self=this;
        var $this = $( this );
        var $id = $this.attr( 'data-id' );
        var cate="";
        var $formData = { action: "getcat", id: $id };

        $.ajax( {
                url: 'includes/TourItinerary.php',
                type: 'POST',
                 dataType: "JSON",
                data: $formData,
            } )
            .done( function( data ) {
                if (data.status) {                
                  cate=data.msg;
                  swal({
                    title: 'Are you sure ?',
                    text: "Delete Tour Itinerary "+cate,
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
                          url: 'includes/TourItinerary.php',
                          type: 'POST',
                           dataType: "JSON",
                          data: $formData,
                      })
                      .done( function( data ) {
                          if (data.status) {                
                              TourItinerary.reDrawDataTable();
                              TourItinerary.resetForm();
                             TourItinerary.displaysucess(data.msg);

                          } else {
                            TourItinerary.reDrawDataTable();
                             TourItinerary.displaywarning(data.msg);
                        
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
                     TourItinerary.displaywarning(data.msg);
                  }
            });
        },

    onEditTourItinerary:function(){
      $('#myModalLabel').html('Edit Tour Itinerary');
      $('#client-modal').modal("show");
       $('.tour-img-class').show();
      $('#image').removeAttr('required');
      var $this = $( this );
      var $id = $this.attr( 'data-id' );
      var $formData = { action: "edit", id: $id ,from:'edtiform'};
        $.ajax({
              url: 'includes/TourItinerary.php',
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
                  $('.tour-img-class').find('img').attr('src',resp['img_path']);
                  
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
              url :'includes/TourItinerary.php',
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
                   TourItinerary.resetForm();
                   TourItinerary.displaysucess(data.status);
                    setTimeout(function() {
                   $('#reply').html('');
                    },2000);
                } else {
                  TourItinerary.resetForm();
                  TourItinerary.displaywarning(data.status);
                  setTimeout(function() {
                   $('#reply').html('');
                    },2000);
                }
            });
    },
    loadTours:function(){
    var $formData = { action: "listtours"};
        $.ajax({
                url: 'includes/TourItinerary.php',
                type: 'POST',
                dataType: 'json',
                data: $formData,
          })
          .done( function( data ) {
              if (data.status) {                
                    var options = '<option value="">Select Tour</option>';
                    for(i in data.result){
                        options+="<option value='"+data.result[i].id+"'>"+data.result[i].title+"</option>";
                    }
                    $('#tour_id').html(options);
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
              url: "includes/TourItinerary.php",
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

   onSubmitTourItineraryForm:function(){
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
            url :'includes/TourItinerary.php',
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
             TourItinerary.resetForm();
             TourItinerary.displaysucess(data.msg);
             TourItinerary.reDrawDataTable();
             $('#client-modal').modal("hide");
              setTimeout(function() {
             $('#reply').html('');
              },2000);
          } else {
            TourItinerary.resetForm();
            TourItinerary.displaywarning(data.msg);
            TourItinerary.reDrawDataTable();
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
        $('#myModalLabel').html('Add New Tour Itinerary');
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