var viewquote_crud = function() {
		reload_table();
	
	  var reDrawDataTable = function() {
        $('#datatable').dataTable().fnDestroy();
		   
       reload_table();
        }
		var register_fun = function() {
		
		 $('#reset').on('click',function(event){
      clearFields();
     });
		$("#submit").on('click', function(event) {
	      event.preventDefault(); 
	   
		
	         var $form_data = $('#form').serialize();
		  $form_data+="&action=send";
	      //console.log($form_data);
		
		    var $request = $.ajax({
		                          url :'inc/maintain_quote.php',
		                          type: "POST",
		                          data: $form_data,								
								  dataType: 'json',
								
								 
		                        });
		        $request.done(function(data) {
		          //if success close modal and reload ajax table

                    if (data.status) {		            
                     reDrawDataTable();
                     clearFields();
                     $('#reply').html('<div class="alert alert-success" role="alert">' + data.msg + '...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
					   setTimeout(function() {
                  $('#reply').html('');

                   //window.location.assign('index.php');
                },1000);
                  } else {
                      $('#reply').html('<div class="alert alert--danger" role="alert">' + data.msg + '... <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
                   setTimeout(function() {
                  $('#reply').html('');
                    
                },1000);
				  }
              });
              $request.always(function(data) {
				  console.log(data);
					  
              // resetmem();
              });
			
	    });
	$( "#datatable" ).on( "click", ".approve", function() {
		
            var $this = $( this );
            var $id = $this.attr( 'data-id' );
			
            var $formData = { action: "approve", id: $id };

            $.ajax( {
                    url: 'inc/maintain_quote.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $formData,
                } )
                .done( function( data1 ) {
                    
                    if( data1.status ) { 
			alert(data1.msg);
                    } else {
                        alert("Error to display record... ");
                    }
                } )
                .always( function( $resp ) {
					// console.log( $resp );
                         // reDrawDataTable();
						  
                } );
		});	
	/* start of delete button */
		$( "#datatable" ).on( "click", ".print", function() {
		
            var $this = $( this );
            var $id = $this.attr( 'data-id' );
			
            var $formData = { action: "print", id: $id };
			window.open("inc/maintain_quote.php?action=print&quoteid="+$id,'_blank');
          
		});
  $( "#datatable" ).on( "click", ".mail", function() {
    
            var $this = $( this );
            var $id = $this.attr( 'data-id' );
      
            var $formData = { action: "mail", quoteid: $id };
    //  window.open("inc/maintain_quote.php?action=mail&quoteid="+$id,'_blank');
    

            $.ajax( {
                    url: 'inc/maintain_quote.php',
                    type: 'POST',
                     dataType: "JSON",
                    data: $formData,
                } )
                .done( function( data ) {
                    if (data.status) {                
                 
             
                      alert(data.msg);
             setTimeout(function() {
                  $('#reply').html('');
                   //window.location.assign('index.php');
                },1000);
                  } else {
                      alert(data.msg);
                   setTimeout(function() {
                  $('#reply').html('');
                    
                },1000);
          }
                } )
                .always( function( $resp ) {
           console.log( $resp );
                  

                } );
          
    });
		/* start of delete button */
		$( "#datatable" ).on( "click", ".delete", function() {
		if(confirm("Are you sure to delete this quotation..?"))
              {
            var $this = $( this );
            var $id = $this.attr( 'data-id' );
			
            var $formData = { action: "delete", id: $id };

            $.ajax( {
                    url: 'inc/maintain_quote.php',
                    type: 'POST',
                     dataType: "JSON",
                    data: $formData,
                } )
                .done( function( data ) {
                    if (data.status) {		            
                    	 reDrawDataTable();
                    	clearFields();
                      $('#reply').html('<div class="alert alert-success" role="alert">' + data.msg + '...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
					   setTimeout(function() {
                  $('#reply').html('');
                   //window.location.assign('index.php');
                },1000);
                  } else {
                      $('#reply').html('<div class="alert alert-danger" role="alert">' + data.msg + '... <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
                   setTimeout(function() {
                  $('#reply').html('');
                    
                },1000);
				  }
                } )
                .always( function( $resp ) {
					// console.log( $resp );
                  

                } );
}
		});
		
	
	}
	return{
		init:function() {
			register_fun();
			
		} 
	}
	function clearFields()
	{
	 $(".form-control").val("");
	
	
	}
	function reload_table()
	{
	  
				 data = {
                "action": "datatable"
                
                
            };
            
			
            Table = $( '#datatable' ).DataTable( {
                "processing": true,
                "language": {
                    "processing": "Hang on. Waiting for response..." //add a loading image,simply putting <img src="loader.gif" /> tag.
                },
                "serverSide": true,
                "deferRender": true,
                "columnDefs": [ {
                    "targets": [ -1 ],
                    "orderable": false,
                    "searchable": false,
                } ],
                "order": [
                    [ 1, 'asc' ]
                ],
                "lengthMenu": [
                    [ 10, 50, 100, 500 ],
                    [ 10, 50, 100, 500 ]
                ],
                "ajax": {
                    url: "inc/maintain_quote.php",
                    // json datasource
                    type: "POST",
                    // method  , by default get
                    data: data,
                    error: function( res ) {
                        //$( "#error-msg" ).html( res );
                        console.log( res.responseText );
                        //$( "#msg" ).html( res.responseText );
                        $( "#datatable tbody" ).html( '<tr><th colspan="10">No data found in the server</th></tr>' );
                        $( "#datatable_processing" ).css( "display", "none" );
                    }
                }
            } );
			
            $( '.datatable_error' ).hide();
			
	}
	 function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}
	
}();