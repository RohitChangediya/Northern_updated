<?php  
session_start();
if(!isset($_SESSION['uid']) || $_SESSION['uid']==""){header("Location:index.html");}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Maintain Hotel Rooms - Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
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
	      				<i class="icon-money"></i>
	      				<h3>Maintain Hotel Rooms</h3>
	  				</div> 
					 
					<div class="widget-content">
                       <div id="reply"></div> 
                      <form id="form"  class="form-horizontal">
									<fieldset>
										
										
										<div class="control-group">											
											<label class="control-label" for="hotelname">Hotel Name</label>
											
                                            <div class="controls">
                                              <div class="btn-group">
                      <select id="hotelname" class="span6 form-control" name="hotelname">
											
											
											</select>
                       <input type="hidden" class="span6 form-control" name="hotelroom_id" id="hotelroom_id" >
                      
                                            </div>
                                              </div>	<!-- /controls -->			
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="roomtype">Room Type</label>
											<div class="controls">
												<input type="text" class="span6 form-control" id="roomtype" name="roomtype">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                                                                <div class="control-group">											
											<label class="control-label" for="noofrooms">Number Of Rooms</label>
											<div class="controls">
												<input type="number" class="span6 form-control" id="noofrooms" name="noofrooms" min="1">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										 <div class="control-group">											
											<label class="control-label">AC/Non-AC</label>
											
                                            
                                            <div class="controls">
                                            <label class="radio inline">
                                              <input type="radio"  class="actype" name="actype" value="AC"> AC
                                            </label>
                                            
                                            <label class="radio inline">
                                              <input type="radio" class="actype" name="actype" value="NON-AC"> Non-AC
                                            </label>
                                          </div>	<!-- /controls -->			
										</div> 
										<div class="control-group">                     
                      <label class="control-label" for="charge">&nbsp;</label>

                         <label class="control-label" for="charge">On Season Charges</label> 
                        
                    </div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="charge">Room Charges / Dbl Room(On Season)</label>
											<div class="controls">
<input type="text" class="form-control" id="charge_ep" name="charge_ep" placeholder="EP">
<input type="text" class="form-control" id="charge_cp" name="charge_cp" placeholder="CP">
<input type="text" class="form-control" id="charge_map" name="charge_map" placeholder="MAP">
<input type="text" class="form-control" id="charge_ap" name="charge_ap" placeholder="AP" >
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="extrabed">Extra Bed Charge(On Season)</label>
											<div class="controls">
<input type="text" class="form-control" id="extrabed_ep" name="extrabed_ep" placeholder="EP">
<input type="text" class="form-control" id="extrabed_cp" name="extrabed_cp" placeholder="CP">
<input type="text" class="form-control" id="extrabed_map" name="extrabed_map" placeholder="MAP">
<input type="text" class="form-control" id="extrabed_ap" name="extrabed_ap" placeholder="AP" >

											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="extraperson">Child Without Bed Charge (On Season)</label>
											<div class="controls">
<input type="text" class="form-control" id="extraperson_ep" name="extraperson_ep" placeholder="EP">
<input type="text" class="form-control" id="extraperson_cp" name="extraperson_cp" placeholder="CP">
<input type="text" class="form-control" id="extraperson_map" name="extraperson_map" placeholder="MAP">
<input type="text" class="form-control" id="extraperson_ap" name="extraperson_ap" placeholder="AP">
											</div> <!-- /controls -->				
										</div> 
										  <div class="control-group">                     
                      <label class="control-label" for="extrachild">Extra Child Below 5 Yrs Charge(Free) (On Season)</label>
                      <div class="controls">
                        <input type="text" class="form-control" id="extrachild_ep" name="extrachild_ep" placeholder="EP">
                        <input type="text" class="form-control" id="extrachild_cp" name="extrachild_cp" placeholder="CP">
                        <input type="text" class="form-control" id="extrachild_map" name="extrachild_map" placeholder="MAP">
                        <input type="text" class="form-control" id="extrachild_ap" name="extrachild_ap" placeholder="AP">
                      </div> <!-- /controls -->       
                    </div> 
                                      
		<div class="control-group">                     
                      <label class="control-label" for="charge">&nbsp;</label>

                         <label class="control-label" for="charge">Off Season Charges</label> 
                        
                    </div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="charge">Room Charges / Dbl Room(Off Season)</label>
											<div class="controls">
<input type="text" class="form-control" id="off_charge_ep" name="off_charge_ep" placeholder="EP">
<input type="text" class="form-control" id="off_charge_cp" name="off_charge_cp" placeholder="CP">
<input type="text" class="form-control" id="off_charge_map" name="off_charge_map" placeholder="MAP">
<input type="text" class="form-control" id="off_charge_ap" name="off_charge_ap" placeholder="AP" >
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="extrabed">Extra Bed Charge(Off Season)</label>
											<div class="controls">
<input type="text" class="form-control" id="off_extrabed_ep" name="off_extrabed_ep" placeholder="EP">
<input type="text" class="form-control" id="off_extrabed_cp" name="off_extrabed_cp" placeholder="CP">
<input type="text" class="form-control" id="off_extrabed_map" name="off_extrabed_map" placeholder="MAP">
<input type="text" class="form-control" id="off_extrabed_ap" name="off_extrabed_ap" placeholder="AP" >

											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="extraperson">Child Without Bed Charge (Off Season)</label> 
											<div class="controls">
<input type="text" class="form-control" id="off_extraperson_ep" name="off_extraperson_ep" placeholder="EP">
<input type="text" class="form-control" id="off_extraperson_cp" name="off_extraperson_cp" placeholder="CP">
<input type="text" class="form-control" id="off_extraperson_map" name="off_extraperson_map" placeholder="MAP">
<input type="text" class="form-control" id="off_extraperson_ap" name="off_extraperson_ap" placeholder="AP">
											</div> <!-- /controls -->				
										</div> 
										  <div class="control-group">                     
                      <label class="control-label" for="extrachild">Extra Child Below 5 Yrs Charge(Free) (Off Season)</label>
                      <div class="controls">
                        <input type="text" class="form-control" id="off_extrachild_ep" name="off_extrachild_ep" placeholder="EP">
                        <input type="text" class="form-control" id="off_extrachild_cp" name="off_extrachild_cp" placeholder="CP">
                        <input type="text" class="form-control" id="off_extrachild_map" name="off_extrachild_map" placeholder="MAP">
                        <input type="text" class="form-control" id="off_extrachild_ap" name="off_extrachild_ap" placeholder="AP">
                      </div> <!-- /controls -->       
                    </div> 							 		
										<div class="form-actions">
										<button type="submit" id="submit"  class="btn btn-primary">Save</button> 
											<button class="btn">Cancel</button>
										</div> <!-- /form-actions -->
									</fieldset>
								</form>
								<table  class="table table-bordered table-hover table-condensed" id="datatable">
                <thead>
								<tr>
								<th> ID</th>
								<th>Hotel Name</th>
								<th>Room Type</th>
								<th>AC/Non-AC</th>
								
								<th>Actions</th>
								</tr>
							</thead>
              <tbody>
              </tbody>
								
								</table>
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
<!-- /main -->

<!-- /extra -->
<div class="footer">
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
<script src="js/hotelroom.js"></script>
 <script type="text/javascript">
    /* Global JavaScript File for working with jQuery library */
        $(function(){
            // execute when the HTML file's (document object model: DOM) has loaded
   
            hotelroom_crud.init();
        
        });
  
  
  
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
</body>
</html>
