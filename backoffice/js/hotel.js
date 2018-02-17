var hotel_crud = function() {
		reload_table();
	fetchhaltdestinations();
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
	     if( $("#hotelname").val()=="") {
	     	$("#hotelname").focus();
	     	alert("Please Enter valid hotelname.....!");
	     	return;
 	     }
           if( $("#halt_id").val()=="") {
	     	$("#halt_id").focus();
	     	alert("Please Select valid Halting Destination.....!");
	     	return;
	     }
	        if( $("#hoteltype").val()=="") {
        $("#hoteltype").focus();
        alert("Please Enter valid hoteltype.....!");
        return;
       }
         if( $("#contact").val()=="") {
        $("#contact").focus();
        alert("Please Enter valid contact number.....!");
        return;
       }
         if( $("#email").val()=="") {
        $("#email").focus();
        alert("Please Enter valid email.....!");
        return;
       }
 if( $("#username").val()=="") {
        $("#username").focus();
        alert("Please Enter valid username.....!");
        return;
       }
 if( $("#password").val()=="") {
        $("#password").focus();
        alert("Please Enter valid password.....!");
        return;
       }
        if( !$(".status:checked").prop('checked')) {
        $(".status").focus();
        alert("Please Enter valid status .....!");
        return;
       }
		 if( $("#hotelname").val()=="")
	       {
		     alert("Please Enter All Required fields...!");
		   }		
			else
			{
		
	         var $form_data = $('#form').serialize();
		  $form_data+="&action=save";
	      //console.log($form_data);
		
		    var $request = $.ajax({
		                          url :'inc/maintain_hotel.php',
		                          type: "POST",
		                          data: $form_data,								
					dataType: 'json'
								
								 
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
			}
	    });
		
	
$( "#datatable" ).on( "click", ".edit", function() {
		
            var $this = $( this );
            var $id = $this.attr( 'data-id' );
			
            var $formData = { action: "edit", id: $id };

            $.ajax( {
                    url: 'inc/maintain_hotel.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $formData,
                } )
                .done( function( $resp ) {
                    //console.log( $resp );
                    if( typeof $resp !== 'undefined' ) { 
						
$("#hotel_id").val($resp[0].hotel_id);
 $("#halt_id").val($resp[0].halt_id);
 $("#hotelname").val($resp[0].hotelname);
$("#address").val($resp[0].address);
 $("#hoteltype").val($resp[0].hoteltype);
$("#contact").val($resp[0].contact);
 $("#email").val($resp[0].email);
$("#username").val($resp[0].username);
$("#password").val($resp[0].password);

$("input.status[value="+$resp[0].status+"] ").attr('checked',true);

//$("#loadimg").attr("src",'data:image/jpg;base64,'+$resp[0].photo);
                        
						
                    } else {
                        $('#reply').html('<div class="alert alert-danger" role="alert">Error to display record... <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
                   setTimeout(function() {
                  $('#reply').html('');
                    
                },1000);
                    }
                } )
                .always( function( $resp ) {
					// console.log( $resp );
                         // reDrawDataTable();
						  
                } );
		});
		/* start of delete button */
		$( "#datatable" ).on( "click", ".delete", function() {
		
            var $this = $( this );
            var $id = $this.attr( 'data-id' );
			
            var $formData = { action: "delete", id: $id };

            $.ajax( {
                    url: 'inc/maintain_hotel.php',
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
        function fetchhaltdestinations()
  {
    
   var $request = $.ajax({
                              url : 'inc/maintain_hotel.php',
                              type: "POST",
                              data: {action:"loadhalt"},
                             dataType: "JSON",
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table
                 //console.log(data);
                  if (data.status) {
                    $("#halt_id").html(data.msg);
                     /* $("#arrivedest").html(data.msg);
                        $("#departuredest").html(data.msg);*/
                  } else {
                      //alert("Please reload the page...");
                  }
        });
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
                    url: "inc/maintain_hotel.php",
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