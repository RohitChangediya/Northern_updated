var hotelroom_crud = function() {
		fetchhotels();
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
	     if( $("#hotelname").val()=="") {
	     	$("#hotelname").focus();
	     	alert("Please Enter valid hotelname.....!");
	     	return;
	     }
	        if( $("#roomtype").val()=="") {
        $("#roomtype").focus();
        alert("Please Enter valid roomtype.....!");
        return;
       }
       if( $("#noofrooms").val()=="") {
        $("#noofrooms").focus();
        alert("Please Enter valid Number Of Rooms.....!");
        return;
       }
         if( !$(".actype:checked").prop('checked')) {
        $(".actype").focus();
        alert("Please Enter valid actype .....!");
        return;
       }
         if( $("#charge_ep").val()=="") {
        $("#charge_ep").focus();
        alert("Please Enter valid charge EP.....!");
        return;
       }
        if( $("#charge_cp").val()=="") {
        $("#charge_cp").focus();
        alert("Please Enter valid charge CP.....!");
        return;
       }
       if( $("#charge_map").val()=="") {
        $("#charge_map").focus();
        alert("Please Enter valid charge MAP.....!");
        return;
       }
        if( $("#charge_ap").val()=="") {
        $("#charge_ap").focus();
        alert("Please Enter valid  charge AP.....!");
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
		                          url :'inc/maintain_hotelroom.php',
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
			}
	    });
		
	
$( "#datatable" ).on( "click", ".edit", function() {
		
            var $this = $( this );
            var $id = $this.attr( 'data-id' );
			
            var $formData = { action: "edit", id: $id };

            $.ajax( {
                    url: 'inc/maintain_hotelroom.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $formData,
                } )
                .done( function( $resp ) {
                    //console.log( $resp );
                    if( typeof $resp !== 'undefined' ) { 
						
$("#hotelroom_id").val($resp[0].hotelroom_id);
 $("#hotelname").val($resp[0].hotel_id);
$("#roomtype").val($resp[0].roomtype);
$("#noofrooms").val($resp[0].noofrooms);
 $("#charge_ep").val($resp[0].charge_ep);
$("#charge_cp").val($resp[0].charge_cp);
 $("#charge_map").val($resp[0].charge_map);
 $("#charge_ap").val($resp[0].charge_ap);

 $("#extrabed_ep").val($resp[0].extrabed_ep);
$("#extrabed_cp").val($resp[0].extrabed_cp);
 $("#extrabed_map").val($resp[0].extrabed_map);
 $("#extrabed_ap").val($resp[0].extrabed_ap);

 $("#extraperson_ep").val($resp[0].extraperson_ep);
$("#extraperson_cp").val($resp[0].extraperson_cp);
 $("#extraperson_map").val($resp[0].extraperson_map);
 $("#extraperson_ap").val($resp[0].extraperson_ap);

 $("#extrachild_ep").val($resp[0].extrachild_ep);
$("#extrachild_cp").val($resp[0].extrachild_cp);
 $("#extrachild_map").val($resp[0].extrachild_map);
 $("#extrachild_ap").val($resp[0].extrachild_ap);

 $("#off_charge_ep").val($resp[0].off_charge_ep);
$("#off_charge_cp").val($resp[0].off_charge_cp);
 $("#off_charge_map").val($resp[0].off_charge_map);
 $("#off_charge_ap").val($resp[0].off_charge_ap);

 $("#off_extrabed_ep").val($resp[0].off_extrabed_ep);
$("#off_extrabed_cp").val($resp[0].off_extrabed_cp);
 $("#off_extrabed_map").val($resp[0].off_extrabed_map);
 $("#off_extrabed_ap").val($resp[0].off_extrabed_ap);

 $("#off_extraperson_ep").val($resp[0].off_extraperson_ep);
$("#off_extraperson_cp").val($resp[0].off_extraperson_cp);
 $("#off_extraperson_map").val($resp[0].off_extraperson_map);
 $("#off_extraperson_ap").val($resp[0].off_extraperson_ap);

 $("#off_extrachild_ep").val($resp[0].off_extrachild_ep);
$("#off_extrachild_cp").val($resp[0].off_extrachild_cp);
 $("#off_extrachild_map").val($resp[0].off_extrachild_map);
 $("#off_extrachild_ap").val($resp[0].off_extrachild_ap);


$("input.actype[value="+$resp[0].actype+"] ").attr('checked',true);

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
                    url: 'inc/maintain_hotelroom.php',
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
  function fetchhotels()
  {
    
   var $request = $.ajax({
                              url : 'inc/maintain_hotelroom.php',
                              type: "POST",
                              data: {action:"load"},
                             dataType: "JSON",
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table
                 //console.log(data);
                  if (data.status) {
                    $("#hotelname").html(data.msg);
                  } else {
                      alert("Please reload the page...");
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
                    url: "inc/maintain_hotelroom.php",
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