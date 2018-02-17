<?php  
session_start();
if(!isset($_SESSION['uid']) || $_SESSION['uid']==""){header("Location:index.html");}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Manage Leads - Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/plans.css" rel="stylesheet">
<link href="css/datepicker.css" rel="stylesheet">
<link href="css/jquery.dataTables.min.css" rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<?php require_once('inc/header.php');?>
<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        
        <!-- /span6 -->
        <div class="span12">
		  <div class="widget">
	      			
	      			<div class="widget-header">
	      				<i class="icon-gift"></i>
	      				<h3>Manage Leads</h3> 
	      				 <a href="#" data-toggle='modal' data-target='#leadmodal' class="btn btn-primary" ><i class="icon-plus" style="color:white;"></i> &nbsp; New Lead</a>
	      				 &nbsp;&nbsp;&nbsp;
	      				Choose Date : <input type="month" id="leadsdate" placeholder="yyyy/mm" style="margin-top: 7px;"> 
                  &nbsp;&nbsp;&nbsp;<a href="#" id="export" class="btn btn-primary" ><i class="icon-share" style="color:white;"></i> &nbsp; Export</a>
	  				</div> <!-- /widget-header -->
					
					<div class="widget-content">
							<div id="replylead"></div>
                     
					<div class="pricing-plans plans-4" id="leads">
							
						<div class="plan-container">
					        <div class="plan green">
						        <div class="plan-header">
					                
						        	<div class="plan-title">
						        		Confirm Leads    &nbsp;&nbsp; &nbsp; <span id="cntconfirm"></span>   		
					        		</div> <!-- /plan-title -->
					                
						          
									
						        </div> <!-- /plan-header -->	        
						        
						        <div class="plan-features">
									<ul  ondrop="drop(event)"  ondragover="allowDrop(event)" style="padding:20px;" id="confirm_lead">
										<!-- <li draggable="true" ondrop="nodrop(event)" ondragstart="drag(event)" id="drag7">customer 7</li>
										<li draggable="true" ondrop="nodrop(event)" ondragstart="drag(event)" id="drag8">customer 8</li> -->
									</ul>
								</div> <!-- /plan-features -->
								
								
					
							</div> <!-- /plan -->
					    </div> <!-- /plan-container -->
					    
					    
					    
					    <div class="plan-container">
					        <div class="plan blue">
						        <div class="plan-header">
					                
						        	<div class="plan-title">
						        		Hot Leads	   &nbsp;&nbsp; &nbsp; <span id="cnthot"></span>      		
					        		</div> <!-- /plan-title -->
					                
						          
									
						        </div> <!-- /plan-header -->	          
						        
						        <div class="plan-features">
									<ul   ondrop="drop(event)"  ondragover="allowDrop(event)" style="padding:20px;" id="hot_lead">					
									
									</ul>
								</div> <!-- /plan-features -->
								
								
					
							</div> <!-- /plan -->
					    </div> <!-- /plan-container -->
					    
					    <div class="plan-container">
					        <div class="plan yellow">
						        <div class="plan-header">
					                
						        	<div class="plan-title">
						        		Warm Leads	 &nbsp;&nbsp; &nbsp; <span id="cntwarm"></span>       		
					        		</div> <!-- /plan-title -->	                			
						        </div> <!-- /plan-header -->	       
						        
						        <div class="plan-features">
									<ul ondrop="drop(event)" ondragover="allowDrop(event)" style="padding:20px;" id="warm_lead">
										
										
                                       
									</ul>
								</div> <!-- /plan-features -->
								
								
					
							</div> <!-- /plan -->
							
					    </div> <!-- /plan-container -->
				       <div class="plan-container">
					        <div class="plan">
						        <div class="plan-header">
					                
						        	<div class="plan-title">
						        		Cold Leads	 &nbsp;&nbsp; &nbsp; <span id="cntcold"></span>       		
					        		</div> <!-- /plan-title -->	                			
						        </div> <!-- /plan-header -->	       
						        
						        <div class="plan-features">
									<ul ondrop="drop(event)"  ondragover="allowDrop(event)" style="padding:20px;" id="cold_lead">
                                        
										
										
									</ul>
								</div> <!-- /plan-features -->
								
								
					
							</div> <!-- /plan -->
							
					    </div> <!-- /plan-container -->
				
					</div>


								</div>
								</div>
								</div>
        <!-- /span12 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main --><div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
         <div class="span12"> &copy; <?php echo date('Y');?> <a href="www.northern-travels.com">northern-travels</a>. </div>
        <!-- /span12 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /footer-inner --> 
</div>
<!-- /footer --> 
<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/jquery-1.7.2.min.js"></script> 
<script src="js/excanvas.min.js"></script> 
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.datatables.js" type="text/javascript" ></script>
<script src="js/leads.js"></script>
 <script type="text/javascript">
    /* Global JavaScript File for working with jQuery library */
        $(function(){
            // execute when the HTML file's (document object model: DOM) has loaded
   
            leads_crud.init();
			  
        });
	
	
	
    </script>
    <script>
function allowDrop(ev) {
    ev.preventDefault();
}
function nodrop(ev)
{
     ev.stopPropagation();
}
function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    	var $form_data = { action: "change", id: data,lead_type:ev.target.id };
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
                    switch(data.lead_type)
                    {
                      case "Confirm":$("#confirm_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data.id+"'><b>"+data.cust_name+"</b>("+data.user+")<br>Note :"+data.info+"</li>");
                                      break;
                      case "Hot":$("#hot_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data.id+"'><b>"+data.cust_name+"</b>("+data.user+")<br>Note :"+data.info+"</li>");break;
                      case "Warm":$("#warm_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data.id+"'><b>"+data.cust_name+"</b>("+data.user+")<br>Note :"+data.info+"</li>");break;
                      case "Cold":$("#cold_lead").append("<li class='custitem' draggable='true' ondrop='nodrop(event)' ondragstart='drag(event)' id='"+data.id+"'><b>"+data.cust_name+"</b>("+data.user+")<br>Note :"+data.info+"</li>");break;
                    }
                     
                      lead_count();
                     $('#replylead').html('<div class="alert alert-success" role="alert">' + data.msg + '...<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>');
					   setTimeout(function() {
                  $('#replylead').html('');
                  
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

    ev.target.appendChild(document.getElementById(data));
   
     }
</script>
<script src="js/common.js"></script>
 <script type="text/javascript">
    /* Global JavaScript File for working with jQuery library */
        $(function(){
            // execute when the HTML file's (document object model: DOM) has loaded  
           
            roombook_crud.init();
        });   
    </script> 
<script>
 function fetchcheckhotels()
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
                    $("#checkhotel").html(data.msg);
                  } else {
                      alert("Please reload the page...");
                  }
        });
  }
  $(function(){
fetchcheckhotels();
$("#date").datepicker({ startDate: new Date()});
$("#fromdate").datepicker({ startDate: new Date()});
$("#todate").datepicker({ startDate: new Date()});
$("#checkavail").on('click', function(event) {
        event.preventDefault();      
        
       
        if( $("#checkhotel").val()=="") {
          alert("Please Enter valid Hotel Name.....!");
        $("#checkhotel").focus();
        return;
       }
       if($("#date").val()=="")
       {
        alert("Please Enter valid date.....!");
        $("#date").focus();
        return;
       }
    
      var $formData = $('#checkform').serialize();
      $formData+="&action=checkavail";
        console.log($formData);

        var $request = $.ajax({
                              url :'inc/maintain_user.php',
                              type: "POST",
                              data: $formData,
                  dataType: 'json',
                //processData: false, // Don't process the files
                //contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table

                  if (data.status) {                 //console.log(data);
                    $("#loadAvail").html(data.msg);
           
             setTimeout(function() {
                 
                   
                },2000);
                  } else {
                        alert(data.msg);
                   setTimeout(function() {
                
                    
                },2000);
          }
              });
              $request.always(function(data) {
          console.log(data);
            
              // resetmem();
              });
      
      });
$("#changepass").on('click', function(event) {
        event.preventDefault();      
        
       
        if( $("#opass").val()=="") {
          alert("Please Enter valid old password.....!");
        $("#opass").focus();
        return;
       }
       if($("#npass").val()!=$("#cpass").val())
       {
        alert("Password do not match.....!");
        $("#npass").focus();
        return;
       }
    
      var $formData = $('#changeform').serialize();
      $formData+="&action=change";
        console.log($formData);

        var $request = $.ajax({
                              url :'inc/maintain_user.php',
                              type: "POST",
                              data: $formData,
                  dataType: 'json',
                //processData: false, // Don't process the files
                //contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table

                  if (data.status) {                 //console.log(data);
                     alert(data.msg);
           
             setTimeout(function() {
                 
                   window.location.reload();
                },2000);
                  } else {
                        alert(data.msg);
                   setTimeout(function() {
                
                    
                },2000);
          }
              });
              $request.always(function(data) {
          console.log(data);
            
              // resetmem();
              });
      
      });
  });
  </script>
<script src="js/voucher.js"></script>
  <div class="span6 modal fade" id="leadmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">New Lead</h4>
                                      </div>
                                      <div class="modal-body">
                                        <div class="container-fluid">
                    <div class="row">
                        <div class="span5">
                            <div class="card">
                                <form id="leadform" method="POST" class="form-horizontal">
                                    <div class="card-header card-header-text">
                                 
                                    </div>
                                    <div class="card-content">
                  <div class="row" id="reply2">
                  
                 
                   <div class="control-group">                      
                      <label class="span3 control-label" for="npass">Lead Date</label>
                      <div class="controls">
                        <input type="date" class="span3 form-control" id="leadsdate1" name="leadsdate1">
                      </div> <!-- /controls -->       
                 </div>
                   <div class="control-group">                      
                      <label class="span3 control-label" for="cust_name">Customer</label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="cust_name" name="cust_name">
                        <input type="hidden" class="span3 form-control" id="cust_id" name="cust_id">
                      </div> <!-- /controls -->       
                    </div>
                 <div class="control-group">                      
                      <label class="span3 control-label" for="npass">Contact</label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="cust_contact" name="cust_contact">
                      </div> <!-- /controls -->       
                 </div>
                 <div class="control-group">                      
                      <label class="span3 control-label" for="cust_email">Email</label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="cust_email" name="cust_email">
                      </div> <!-- /controls -->       
                 </div> 
                 <div class="control-group">                      
                      <label class="span3 control-label" for="cust_location">Location</label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="cust_location" name="cust_location">
                      </div> <!-- /controls -->       
                 </div>   
                 <div class="control-group">                      
                      <label class="span3 control-label" for="cust_status">Lead Status</label>
                      <div class="controls">
                        <select class="span3 form-control" id="cust_status" name="cust_status">
                        	<option value=""> --- Select --- </option>
                        	<option value="Confirm"> Confirm</option>
                        	<option value="Hot"> Hot</option>
                        	<option value="Warm"> Warm</option>
                        	<option value="Cold"> Cold</option>
                        	<option value="Closed"> Closed</option>
                        </select>
                      </div> <!-- /controls -->       
                 </div>     
                 <div class="control-group">                      
                      <label class="span3 control-label" for="cust_details">Details</label>
                      <div class="controls">
                        <textarea class="span3 form-control" id="cust_details" name="cust_details"></textarea> 
                      </div> <!-- /controls -->       
                 </div>             
                                        
                                     
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="savelead">Save changes</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
</body>
</html>
