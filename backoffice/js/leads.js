var leads_crud = function() {
		reload_table();
    lead_count();
	
	 
		var register_fun = function() {
		
		 $('#reset').on('click',function(event){
      clearFields();
     });
		$("#savelead").on('click', function(event) {
	      event.preventDefault(); 
	     if( $("#cust_name").val()=="") {
	     	$("#cust_name").focus();
	     	alert("Please Enter valid customer name.....!");
	     	return;
	     }
	       if( $("#cust_contact").val()=="") {
        $("#cust_contact").focus();
        alert("Please Enter valid customer contact .....!");
        return;
       }
        if( $("#cust_email").val()=="") {
        $("#cust_email").focus();
        alert("Please Enter valid customer email.....!");
        return;
       }
         if( $("#cust_status").val()=="") {
        $("#cust_status").focus();
        alert("Please Enter valid lead status.....!");
        return;
       }
        if( $("#cust_location").val()=="") {
        $("#cust_location").focus();
        alert("Please Enter valid customer location.....!");
        return;
       }
		 
     if( $("#leadsdate1").val()=="") {
        $("#leadsdate1").focus();
        alert("Please Enter valid leads date.....!");
        return;
       }	
			
		
	         var $form_data = $('#leadform').serialize();
		  $form_data+="&action=save";
	      //console.log($form_data);
		
		    var $request = $.ajax({
		                          url :'inc/maintain_leads.php',
		                          type: "POST",
		                          data: $form_data,								
								  dataType: 'json',
								
								 
		                        });
		        $request.done(function(data) {
		          //if success close modal and reload ajax table

                    if (data.status) {		            
                    $("#"+data.id).remove();
                    switch($("#cust_status").val())
                    {
                      case "Confirm":$("#confirm_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data.id+"'><b>"+data.cust_name+"</b>("+data.user+")<br>Note :"+data.info+"</li>");
                                      break;
                      case "Hot":$("#hot_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data.id+"'><b>"+data.cust_name+"</b>("+data.user+")<br>Note :"+data.info+"</li>");break;
                      case "Warm":$("#warm_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data.id+"'><b>"+data.cust_name+"</b>("+data.user+")<br>Note :"+data.info+"</li>");break;
                      case "Cold":$("#cold_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data.id+"'><b>"+data.cust_name+"</b>("+data.user+")<br>Note :"+data.info+"</li>");break;
                    }
                     
                     clearFields();
                     lead_count();
                     $('#replylead').html('<div class="alert alert-success" role="alert">' + data.msg + '...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
					   setTimeout(function() {
                  $('#replylead').html('');
                  $("#leadmodal").modal('hide');
                   //window.location.assign('index.php');
                },1000);
                  } else {
                      $('#replylead').html('<div class="alert alert--danger" role="alert">' + data.msg + '... <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
                   setTimeout(function() {
                  $('#replylead').html('');
                    
                },1000);
				  }
              });
              $request.always(function(data) {
				  console.log(data);
					  
              // resetmem();
              });
			
	    });
		
	$("#leadsdate").on("blur",function(){
    data = {"action": "datewise","leadsdate":$("#leadsdate").val()};
    $("#confirm_lead").html(''); $("#hot_lead").html(''); $("#warm_lead").html(''); $("#cold_lead").html('');
        var $request = $.ajax({
                              url :'inc/maintain_leads.php',
                              type: "POST",
                              data: data,               
                              dataType: 'json',
                
                 
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table

                    if (data) {                
                    console.log();
                    for(i=0;i<data.length;i++)
                    {
                    switch(data[i].cust_status)
                    {
                      case "Confirm":$("#confirm_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data[i].id+"'><b>"+data[i].cust_name+"</b>("+data[i].user+")<br>Note :"+data[i].cust_details+"</li>");
                                      break;
                      case "Hot":$("#hot_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data[i].id+"'><b>"+data[i].cust_name+"</b>("+data[i].user+")<br>Note :"+data[i].cust_details+"</li>");break;
                      case "Warm":$("#warm_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data[i].id+"'><b>"+data[i].cust_name+"</b>("+data[i].user+")<br>Note :"+data[i].cust_details+"</li>");break;
                      case "Cold":$("#cold_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data[i].id+"'><b>"+data[i].cust_name+"</b>("+data[i].user+")<br>Note :"+data[i].cust_details+"</li>");break;
                    }
                   }

                  } else {
                    $('#replylead').html('<div class="alert alert-success" role="alert">No data Found On Server ...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
             setTimeout(function() {
                  $('#replylead').html('');
                   //window.location.assign('index.php');
                },1000);
                     
                         }
              });
              $request.always(function(data) {
          console.log(data);
            
              // resetmem();
              });
              lead_datewise_count($("#leadsdate").val());
  });
  $( "#export" ).on( "click",function() {
    var leadsdate=$("#leadsdate").val();
    window.open("leads_view.php?action=view&leadsdate="+leadsdate,'_blank');

  });
$( "#leads" ).on( "click", ".custitem", function() {
		
            var $this = $( this );
            var $id = $this.attr( 'id' );
//alert($id);
            var $formData = { action: "edit", id: $id };

            $.ajax( {
                    url: 'inc/maintain_leads.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $formData,
                } )
                .done( function( $resp ) {
                    console.log( $resp );
                    if( typeof $resp !== 'undefined' ) { 
						$("#leadmodal").modal('show');
$("#cust_id").val($resp[0].id);
 $("#cust_name").val($resp[0].cust_name);
 $("#cust_contact").val($resp[0].cust_contact);
  $("#cust_email").val($resp[0].cust_email);
   $("#cust_location").val($resp[0].cust_location);
 $("#cust_status").val($resp[0].cust_status);
  $("#cust_details").val($resp[0].cust_details);
 $("#leadsdate1").val($resp[0].lead_date);
//$("#loadimg").attr("src",'data:image/jpg;base64,'+$resp[0].photo);
                        
						
                    } else {
                        $('#replylead').html('<div class="alert alert-danger" role="alert">Error to display record... <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
                   setTimeout(function() {
                  $('#replylead').html('');
                    
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
                    url: 'inc/maintain_service.php',
                    type: 'POST',
                     dataType: "JSON",
                    data: $formData,
                } )
                .done( function( data ) {
                    if (data.status) {		            
                    	 reDrawDataTable();
                    	clearFields();
                      $('#replylead').html('<div class="alert alert-success" role="alert">' + data.msg + '...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
					   setTimeout(function() {
                  $('#replylead').html('');
                   //window.location.assign('index.php');
                },1000);
                  } else {
                      $('#replylead').html('<div class="alert alert-danger" role="alert">' + data.msg + '... <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
                   setTimeout(function() {
                  $('#replylead').html('');
                    
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
  function findpercentoftotal(lead,tot) {

var c = lead/tot;
var d = c*100;
return d;
}
function lead_datewise_count(date)
  {
     data = {"action": "leaddatecnt","leadsdate":date};
        var $request = $.ajax({
                              url :'inc/maintain_leads.php',
                              type: "POST",
                              data: data,               
                              dataType: 'json',
                
                 
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table

                    if (data) {                
                    console.log();
                    var confirm=data.cntconfirm;
                    var hot=data.cnthot;
                    var warm=data.cntwarm;
                    var cold=data.cntcold;
                    var total=data.total;
                    $("#cntconfirm").html(findpercentoftotal(confirm,total).toFixed(2)+"%");
                   $("#cnthot").html(findpercentoftotal(hot,total).toFixed(2)+"%");
                   $("#cntwarm").html(findpercentoftotal(warm,total).toFixed(2)+"%");
                   $("#cntcold").html(findpercentoftotal(cold,total).toFixed(2)+"%");
                   
                  } else {
                    $('#replylead').html('<div class="alert alert-success" role="alert">No data Found On Server ...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
             setTimeout(function() {
                  $('#replylead').html('');
                   //window.location.assign('index.php');
                },1000);
                     
                         }
              });
              $request.always(function(data) {
          console.log(data);
            
              // resetmem();
              });
  }
  function lead_count()
  {
     data = {"action": "leadcnt"};
        var $request = $.ajax({
                              url :'inc/maintain_leads.php',
                              type: "POST",
                              data: data,               
                              dataType: 'json',
                
                 
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table

                    if (data) {                
                    console.log();
                    var confirm=data.cntconfirm;
                    var hot=data.cnthot;
                    var warm=data.cntwarm;
                    var cold=data.cntcold;
                    var total=data.total;
                    $("#cntconfirm").html(findpercentoftotal(confirm,total).toFixed(2)+"%");
                   $("#cnthot").html(findpercentoftotal(hot,total).toFixed(2)+"%");
                   $("#cntwarm").html(findpercentoftotal(warm,total).toFixed(2)+"%");
                   $("#cntcold").html(findpercentoftotal(cold,total).toFixed(2)+"%");
                   
                  } else {
                    $('#replylead').html('<div class="alert alert-success" role="alert">No data Found On Server ...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
             setTimeout(function() {
                  $('#replylead').html('');
                   //window.location.assign('index.php');
                },1000);
                     
                         }
              });
              $request.always(function(data) {
          console.log(data);
            
              // resetmem();
              });
  }
	function reload_table()
	{
	  data = {"action": "datatable"};
				var $request = $.ajax({
                              url :'inc/maintain_leads.php',
                              type: "POST",
                              data: data,               
                              dataType: 'json',
                
                 
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table

                    if (data) {                
                    console.log();
                    for(i=0;i<data.length;i++)
                    {
                    switch(data[i].cust_status)
                    {
                      case "Confirm":$("#confirm_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data[i].id+"'><b>"+data[i].cust_name+"</b>("+data[i].user+")<br>Note :"+data[i].cust_details+"</li>");
                                      break;
                      case "Hot":$("#hot_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data[i].id+"'><b>"+data[i].cust_name+"</b>("+data[i].user+")<br>Note :"+data[i].cust_details+"</li>");break;
                      case "Warm":$("#warm_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data[i].id+"'><b>"+data[i].cust_name+"</b>("+data[i].user+")<br>Note :"+data[i].cust_details+"</li>");break;
                      case "Cold":$("#cold_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data[i].id+"'><b>"+data[i].cust_name+"</b>("+data[i].user+")<br>Note :"+data[i].cust_details+"</li>");break;
                    }
                   }

                  } else {
                    $('#replylead').html('<div class="alert alert-success" role="alert">No data Found On Server ...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
             setTimeout(function() {
                  $('#replylead').html('');
                   //window.location.assign('index.php');
                },1000);
                     
                         }
              });
              $request.always(function(data) {
          console.log(data);
            
              // resetmem();
              });
			
	}
	 function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}
	
}();