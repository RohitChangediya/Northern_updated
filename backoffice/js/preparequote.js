var preparequote_crud = function() {
	
    fetchdestinations();
    fetchtransportations();
   fetchhaltdestinations();
    fetchservice();
  fetchAgentMarkup();

	$("#arrivedate").datepicker({ startDate: new Date()});
  $("#departuredate").datepicker( {startDate: new Date()});
	  var reDrawDataTable = function() {
        $('#datatable').dataTable().fnDestroy();
		   
       reload_table();
        }
		var register_fun = function() {
		
		 $('#reset').on('click',function(event){
      clearFields();
     });
	
/*$("#arrivedate").on('select',function(event){ alert('abcd');
 calculateDuration();
});

$("#departuredate").on('select',function(event){ alert('abcd');
 calculateDuration();
});*/
$("#hoteltype").change(function(event) {
   $id=$("#hoteltype").val();
   $halt_id=$("#halt_id").val();
         if($id!="" && $halt_id!='')
         {
  fetchhotels($id,$halt_id);
}

});
$("#tourdest").on('change', function(event) {
        event.preventDefault(); 
         $id=$("#tourdest").val();
          $("#transarrivedest").html('');
          $("#transdeparturedest").html('');
         if($id!="")
         {

          var $request = $.ajax({
                              url : 'inc/maintain_quote.php',
                              type: "POST",
                              data: {action:"loadtransdest",id:$id},
                             dataType: "JSON",
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table
                 //console.log(data);
                  if (data.status) {
                    $("#transarrivedest").html(data.msg1);
                     $("#transdeparturedest").html(data.msg2);
                  } else {
                      //alert("Please reload the page...");
                  }

        });
            
          }
      });
 $("#hotelname").on('change', function(event) {
        event.preventDefault(); 
         $id=$("#hotelname").val();
         if($id!="")
         {

          var $request = $.ajax({
                              url : 'inc/maintain_quote.php',
                              type: "POST",
                              data: {action:"loadroom",id:$id},
                             dataType: "JSON",
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table
                 //console.log(data);
                  if (data.status) {
                    $("#roomtype").html(data.msg);
                     
                  } else {
                       $("#roomtype").html("");
                  }

        });
              //fetchmealtype($id);
          }
      });
 $( "#trans_id" ).on( "change", function() {
   
            
            var $id = $("#trans_id option[value="+$("#trans_id").val()+"]").html();
      
            var $formData = { action: "transpickupdrop", id: $id };

            $.ajax( {
                    url: 'inc/maintain_quote.php',
                    type: 'POST',
                     dataType: "JSON",
                    data: $formData,
                } )
                .done( function( data ) {
                                   
                      $("#pickup").html(data.msg1);
                       $("#drop").html(data.msg2);        
                 
                } )
                .always( function( $resp ) {
           console.log( $resp );
                  

                } );
          }); 
           $( "#pickup" ).on( "change", function() {
   
             var $id = $("#trans_id option[value="+$("#trans_id").val()+"]").html();
            var pick = $("#pickup").val();
            
            var $formData = { action: "transpickup", id: $id,pick:pick };

            $.ajax( {
                    url: 'inc/maintain_quote.php',
                    type: 'POST',
                     dataType: "JSON",
                    data: $formData,
                } )
                .done( function( data ) {
                                   
                      
                       $("#drop").html(data.msg);        
                 
                } )
                .always( function( $resp ) {
           console.log( $resp );
                  

                } );
              changeDescription();
          });    
       $( "#drop" ).on( "change", function() {   
         
              changeDescription();
          });           
  
  	$("#submit1").on('click', function(event) {
	      event.preventDefault(); 
	     if( $("#clientname").val()=="") {
	     	$("#clientname").focus();
	     	alert("Please Enter valid clientname.....!");
	     	return;
	     }
	        if( $("#mobile").val()=="") {
        $("#mobile").focus();
        alert("Please Enter valid mobile.....!");
        return;
       }
    if($("#email").val()=="") {
        $("#email").focus();
        alert("Please Enter valid email .....!");
        return;
       }
         if( $("#tourdest").val()=="") {
        $("#tourdest").focus();
        alert("Please Enter valid tour destination.....!");
        return;
       }
        if( $("#arrivedate").val()=="") {
        $("#arrivedate").focus();
        alert("Please Enter valid arrive date .....!");
        return;
       }
        if( $("#departuredate").val()=="") {
        $("#departuredate").focus();
        alert("Please Enter valid departure date .....!");
        return;
       }
    
       if( $("#tourduration").val()=="") {
        $("#tourduration").focus();
        alert("Please Enter valid tour duration .....!");
        return;
       }
       
		 if( $("#clientname").val()=="")
	       {
		     alert("Please Enter All Required fields...!");
		   }		
			else
			{
		
	         var $form_data = $('#form1').serialize();
		  $form_data+="&action=save1";
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
                     //reDrawDataTable();
                     clearFields();
                     $('#reply1').html('<div class="alert alert-success" role="alert">' + data.msg + '...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
					   setTimeout(function() {
                  $('#reply1').html('');
                $("#basic").toggleClass("active");
                $("#accomo").toggleClass("active");
                 $("#li1").toggleClass("active");
                $("#li2").toggleClass("active");
                   //window.location.assign('index.php');
                },1000);
                  } else {
                      $('#reply1').html('<div class="alert alert--danger" role="alert">' + data.msg + '... <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
                   setTimeout(function() {
                  $('#reply1').html('');
                    
                },1000);
				  }
              });
              $request.always(function(data) {
				  console.log(data);
					  
              // resetmem();
              });
			}
	    });
		
	$("#submit2").on('click', function(event) {
        event.preventDefault(); 
       if( $("#noofroom").val()=="") {
        $("#noofroom").focus();
        alert("Please Enter valid no of room.....!");
        return;
       }
          if( $("#extrabeds").val()=="") {
        $("#extrabeds").focus();
        alert("Please Enter valid Number Of Extra Beds.....!");
        return;
       }
    if($("#childs").val()=="") {
        $("#childs").focus();
        alert("Please Enter valid Number Of Childs without Beds .....!");
        return;
       }
         if( $("#childs5yrs").val()=="") {
        $("#childs5yrs").focus();
        alert("Please Enter valid Number Of Childs Below 5 Years.....!");
        return;
       }

       
       
        if(!$(".actype:checked").prop('checked')) {
        $(".actype").focus();
        alert("Please Enter valid arrive destination .....!");
        return;
       }
        
       
     if( $("#noofroom").val()=="")
         {
         alert("Please Enter All Required fields...!");
       }    
      else
      {
    
           var $form_data = $('#form2').serialize();
      $form_data+="&action=save2";
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
                     //reDrawDataTable();
                     clearFields();
                     $('#reply2').html('<div class="alert alert-success" role="alert">' + data.msg + '...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
             setTimeout(function() {
                  $('#reply2').html('');
                $("#accomo").toggleClass("active");
                $("#hotel").toggleClass("active");
                 $("#li2").toggleClass("active");
                $("#li3").toggleClass("active");
                   //window.location.assign('index.php');
                },1000);
                  } else {
                      $('#reply2').html('<div class="alert alert--danger" role="alert">' + data.msg + '... <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
                   setTimeout(function() {
                  $('#reply2').html('');
                    
                },1000);
          }
              });
              $request.always(function(data) {
          console.log(data);
            
              // resetmem();
              });
      }
      });
  
  
  $("#addhotel").on('click', function(event) {
        event.preventDefault(); 

         if( $("#halt_id").val()=="") {
        $("#halt_id").focus();
        alert("Please Select valid Halt Destination.....!");
        return;
       }
        if( $("#hotelname").val()=="") {
        $("#hotelname").focus();
        alert("Please Select valid hotelname.....!");
        return;
       }
       if( $("#noofnights").val()=="") {
        $("#noofnights").focus();
        alert("Please Enter valid no of nights.....!");
        return;
       }
         if($("#fromdate").val()=="") {
        $("#fromdate").focus();
        alert("Please Enter valid From Date .....!");
        return;
       }
if($("#todate").val()=="") {
        $("#todate").focus();
        alert("Please Enter valid To Date .....!");
        return;
       } 
    if($("#roomtype").val()=="") {
        $("#roomtype").focus();
        alert("Please Enter valid room type .....!");
        return;
       }
         if( $("#mealtype").val()=="") {
        $("#mealtype").focus();
        alert("Please Enter valid mealtype.....!");
        return;
       }

       var halt_id=$("#halt_id").val();
       var halt_name = $('#halt_id option[value="'+halt_id+'"]').html();
       var hotel_id=$("#hotelname").val();
       var hotel_name = $('#hotelname option[value="'+hotel_id+'"]').html();
       var noofnights=$("#noofnights").val();
 var fromdate=$("#fromdate").val();
 var todate=$("#todate").val();
       var room_id=$("#roomtype").val();
       var  roomtype = $('#roomtype option[value="'+room_id+'"]').html();
       var meal_id=$("#mealtype").val();
       var  mealtype = $('#mealtype option[value="'+meal_id+'"]').html();

        var i;
        var row = 0;

        $('#addhotelbody tr').each(function() {
          row = row + 1;
        });
                
        if (row == 0) {
          i = 0;
        }else{
          i = row;
        };
      var  tr = '<tr id="row_'+ (i+1) +'"  title="'+ (i+1) +'">';
           tr += '<td id="sr_'+ (i+1) +'" data-sr="'+ (i+1) +'">'+ (i+1) +'</td>';
           tr += '<td id="haltname_'+ (i+1) +'" data-halt_id="'+ halt_id +'">'+ halt_name +'</td>';
           tr += '<td id="hotelname_'+ (i+1) +'" data-hotel_id="'+ hotel_id +'">'+ hotel_name +'</td>';
           tr += '<td id="noofnights_'+ (i+1) +'" data-noofnights="'+ noofnights +'">'+ noofnights +'</td>';
tr += '<td id="fromdate_'+ (i+1) +'" data-fromdate="'+ fromdate+'">'+ fromdate+'</td>';
tr += '<td id="todate_'+ (i+1) +'" data-todate="'+ todate+'">'+ todate+'</td>';
           tr += '<td id="roomtype_'+ (i+1) +'" data-room_id="'+ room_id +'">'+ roomtype +'</td>';
           tr += '<td id="mealtype_'+ (i+1) +'" data-meal_id="'+ meal_id +'">'+ mealtype +'</td>';
            tr += '<td>';
            tr += '<a type="button" class="btn btn-danger btn-sm" id="remove_list" data-srno="'+ (i+1) +'"><i class="icon-trash"></i></a>';
              tr+=  '</td>';
               tr += '</tr>';
          $('#addhotelbody').append(tr);
          $("#hotelname").val("");
          $("#noofnights").val("");
 $("#fromdate").val("");
 $("#todate").val("");
          $("#roomtype").val("");
          $("#mealtype").val("");
          $("#halt_id").val("");

     });

  $('#addhotelbody').on('click', '#remove_list', function(event) {
      event.preventDefault();
      /* Act on the event */
      var $this = $(this);
      var id = $this.data('srno')
      var tr = $this.parent().parent();
     // console.log(tr);
      
      //var parent = tr.find('#row_'+id).remove();
      var parent = $('#row_'+id).remove();
       
    });
$("#submit3").on('click', function(event) {
        event.preventDefault(); 
  var hotel_id =new Array();var noofnights =new Array();var fromdate =new Array();var todate=new Array();var room_id =new Array();var halt_id = new Array();
   var meal_id =new Array();
   var ind=0;var $form_data;
   $('#addhotelbody tr').each(function(){
                    
                    id = $(this).attr('id');
                    var str = id;
                    var parsing_id = str.replace("row_", "");
                   var haltname = $("#haltname_" + parsing_id).data('halt_id');
                  var hotelname = $("#hotelname_" + parsing_id).data('hotel_id');
                    var nights = $("#noofnights_" + parsing_id).data('noofnights');
                    var fromday= $("#fromdate_" + parsing_id).data('fromdate');
                    var today= $("#todate_" + parsing_id).data('todate');

                      var roomtype = $("#roomtype_" + parsing_id).data('room_id');
                        var mealtype = $("#mealtype_" + parsing_id).data('meal_id');
                   halt_id[ind]=haltname;
                   hotel_id[ind]=hotelname;
           noofnights[ind]=nights;
fromdate[ind]=fromday;
todate[ind]=today;
           room_id[ind]=roomtype;
           meal_id[ind]=mealtype;   
             ind++; 

                  });
   $form_data = 'action=save3&hotel_id=' +hotel_id+ '&noofnights=' +noofnights+ '&fromdate=' +fromdate+ '&todate=' +todate+ '&room_id=' +room_id+ '&meal_id=' +meal_id+ '&halt_id=' +halt_id;
                 
          var $request = $.ajax({
                              url :'inc/maintain_quote.php',
                              type: "POST",
                              data: $form_data,               
                  dataType: 'json',
                
                 
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table

                    if (data.status) {                
                     //reDrawDataTable();
                     clearFields();
                     $('#reply3').html('<div class="alert alert-success" role="alert">' + data.msg + '...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
             setTimeout(function() {
                  $('#reply3').html('');
                $("#hotel").toggleClass("active");
                $("#days").toggleClass("active");
                 $("#li3").toggleClass("active");
                $("#li4").toggleClass("active");
                   //window.location.assign('index.php');
                },3000);
                  } else {
                      $('#reply3').html('<div class="alert alert--danger" role="alert">' + data.msg + '... <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
                   setTimeout(function() {
                  $('#reply3').html('');
                    
                },1000);
          }
              });
              $request.always(function(data) {
          console.log(data);
            
              // resetmem();
              });

       });                     

//------------------------------ operations on  itenary------------------------



$("#adddays").on('click', function(event) {
        event.preventDefault(); 
        if( $("#day").val()=="") {
        $("#day").focus();
        alert("Please Enter valid day.....!");
        return;
       }
       if( $("#description").val()=="") {
        $("#description").focus();
        alert("Please Enter valid description.....!");
        return;
       }
       var day=$("#day").val();    
       var description=$("#description").val();     
       var trans_id=$("#trans_id").val();  
       var trans=$("#trans_id>option[value="+trans_id+"]").html();  
       var pickup=$("#pickup").val();        
       var drop=$("#drop").val(); 
       var noofcabs=$("#noofcabs").val(); 
var iChars = "^&=[]\\;|\:,<>";

for (var i = 0; i <description.length; i++) {
    if (iChars.indexOf(description.charAt(i)) != -1) {
        alert ("Your username has special characters. \n ^&=[]\\\;/|\:,<> are not allowed.\n Please remove them and try again.");
$("#description").focus();
        return false;
    }
}
        var i;
        var row = 0;

        $('#adddaysbody tr').each(function() {
          row = row + 1;
        });
                
        if (row == 0) {
          i = 0;
        }else{
          i = row;
        };
      var  tr = '<tr id="row_'+ (i+1) +'"  title="'+ (i+1) +'">';
           tr += '<td id="sr_'+ (i+1) +'" data-sr="'+ (i+1) +'">'+ (i+1) +'</td>';
           tr += '<td id="day_'+ (i+1) +'" data-day="'+ day +'">'+ day +'</td>';
           tr += '<td id="description_'+ (i+1) +'" data-description="'+ description +'">'+ description +'</td>';   
            tr += '<td id="trans_'+ (i+1) +'" data-tran="'+ trans_id +'">'+ trans +'</td>'; 
             tr += '<td id="pickup_'+ (i+1) +'" data-pickup="'+ pickup +'">'+ pickup +'</td>';
             tr += '<td id="drop_'+ (i+1) +'" data-drop="'+ drop +'">'+ drop +'</td>'; 
           tr += '<td id="noofcabs_'+ (i+1) +'" data-noofcabs="'+ noofcabs+'">'+ noofcabs +'</td>';         
            tr += '<td>';
            tr += '<a type="button" class="btn btn-danger btn-sm" id="remove_list" data-srno="'+ (i+1) +'"><i class="icon-trash"></i></a>';
            tr+=  '</td>';
            tr += '</tr>';
          $('#adddaysbody').append(tr);
          $("#day").val("");    
       $("#description").val(""); 
        $("#trans_id").val("");    
       $("#pickup").val(""); 
        $("#drop").val("");    
       
     });

  $('#adddaysbody').on('click', '#remove_list', function(event) {
      event.preventDefault();
      /* Act on the event */
      var $this = $(this);
      var id = $this.data('srno')
      var tr = $this.parent().parent();
     // console.log(tr);
      
      //var parent = tr.find('#row_'+id).remove();
      var parent = $('#row_'+id).remove();
       
    });
$("#submit4").on('click', function(event) {
        event.preventDefault(); 
  var day =new Array();var description =new Array();var pickup_loc =new Array();var trans_id =new Array();var drop_loc =new Array();
var noofcabs=new Array(); var ind=0;var $form_data;
   $('#adddaysbody tr').each(function(){
                    
                    id = $(this).attr('id');
                    var str = id;
                    var parsing_id = str.replace("row_", "");

                  var days = $("#day_" + parsing_id).data('day');
                    var descriptions = $("#description_" + parsing_id).html();
                     var trans_ids = $("#trans_" + parsing_id).html();
                      var pickup_locs = $("#pickup_" + parsing_id).html();
                       var drop_locs = $("#drop_" + parsing_id).html();
                       var no_cabs = $("#noofcabs_" + parsing_id).html();
                   day[ind]=days;
           description[ind]=descriptions;
           trans_id[ind]=trans_ids;
           pickup_loc[ind]=pickup_locs;
           drop_loc[ind]=drop_locs;
           noofcabs[ind]=no_cabs ;
             ind++; 

                  });
   $form_data = 'action=save4&day=' +day+'&description=' +description+'&trans_id=' +trans_id+'&pickup_loc=' +pickup_loc+'&drop_loc=' +drop_loc+'&noofcabs=' +noofcabs;
                 console.log($form_data);
          var $request = $.ajax({
                              url :'inc/maintain_quote.php',
                              type: "POST",
                              data: $form_data,               
                  dataType: 'json',
                
                 
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table

                    if (data.status) {                
                     //reDrawDataTable();
                     clearFields();
                     $('#reply4').html('<div class="alert alert-success" role="alert">' + data.msg + '...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
             setTimeout(function() {
                  $('#reply4').html('');
                $("#days").toggleClass("active");
                $("#service").toggleClass("active");
                 $("#li4").toggleClass("active");
                $("#li5").toggleClass("active");
                   //window.location.assign('index.php');
                },3000);
                  } else {
                      $('#reply4').html('<div class="alert alert--danger" role="alert">' + data.msg + '... <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
                   setTimeout(function() {
                  $('#reply4').html('');
                    
                },1000);
          }
              });
              $request.always(function(data) {
          console.log(data);
            
              // resetmem();
              });

       });     
$("#backbasic").on('click', function(event) {
                 $("#basic").toggleClass("active");
                $("#accomo").toggleClass("active");
                 $("#li1").toggleClass("active");
                $("#li2").toggleClass("active");
}); 
$("#backaccomo").on('click', function(event) {
                $("#accomo").toggleClass("active");
                $("#hotel").toggleClass("active");
                 $("#li2").toggleClass("active");
                $("#li3").toggleClass("active");
}); 
$("#backhotel").on('click', function(event) {
                $("#hotel").toggleClass("active");
                $("#days").toggleClass("active");
                 $("#li3").toggleClass("active");
                $("#li4").toggleClass("active");
});                       
$("#backdays").on('click', function(event) {
                $("#days").toggleClass("active");
                $("#service").toggleClass("active");
                $("#li4").toggleClass("active");
                $("#li5").toggleClass("active");
});
$("#backservice").on('click', function(event) {
                $("#service").toggleClass("active");
                $("#markup").toggleClass("active");
                $("#li5").toggleClass("active");
                $("#li6").toggleClass("active");
});
//------------------------------- operation on service---------------
$("#addservice").on('click', function(event) {
        event.preventDefault(); 
        if( $("#service_id").val()=="") {
        $("#service_id").focus();
        alert("Please Enter valid service.....!");
        return;
       }
       if( !$(".payable:checked").prop('checked')) {
        $(".payable").focus();
        alert("Please Enter valid service payable.....!");
        return;
       }
       var service_id=$("#service_id").val();
       var service_name = $('#service_id option[value="'+service_id+'"]').html();  
 
       var payable = $(".payable:checked").val();   

        var i;
        var row = 0;

        $('#addservicebody tr').each(function() {
          row = row + 1;
        });
                
        if (row == 0) {
          i = 0;
        }else{
          i = row;
        };
      var  tr = '<tr id="row_'+ (i+1) +'"  title="'+ (i+1) +'">';
           tr += '<td id="sr_'+ (i+1) +'" data-sr="'+ (i+1) +'">'+ (i+1) +'</td>';
           tr += '<td id="service_'+ (i+1) +'" data-service_id="'+ service_id +'">'+ service_name +'</td>';
           tr += '<td id="payable_'+ (i+1) +'" data-payable="'+ payable +'">'+ payable +'</td>';         
            tr += '<td>';
            tr += '<a type="button" class="btn btn-danger btn-sm" id="remove_list" data-srno="'+ (i+1) +'"><i class="icon-trash"></i></a>';
            tr+=  '</td>';
            tr += '</tr>';
          $('#addservicebody').append(tr);
          $("#service_id").val("");
     });

  $('#addservicebody').on('click', '#remove_list', function(event) {
      event.preventDefault();
      /* Act on the event */
      var $this = $(this);
      var id = $this.data('srno')
      var tr = $this.parent().parent();
     // console.log(tr);
      
      //var parent = tr.find('#row_'+id).remove();
      var parent = $('#row_'+id).remove();
       
    });
$("#submit5").on('click', function(event) {
        event.preventDefault(); 
  var service =new Array();var payable =new Array();
   var ind=0;var $form_data;
   $('#addservicebody tr').each(function(){
                    
                    id = $(this).attr('id');
                    var str = id;
                    var parsing_id = str.replace("row_", "");

                  var service_name = $("#service_" + parsing_id).data('service_id');
                    var payables = $("#payable_" + parsing_id).data('payable');
                   service[ind]=service_name;
           payable[ind]=payables;
             ind++; 

                  });
   $form_data = 'action=save5&service=' +service+ '&payable=' +payable;
                 
          var $request = $.ajax({
                              url :'inc/maintain_quote.php',
                              type: "POST",
                              data: $form_data,               
                  dataType: 'json',              
                 
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table

                    if (data.status) {                
                     //reDrawDataTable();
					
                     clearFields();
                     $('#reply5').html('<div class="alert alert-success" role="alert">' + data.msg + '...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
                $("#service").toggleClass("active");
                $("#markup").toggleClass("active");
                $("#li5").toggleClass("active");
                $("#li6").toggleClass("active");
					
             setTimeout(function() {
                  $('#reply5').html('');
               
                   //window.location.assign('index.php');
                },3000);
                  } else {
                      $('#reply5').html('<div class="alert alert--danger" role="alert">' + data.msg + '... <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
                   setTimeout(function() {
                  $('#reply5').html('');
                    
                },1000);
          }
              });
              $request.always(function(data) {
          console.log(data);
            
              // resetmem();
              });

       });  

$("#submit6").on('click', function(event) {
        event.preventDefault(); 
     var inputFile = $('input[type=file]');   
        
      var fileToUpload = inputFile[0].files[0];
      console.log(fileToUpload);
	 // return;
      var $form_data = new FormData();
      
      if (fileToUpload != 'undefined') {
								
      	$('form#form6').serializeArray().forEach(function(field){
            $form_data.append(field.name, field.value);
      	});
				$form_data.append('file', fileToUpload);
      } else {
          $('form#form6').serializeArray().forEach(function(field){
            $form_data.append(field.name, field.value);
        });
      }
	  $form_data.append("action", "save6");
                 
          var $request = $.ajax({
                              url :'inc/maintain_quote.php',
                              type: "POST",
                              data: $form_data,               
                              cache: false,
			      dataType: 'json',
			      processData: false, // Don't process the files
			      contentType: false,       
                 
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table

                    if (data.status) {                
                     //reDrawDataTable();
					
                     clearFields();
                     $('#reply6').html('<div class="alert alert-success" role="alert">' + data.msg + '...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');

					  window.location.replace("viewQuote.php");
             setTimeout(function() {
                  $('#reply6').html('');
               
                   
                },1000);
                  } else {
                      $('#reply6').html('<div class="alert alert--danger" role="alert">' + data.msg + '... <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
                   setTimeout(function() {
                  $('#reply6').html('');
                    
                },1000);
          }
              });
              $request.always(function(data) {
          console.log(data);
            
              // resetmem();
              });

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
else
{

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
	 //$(".form-control").val("");
	
	
	}


  function changeDescription()
  {
    var trans_id=$("#trans_id option[value="+$("#trans_id").val()+"]").html();
    var pickup=$("#pickup").val();
    var drop=$("#drop").val();
    if(trans_id!='' && pickup!='' && drop!='')
    {
   var $request = $.ajax({
                              url : 'inc/maintain_quote.php',
                              type: "POST",
                              data: {action:"loaddescription",trans_id:trans_id,pickup:pickup,drop:drop},
                           dataType: "JSON",
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table
                 console.log(data);
                  if (data.status) {
                    $("#description").val(data.msg);
                  } else {
                       $("#description").val("");
                  }
        });
      }
  }
  function fetchhotels($id,$halt_id)
  {
    
   var $request = $.ajax({
                              url : 'inc/maintain_quote.php',
                              type: "POST",
                              data: {action:"loadhotel",id:$id,halt_id:$halt_id},
                             dataType: "JSON",
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table
                 //console.log(data);
                  if (data.status) {
                    $("#hotelname").html(data.msg);
                  } else {
                      $("#hotelname").html("");
                  }
        });
  }
   function fetchdestinations()
  {
    
   var $request = $.ajax({
                              url : 'inc/maintain_quote.php',
                              type: "POST",
                              data: {action:"loaddest"},
                             dataType: "JSON",
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table
                 //console.log(data);
                  if (data.status) {
                    $("#tourdest").html(data.msg);
                    
                  } else {
                      $("#tourdest").html("");
                  }
        });
  }
  function fetchhaltdestinations()
  {
    
   var $request = $.ajax({
                              url : 'inc/maintain_quote.php',
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
                      $("#halt_id").html("");
                  }
        });
  }
     function fetchtransportations()
  {
    
   var $request = $.ajax({
                              url : 'inc/maintain_quote.php',
                              type: "POST",
                              data: {action:"loadtrans"},
                             dataType: "JSON",
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table
                 //console.log(data);
                  if (data.status) {
                    $("#trans_id").html(data.msg);
                     
                  } else {
                     $("#trans_id").html("");
                  }
        });
  }
function fetchmealtype($id)
  {
    
   var $request = $.ajax({
                              url : 'inc/maintain_quote.php',
                              type: "POST",
                              data: {action:"loadmeal",id:$id},
                             dataType: "JSON",
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table
                 //console.log(data);
                  if (data.status) {
                   // $("#mealtype").html(data.msg);
                     
                  } else {
                   //$("#mealtype").html("");
                  }
        });
  }
function fetchAgentMarkup()
{
 var $formData = { action: "edit"};

            $.ajax( {
                    url: 'inc/maintain_quote.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $formData,
                } )
                .done( function( $resp ) {
                    //console.log( $resp );
                    if( typeof $resp !== 'undefined' ) { 
						
$("#nameofcompany").val($resp[0].nameofcompany);
 $("#corp_office").val($resp[0].corp_office);
 $("#reg_office").val($resp[0].reg_office);
  $("#hotline").val($resp[0].hotline);
 $("#emailat").val($resp[0].emailat);
  $("#website").val($resp[0].website);
  $("#logo").attr("src",'data:image/jpg;base64,'+$resp[0].logoofcompany);
		
                    } else {
                        $('#reply').html('<div class="alert alert-danger" role="alert">Error to display record... <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
                   setTimeout(function() {
                  $('#reply').html('');
                    
                },1000);
                    }
                } )
                .always( function( $resp ) {
					 console.log( $resp );
                         // reDrawDataTable();
						  
                } );

}
  function fetchservice()
  {
    
   var $request = $.ajax({
                              url : 'inc/maintain_quote.php',
                              type: "POST",
                              data: {action:"loadservice"},
                             dataType: "JSON",
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table
                 //console.log(data);
                  if (data.status) {
                    $("#service_id").html(data.msg);
                     
                  } else {
                     $("#service_id").html("");
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