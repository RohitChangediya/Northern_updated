$(function () {
	
	jQuery.support.placeholder = false;
	test = document.createElement('input');
	if('placeholder' in test) jQuery.support.placeholder = true;
	
	if (!$.support.placeholder) {
		
		$('.field').find ('label').show ();
		
	}
	$("#form").on('submit', function(event) {
	      event.preventDefault(); 
	      
	      
	        if($("#username").val()=="")
	      {
	      	$("#username").focus();
	     	displaywarning("Please Ener Valid username.....!");
	     	return;
	      }
	     if($("#password").val()=="")
	      {
	      	$("#password").focus();
	     	displaywarning("Please Ener Valid password.....!");
	     	return;
	      }
	      
	    
			var $formData = $('#form').serialize();
		  $formData+="&action=login";
	      console.log($formData);

		    var $request = $.ajax({
		                          url :'inc/maintain_login.php',
		                          type: "POST",
		                          data: $formData,
								  dataType: 'json',
								//processData: false, // Don't process the files
								//contentType: false, // Set content type to false as jQuery will tell the server its a query string request
		                        });
		        $request.done(function(data) {
		          //if success close modal and reload ajax table

                  if (data.status) {		             //console.log(data);
                     alert(data.msg);
					
					   setTimeout(function() {
                 
                   window.location.assign('dashboard.php');
                },100);
                  } else {
                        alert(data.msg);
                  
				  }
              });
              $request.always(function(data) {
				  console.log(data);
					  
              // resetmem();
              });
			
	    });
});