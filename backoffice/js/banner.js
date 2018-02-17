var banner_crud = function() {
		reload_table();
	loadImg();
	 setInterval(function () {changeImg();}, 2000);
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
	    
			/*var $formData = $('#form').serialize();
		  $formData+="&action=save";
	      console.log($formData);*/
		    var inputFile = $('input[type=file]');   
        
      var fileToUpload = inputFile[0].files[0];
      console.log(fileToUpload);
	 // return;
      var $form_data = new FormData();
      
      if (fileToUpload != 'undefined') {
								
      	$('form#bannerform').serializeArray().forEach(function(field){
            $form_data.append(field.name, field.value);
      	});
				$form_data.append('file', fileToUpload);
      } else {
          $('form#bannerform').serializeArray().forEach(function(field){
            $form_data.append(field.name, field.value);
        });
      }
	  $form_data.append("action", "save");

		    var $request = $.ajax({
		                          url :'inc/maintain_banner.php',
		                          type: "POST",
		                          data: $form_data,
								  cache: false,
								  dataType: 'json',
								  processData: false, 
								  contentType: false, 
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
		
	
$( "#datatable" ).on( "click", ".edit", function() {
		
            var $this = $( this );
            var $id = $this.attr( 'data-id' );
			
            var $formData = { action: "edit", id: $id };

            $.ajax( {
                    url: 'inc/maintain_banner.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $formData,
                } )
                .done( function( $resp ) {
                    //console.log( $resp );
                    if( typeof $resp !== 'undefined' ) { 
						
$("#id").val($resp[0].id);

 $("#loadimg").attr("src",$resp[0].filepath);

//$("#loadimg").attr("src",'data:image/jpg;base64,'+$resp[0].photo);
                        
						
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
		$( "#datatable" ).on( "click", ".delete", function() {
		
            var $this = $( this );
            var $id = $this.attr( 'data-id' );
			
            var $formData = { action: "delete", id: $id };

            $.ajax( {
                    url: 'inc/maintain_banner.php',
                    type: 'POST',
                     dataType: "JSON",
                    data: $formData,
                } )
                .done( function( data ) {
                    if (data.status) {		            
                    	 reDrawDataTable();
                    	clearFields();
                      displaysucess(data.msg);
				
                  } else {
                     displaywarning(data.msg);
                  
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
	 $("#loadimg").attr("src","");
	
	}
function loadImg()
   {
   	  $.post('inc/maintain_banner.php',{action:"Image"},function(res){  	  	   
   	  	    $('#loadmyimg').html(res);          
   	  });
   }

   function changeImg()
   {
       var ele = $("input.active").next();
       $("input.active").removeClass("active");
       ele.addClass("active");
       var source=ele.val();
       //alert(source);
       $('#myimg').attr('src',source);
   }
	function reload_table()
	{
	
	 /*var frm = $( '#from' ).val();
            var to = $( '#to' ).val();
            var type = ( $( '#accid' ).val() === '' ) ? "" : $( '#accid' ).val();*/
            data = {
                "action": "datatable"
                
                
            };
              console.log(data);
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
                    url: "inc/maintain_banner.php",
                    dataType: 'json',
                    type: "POST",
                    // method  , by default get
                    data: data,
                    error: function( res ) {
                        //$( "#error-msg" ).html( res );
                        console.log( res.responseText );
                        //$( "#msg" ).html( res.responseText );
                        $( "#datatable").append( '<tbody class="datatable_error"><tr><th colspan="10">No data found in the server</th></tr></tbody>' );
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