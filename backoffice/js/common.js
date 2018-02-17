var roombook_crud = function() {
		fetchroombookhotels();
    reload_booktable();
	$("#bookdate").datepicker({ startDate: new Date()});
	  var reDrawDataTable = function() {
        $('#datatablebook').dataTable().fnDestroy();
		   
       reload_booktable();
        }
		var register_fun = function() {
		
		 $('#reset').on('click',function(event){
      clearFields();
     });
 $("#hotelbook").on('change', function(event) {
        event.preventDefault(); 
         $id=$("#hotelbook").val();
         if($id!="")
         { 

          var $request = $.ajax({
                              url : 'inc/maintain_bookroom.php',
                              type: "POST",
                              data: {action:"loadroom",id:$id},
                             dataType: "JSON",
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table
                 //console.log(data);
                  if (data.status) {
                    $("#room").html(data.msg);
                     
                  } else {
                       $("#room").html("");
                  }

        });
             
          }
      });
		$("#booknow").on('click', function(event) {
	      event.preventDefault(); 
	     if( $("#hotelbook").val()=="") {
	     	$("#hotelbook").focus();
	     	alert("Please Enter valid hotelname.....!");
	     	return;
	     }
	        if( $("#room").val()=="") {
        $("#room").focus();
        alert("Please Enter valid Room.....!");
        return;
       }
       if( $("#nofrooms").val()=="") {
        $("#nofrooms").focus();
        alert("Please Enter valid Number Of Rooms.....!");
        return;
       }
         
         if( $("#bookdate").val()=="") {
        $("#bookdate").focus();
        alert("Please Enter valid Date.....!");
        return;
       }
       
		
		
	         var $form_data = $('#bookform').serialize();
		  $form_data+="&action=save";
	      //console.log($form_data);
		
		    var $request = $.ajax({
		                          url :'inc/maintain_bookroom.php',
		                          type: "POST",
		                          data: $form_data,								
					 dataType: 'json',
								
								 
		                        });
		        $request.done(function(data) {
		          //if success close modal and reload ajax table

                    if (data.status) {		            
                     reDrawDataTable();
                     clearFields();
                     alert(data.msg);
                  } else {
                     alert(data.msg);
				  }
              });
              $request.always(function(data) {
				  console.log(data);
					  
              // resetmem();
              });
			
	    });
		
$( "#datatablebook" ).on( "click", ".note", function() {
		
          
		
            var $this = $( this );
            var $id = $this.attr('data-id' );
			
            var $formData = { action: "notes", id: $id };

            $.ajax( {
                    url: 'inc/maintain_bookroom.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $formData,
                } )
                .done( function( $resp ) {
                    //console.log( $resp );
                    if( typeof $resp !== 'undefined' ) { 
						
alert($resp[0].notes);


						
                    } else {
                        alert("No notes to display...!");
                    }
                } )
                .always( function( $resp ) {
					// console.log( $resp );
                         // reDrawDataTable();
						  
                } );
		});
$( "#datatablebook" ).on( "click", ".edit", function() {
		
            var $this = $( this );
            var $id = $this.attr( 'data-id' );
			
            var $formData = { action: "edit", id: $id };

            $.ajax( {
                    url: 'inc/maintain_bookroom.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $formData,
                } )
                .done( function( data1 ) {
                    
                    if( data1.status ) { 
			alert(data1.msg);
                            reDrawDataTable();
                    } else {
                        alert("Error to display record... ");
                    }
                } )
                .always( function( $resp ) {
					 console.log( $resp );
                         // reDrawDataTable();
						  
                } );
		});
		/* start of delete button */
		$( "#datatablebook" ).on( "click", ".delete", function() {
		
            var $this = $( this );
            var $id = $this.attr( 'data-id' );
			
            var $formData = { action: "delete", id: $id };

            $.ajax( {
                    url: 'inc/maintain_bookroom.php',
                    type: 'POST',
                     dataType: "JSON",
                    data: $formData,
                } )
                .done( function( data ) {
                    if (data.status) {		            
                    	 reDrawDataTable();
                    	clearFields();
                      alert(data.msg);
                  } else {
                     alert(data.msg);
				  }
                } )
                .always( function( $resp ) {
					// console.log( $resp );
                  

                } );
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

  function fetchroombookhotels()
  {
    
   var $request = $.ajax({
                              url : 'inc/maintain_bookroom.php',
                              type: "POST",
                              data: {action:"load"},
                             dataType: "JSON",
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table
                 //console.log(data);
                  if (data.status) {
                    $("#hotelbook").html(data.msg);
                  } else {
                      alert("Please reload the page...");
                  }
        });
  }
	function reload_booktable()
	{
	  
				 data = {
                "action": "datatable"
                
                
            };
            
			
            Table = $( '#datatablebook' ).DataTable( {
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
                    url: "inc/maintain_bookroom.php",
                    // json datasource
                    type: "POST",
                    // method  , by default get
                    data: data,
                    error: function( res ) {
                        //$( "#error-msg" ).html( res );
                        console.log( res.responseText );
                        //$( "#msg" ).html( res.responseText );
                        $( "#datatablebook tbody" ).html( '<tr><th colspan="10">No data found in the server</th></tr>' );
                        $( "#datatablebook_processing" ).css( "display", "none" );
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