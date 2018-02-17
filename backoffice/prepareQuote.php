<?php  
session_start();
if(!isset($_SESSION['uid']) || $_SESSION['uid']==""){header("Location:index.html");}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Prepare Quotation- Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<link href="css/jquery.dataTables.min.css" rel="stylesheet">
<link href="css/datepicker.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<style>
	.control-group {
    margin-bottom: 0px;
}
	</style>
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
	      				<i class="icon-credit-card"></i>
	      				<h3>Prepare Quotation</h3>
	  				</div> <!-- /widget-header -->
					
					<div class="widget-content">
					<div class="tabbable">
						<ul class="nav nav-tabs">
						  <li id="li1" class="active">
						    <a href="#basic" data-toggle="tab">Basic Details</a>
						  </li>
						  <li id="li2" ><a href="#accomo" data-toggle="tab">Accommodation Details</a></li>
						  <li id="li3">
						    <a href="#hotel" data-toggle="tab">Night Halting Details</a>
						  </li>
						   <li id="li4">
						    <a href="#days" data-toggle="tab">Daywise Tour Itinerary</a>
						  </li>
						   <li id="li5">
						    <a href="#service" data-toggle="tab">Add On Services</a>
						  </li>
                                                     <li id="li6">
						    <a href="#markup" data-toggle="tab">Markup</a>
						  </li>
						</ul>
						
						<br>
						
			<div class="tab-content">
				<div class="tab-pane active" id="basic">
                   
									  <div id="reply1"></div>
                                      <form id="form1"  class="form-horizontal">
											
											<div class="span6">
												<div class="control-group">	
										
											<label class="control-label" for="season">Season :</label>
											
                                            
												<input type="radio" class="span1 form-control" id="season" name="season" Value="ON">ON</input>
												<input type="radio" class="span1 form-control" id="season" name="season" Value="OFF" >OFF</input>
													
										</div> 
										<div class="control-group">											
											<label class="control-label" for="clientname">Client Name:</label>
											
                                            <div class="controls">
												<input type="text" class="span4 form-control" id="clientname" name="clientname" >
											</div>	<!-- /controls -->			
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="mobile">Mobile </label>
											<div class="controls">
												<input type="text" class="span4 form-control" id="mobile" name="mobile">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="email">Mail </label>
											<div class="controls">
												<input type="text" class="span4 form-control" id="email" name="email" >
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="firstname">Tour Destination </label>
											<div class="controls">
												<select class="span4 form-control" id="tourdest" name="tourdest">
																								</select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="firstname">Arrival Date </label>
											<div class="controls">
											<input type="text" class="span4 form-control" id="arrivedate" name="arrivedate" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
											<div class="control-group">											
											<label class="control-label" for="firstname">Departure Date </label>
											<div class="controls">
												<input type="text" class="span4 form-control" id="departuredate" name="departuredate" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" >
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<!--div class="control-group">											
											<label class="control-label" for="firstname">Arrival Destination </label>
											<div class="controls">
												<select class="span4 form-control" id="arrivedest" name="arrivedest" >
												
												</select>
											</div> 				
										</div--> 
										<!-- div class="control-group">											
											<label class="control-label" for="firstname">Departure Destination </label>
											<div class="controls">
												<select class="span4 form-control" id="departuredest" name="departuredest">
												
												</select>
											</div> 				
										</div--> 
											<div class="control-group">											
											<label class="control-label" for="firstname"> Transport Arrival Destination </label>
											<div class="controls">
												<select class="span4 form-control" id="transarrivedest" name="transarrivedest" >
												
												</select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="firstname"> Transport Departure Destination </label>
											<div class="controls">
												<select class="span4 form-control" id="transdeparturedest" name="transdeparturedest">
												
												</select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->


<div class="control-group">											
											<label class="control-label" for="firstname">Tour Duration Nights</label>
											<div class="controls">
											<select class="span4 form-control" min="0" id="tourdurationnight" name="tourdurationnight"  >
<?php
          for($i=0;$i<51;$i++)
          {
           ?>
            <option value='<?php echo $i;?>'><?php echo $i;?></option>
          <?php
             }
             ?>
</select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="firstname">Tour Duration Days </label>
											<div class="controls">
											<select class="span4 form-control" min="0" id="tourduration" name="tourduration"  >
<?php
          for($i=0;$i<51;$i++)
          {
           ?>
            <option value='<?php echo $i;?>'><?php echo $i;?></option>
          <?php
             }
             ?>
</select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

									<div class="form-actions">
											<button type="submit" id="submit1"  class="btn btn-primary">NEXT<i class="icon-arrow-right"></i> </button> 
											<button class="btn">Cancel</button>

										</div>
										</div>
									</form>
									</div> <!-- tab-->
									<div class="tab-pane" id="accomo">
										  <div id="reply2"></div>
                                      <form id="form2"  class="form-horizontal">
											<div class="span6">
										<div class="control-group">											
											<label class="control-label" for="lastname">Number Of Rooms</label>
											<div class="controls">
												<select  class="span3  form-control" id="noofroom" name="noofroom">
<?php
          for($i=1;$i<51;$i++)
          {
           ?>
            <option value='<?php echo $i;?>'><?php echo $i;?></option>
          <?php
             }
             ?>
</select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="email">Number Of Extra Beds</label>
											<div class="controls">
												<select class="span3  form-control" id="extrabeds" name="extrabeds"  >
<?php
          for($i=0;$i<51;$i++)
          {
           ?>
            <option value='<?php echo $i;?>'><?php echo $i;?></option>
          <?php
             }
             ?>
</select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="email"> Number Of Childs without Beds</label>
											<div class="controls">
												<select class="span3  form-control" id="childs" name="childs" >
<?php
          for($i=0;$i<51;$i++)
          {
           ?>
            <option value='<?php echo $i;?>'><?php echo $i;?></option>
          <?php
             }
             ?>
</select>
											</div> <!-- /controls -->				
										</div> 
										<div class="control-group">											
											<label class="control-label" for="email">Number Of Childs Below 5 Years ( Free )</label>
											<div class="controls">
												<select class="span3  form-control" id="childs5yrs"  name="childs5yrs">
<?php
          for($i=0;$i<51;$i++)
          {
           ?>
            <option value='<?php echo $i;?>'><?php echo $i;?></option>
          <?php
             }
             ?>
</select>
											</div> <!-- /controls -->				
										</div>
										<!--div class="control-group">											
											<label class="control-label" for="email">Childs Above 10 Years / Person</label>
											<div class="controls">
											<input type="number" min="0" class="span3  form-control" id="childs10yrs"  name="childs10yrs">
											</div> 				
										</div-->
										
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
										</div> <br>
										<div class="form-actions">
										<a href="javascript:;" title="BACK" class="btn btn-primary" id="backbasic"><i class="icon-arrow-left"></i>BACK </a>
										<button type="submit" id="submit2"  class="btn btn-primary">NEXT<i class="icon-arrow-right"></i> </button> 
											<button class="btn">Cancel</button>
										</div>
										</div>
								</form>
								
								</div><!-- tab2-->
									 
								
								<div class="tab-pane" id="hotel">
									  <div id="reply3"></div>
                                      <form id="form3"  class="form-horizontal">
											<div class="span6">
<div class="control-group">											
											<label class="control-label" for="halt_id">Night Halting Destination</label>
											
                                            <div class="controls">
                                              <div class="btn-group">
                                            <select class="span3  form-control" id="halt_id" name="halt_id" >
											
											
											</select>
                                            </div>
                                              </div>	<!-- /controls -->			
										</div>
									<div class="control-group">											
											<label class="control-label" for="hoteltype">Hotel Type</label>
											
                                            <div class="controls">
                                              <div class="btn-group">
                                            <select class="span3  form-control" id="hoteltype" name="hoteltype" >
												<option value="1">Standard</option>
											<option value="2">Deluxe</option>
											<option value="3">Super Deluxe</option>
											<option value="4">Comfort</option>
											<option value="5">Luxury</option>
											
											</select>
                                            </div>
                                              </div>	<!-- /controls -->			
										</div>

								<div class="control-group">											
											<label class="control-label" for="hotelname">Hotel Name</label>
											
                                            <div class="controls">
                                              <div class="btn-group">
                                            <select class="span3  form-control" id="hotelname" name="hotelname" >
											
											
											</select>
                                            </div>
                                              </div>	<!-- /controls -->			
										</div>
										
                                     <div class="control-group">											
											<label class="control-label" for="firstname">Number Of Nights </label>
											<div class="controls">
												<select class="span3 form-control" id="noofnights" name="noofnights" >
<?php
          for($i=1;$i<51;$i++)
          {
           ?>
            <option value='<?php echo $i;?>'><?php echo $i;?></option>
          <?php
             }
             ?>
</select>
											</div> <!-- /controls -->				
										</div>

<div class="control-group">											
											<label class="control-label" for="firstname">From Date </label>
											<div class="controls">
												<input type="text" class="span3 form-control" id="fromdate" name="fromdate"  data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy">
												</select>
											</div> <!-- /controls -->				
										</div>	
	<div class="control-group">											
											<label class="control-label" for="firstname">To Date </label>
											<div class="controls">
												<input type="text" class="span3 form-control" id="todate" name="todate"  data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" >
												
											</div> <!-- /controls -->				
										</div>	

										<div class="control-group">											
											<label class="control-label" for="firstname">Room Type </label>
											<div class="controls">
												<select class="span3 form-control" id="roomtype" name="roomtype" >
												</select>
											</div> <!-- /controls -->				
										</div>	
										<div class="control-group">											
											<label class="control-label" for="firstname">Meal Types </label>
											<div class="controls">
												<select class="span3 form-control" id="mealtype" name="mealtype">
<option value="EP">EP</option>
<option value="CP">CP</option>
<option value="MAP">MAP</option>
<option value="AP">AP</option>
												</select>
											</div> <!-- /controls -->				
										</div>
										<a class="btn btn-info" href="#" id="addhotel"><i class="icon-plus"></i> Add</a>
										</br></br>
									
										<table class="table table-striped table-bordered table-hover nowrap">
								       <tr>
							    <th>Sr No</th>
                                                               <th>Halt Destination</th>
								<th>Hotel Name</th>
								<th>Number Of Nights</th>
                                                                <th>From Date</th>
                                                                <th>To Date</th>
								<th>Room Type</th>
								<th>Meal Type</th>
								<th>Actions</th>
								</tr>
								<tbody id="addhotelbody">
								</tbody>
								
								</table>
								
										<!-- /form-actions -->
									<div class="form-actions">
									<a href="javascript:;" title="BACK" class="btn btn-primary" id="backaccomo"><i class="icon-arrow-left"></i>BACK </a>
											<button type="submit" id="submit3"  class="btn btn-primary">NEXT<i class="icon-arrow-right"></i> </button> 
											<button class="btn">Cancel</button>
										</div>
								</div>
								</form>
								
								</div> <!-- tab3-->
								
								<div class="tab-pane" id="days">
									 <div id="reply4"></div>
                                      <form id="form4"  class="form-horizontal">
											<div class="span6">
								<div class="control-group">											
											<label class="control-label" for="day">Day </label>
											<div class="controls">
												<select class="span3 form-control" id="day" name="day" >
<?php
          for($i=1;$i<51;$i++)
          {
           ?>
            <option value='<?php echo $i;?>'><?php echo $i;?></option>
          <?php
             }
             ?>
</select>
											</div> 
                                            	<!-- /controls -->			
										</div>
										
                                     
										<div class="control-group">											
											<label class="control-label" for="email">Transportation</label>
											<div class="controls">
												<select class="span3  form-control" id="trans_id" name="trans_id">
												</select>
											</div> <!-- /controls -->				
										</div>
                                                                                <div class="control-group">											
											<label class="control-label" for="noofcab">Number Of Cabs </label>
											<div class="controls">
												<select class="span3 form-control" id="noofcabs" name="noofcabs">
<?php
          for($i=1;$i<51;$i++)
          {
           ?>
            <option value='<?php echo $i;?>'><?php echo $i;?></option>
          <?php
             }
             ?>
</select>
											</div> 
                                            	<!-- /controls -->			
										</div>
										<div class="control-group">											
											<label class="control-label" for="pickup">Pickup Point </label>
											<div class="controls">
												<select class="span3 form-control" id="pickup" name="pickup">
												</select>
											</div> 
                                            	<!-- /controls -->			
										</div>
										<div class="control-group">											
											<label class="control-label" for="drop">Drop Point </label>
											<div class="controls">
												<select class="span3 form-control" id="drop" name="drop">
												</select>
											</div> 
                                            	<!-- /controls -->			
										</div>
                                                                                <div class="control-group">											
											<label class="control-label" for="description">Description </label>
											<div class="controls">
												<textarea  class="span3 form-control" id="description" name="description" onkeypress="return check(event)" ></textarea>
											</div> <!-- /controls -->				
										</div>
										<a class="btn btn-info" href="#" id="adddays"><i class="icon-plus"></i> Add</a>
										</br></br>
									
										<table class="table table-striped table-bordered table-hover nowrap">
								<tr>
							    <th> Sr No</th>
								<th>Day</th>
								<th>Description</th>
								<th>Transport</th>
								<th>Pickup Location</th>
								<th>Drop Location</th>
                                                                <th>Number Of Cabs</th>
								<th>Actions</th>
								</tr>
								<tbody id="adddaysbody">
								</tbody>
								
								</table>
								
										<!-- /form-actions -->
									<div class="form-actions">
									<a href="javascript:;" title="BACK" class="btn btn-primary" id="backhotel"><i class="icon-arrow-left"></i>BACK </a>
											<button type="submit" id="submit4"  class="btn btn-primary">NEXT<i class="icon-arrow-right"></i> </button> 
											<button class="btn">Cancel</button>
										</div>
								</div>
								</form>
								
								</div> <!-- tab4 -->
								<div class="tab-pane" id="service">
									  <div id="reply5"></div>
                                      <form id="form5"  class="form-horizontal">
											<div class="span6 form-control">
								<div class="control-group">											
											<label class="control-label" for="radiobtns">Service </label>
											<div class="controls">
												<select class="span6 form-control" id="service_id" name="service_id">
												
												</select>
											</div> 
                                            	<!-- /controls -->			
										</div>
										
                                   <div class="control-group">											
											<label class="control-label">Service Payable</label>
											
                                            
                                            <div class="controls">
                                            <label class="radio inline">
                                              <input type="radio" class="payable" name="payable" value="FREE"> Free
                                            </label>
                                            
                                            <label class="radio inline">
                                              <input type="radio" class="payable" name="payable" value="PAYABLE">Payable
                                            </label>
                                          </div>	<!-- /controls -->			
										</div> 
										<a class="btn btn-info" href="#" id="addservice"><i class="icon-plus"></i> Add</a>
										<br><br>
									
										<table class="table table-striped table-bordered table-hover nowrap">
								<tr>
							
								<th>Service</th>
								<th>Payable</th>
								
								<th>Actions</th>
								</tr>
								<tbody id="addservicebody">
								</tbody>
								
								</table>
								
										<!-- /form-actions -->
									<div class="form-actions">
									<a href="javascript:;" title="BACK" class="btn btn-primary" id="backdays"><i class="icon-arrow-left"></i>BACK </a>
										<button type="submit" id="submit5"  class="btn btn-primary">NEXT <i class="icon-arrow-right"></i></button> 
											<button class="btn">Cancel</button>
										</div>
								</div>
								</form>
								
								</div> <!-- tab5 -->
<!-- tab 6 -->

<div class="tab-pane" id="markup">
									  <div id="reply6"></div>
                                      <form id="form6"  class="form-horizontal" enctype="multipart/form-data">
					<div class="span6 form-control" >

                                                <div class="control-group">											
									<label class="control-label" for="radiobtns">Logo</label>
								<div class="controls">
									<img src='' style='width: 50%;' id='logo'>
								</div> <!-- /controls -->                                            				
						</div>

						<div class="control-group">											
									<label class="control-label" for="radiobtns">Markup (Rs)</label>
								<div class="controls">
									<input type="text" class="span3 form-control" id="markup" name="markup" value="0">
								</div> <!-- /controls -->                                            				
						</div>
						<div class="control-group">											
									<label class="control-label" for="nameofcompany">Company Name</label>
								<div class="controls">
								<input type="text" class="span3 form-control" id="nameofcompany" name="nameofcompany">
								</div> <!-- /controls -->                                            				
						</div>
<div class="control-group">											
									<label class="control-label" for="logoofcompany">Company Logo</label>
								<div class="controls">
								<input type="file" class="span3 form-control" id="logoofcompany" name="logoofcompany">
								</div> <!-- /controls -->                                            				
						</div>

                                               <div class="control-group">											
							    <label class="control-label" for="corp_office">Corporate Office</label>
								<div class="controls">
								<input type="text" class="span3 form-control" id="corp_office" name="corp_office">
								</div> <!-- /controls -->                                            				
						</div>
                                               <div class="control-group">											
									<label class="control-label" for="reg_office">Regional Office</label>
								<div class="controls">
								<input type="text" class="span3 form-control" id="reg_office" name="reg_office">
								</div> <!-- /controls -->                                            				
						</div>
                                               <div class="control-group">											
									<label class="control-label" for="hotline">Hotline</label>
								<div class="controls">
								<input type="text" class="span3 form-control" id="hotline" name="hotline">
								</div> <!-- /controls -->                                            				
						</div>
                                               <div class="control-group">											
									<label class="control-label" for="emailat">Email us</label>
								<div class="controls">
								<input type="text" class="span3 form-control" id="emailat" name="emailat">
								</div> <!-- /controls -->                                            				
						</div>
                                                <div class="control-group">											
									<label class="control-label" for="website">Website</label>
								<div class="controls">
								<input type="text" class="span3 form-control" id="website" name="website">
								</div> <!-- /controls -->                                            				
						</div>				
                                 
				
				<br><br>
									
				<!-- /form-actions -->
				<div class="form-actions">
				<a href="javascript:;" title="BACK" class="btn btn-primary" id="backservice"><i class="icon-arrow-left"></i>BACK </a>
				<button type="submit" id="submit6"  class="btn btn-primary">Save</button> 
				<button class="btn">Cancel</button>
				</div>
			</div>
		</form>
								
	</div> <!-- tab6 -->

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
<script src="js/chart.min.js" type="text/javascript"></script> 
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>
 <script src="js/jquery.datatables.js" type="text/javascript" ></script>
<script src="js/base.js"></script> 
<script src="js/preparequote.js"></script>
<script src="js/common.js"></script>
 <script type="text/javascript">
    /* Global JavaScript File for working with jQuery library */
        $(function(){
            // execute when the HTML file's (document object model: DOM) has loaded
   
            preparequote_crud.init();
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
<script language="javascript" type="text/javascript">
function check(e) {
    var keynum
    var keychar
    var numcheck
    // For Internet Explorer
    if (window.event) {
        keynum = e.keyCode;
    }
    // For Netscape/Firefox/Opera
    else if (e.which) {
        keynum = e.which;
    }
    keychar = String.fromCharCode(keynum);
    //List of special characters you want to restrict
    if (keychar == "'" || keychar == "`" || keychar =="!"  || keychar =="^" || keychar =="&"  || keychar =="-" || keychar =="_"   || keychar =="~" || keychar =="<" || keychar ==">"  || keychar ==";" || keychar ==":" || keychar =="|"  || keychar =="¬" || keychar =="£" || keychar =='"' ) {
        return false;
    } else {
        return true;
    }
}
</script>
<script src="js/voucher.js"></script>
</body>
</html>
