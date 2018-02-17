<?php  
session_start();
//echo $_SESSION['usertype'];
if(!isset($_SESSION['uid']) || $_SESSION['uid']==""){ header("Location:index.html");}

/*if($_SESSION['usertype']=="AGENT")
 { 
header("Location:prepareQuote.php");
 }
  else if($_SESSION['usertype']=="HOTEL")
 { 
header("Location:viewQuote.php");
  }*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dashboard - Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<link href="css/pages/reports.css" rel="stylesheet">
<link href="css/datepicker.css" rel="stylesheet">
<link href="css/jquery.dataTables.min.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<audio autoplay controls loop>
  <source src="hutch.mp3" type="audio/mpeg">
</audio>
<?php require_once('inc/header.php');?>
<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
 <div class="row">
        <?php
        
if($_SESSION['usertype']=="ADMIN")
 { ?>
      <a href="#" class="btn btn-default" data-toggle='modal' data-target='#banner' style="position: absolute;margin-left: 40px; margin-top: 8px;"><i class="icon-plus"></i> Add Banners</a>
 <?php }?>
        <!-- Advertisements-->
        <div class="span12" id="loadmyimg">
              
        </div>
</div><br>
    <div class="row">
          
          <div class="span12">
        
           <div class="market-updates">
     <a href="http://backoffice.northern-travels.com/manageleads.php"> <div class="span4 market-update-gd"> 
        <div class="market-update-block clr-block-1">
          <div class="span2 market-update-left">
            <h3 id="cntleads">0</h3>
            <h4>Total Leads</h4>
            <p></p>
          </div>
          <div class="span1 market-update-right">
            <i class="icon-briefcase"> </i>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
</a>
      <a href="http://backoffice.northern-travels.com/viewVouchers.php"><div class="span4 market-update-gd">
        <div class="market-update-block clr-block-2">
         <div class="span2 market-update-left">
          <h3 id="cntvoucher">0</h3>
          <h4>Total Confirmation Vouchers</h4>
          <p></p>
          </div>
          <div class="span1 market-update-right">
            <i class="icon-th"> </i>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div></a>

      <a href="http://backoffice.northern-travels.com/viewQuote.php"><div class="span4 market-update-gd">
        <div class="market-update-block clr-block-3">
          <div class="span2 market-update-left">
            <h3 id="cntquot">0</h3>
            <h4>Total Quotations</h4>
            <p></p>
          </div>
          <div class="span1 market-update-right">
            <i class="icon-bar-chart"> </i>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div></a>
       <div class="clearfix"> </div>
    </div>
               
               
         </div>
         </div>


      <!--div class="row">
        
    
        <div class="span12">
          <div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3>Important Shortcuts</h3>
            </div>
     
     <div class="widget-content">
        <div class="shortcuts"> 
        <a href="maintainDestinations.php" class="shortcut"><i class="shortcut-icon icon-road"></i><span class="shortcut-label">Maintain Destinations</span> </a>
        <a href="maintainservices.php" class="shortcut"><i class="shortcut-icon icon-gift"></i><span class="shortcut-label">Maintain Services</span> </a>
        <a href="maintaintransport.php" class="shortcut"><i class="shortcut-icon icon-truck"></i> <span class="shortcut-label">Maintain Transportations</span> </a>
        <a href="maintainmeal.php" class="shortcut"> <i class="shortcut-icon icon-fire"></i><span class="shortcut-label"></span> Maintain Mealtype</a>
        <a href="maintainhotel.php" class="shortcut"><i class="shortcut-icon icon-list-alt"></i><span class="shortcut-label">Maintain Hotels</span> </a>
        <a href="maintainrooms.php" class="shortcut"><i class="shortcut-icon icon-money"></i><span class="shortcut-label">Hotel Rooms</span> </a>
        <a href="prepareQuote.php" class="shortcut"><i class="shortcut-icon icon-credit-card"></i> <span class="shortcut-label">Prepare Quotation</span> </a>
        <a href="viewQuote.php" class="shortcut"> <i class="shortcut-icon icon-list"></i><span class="shortcut-label">View Quotations</span> </a> </div>
            
            </div>
         
          </div>
        
         
        
          
        </div>
       
      </div-->
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

<!-- modalroom book start-->
  <div class="span10 modal fade" id="banner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>Maintain Banner</h4>
                                      </div>
                                      <div class="modal-body">
                                        <div class="container-fluid">
                    <div class="row">
                        <div class="span8">
                            <div class="card">
                                <form role="form" id ="bannerform"  method="post" enctype="multipart/form-data">
						<div class="span6">
							
							
								<input type='hidden' class="form-control" name='id' id='id'>
								 <div class="control-group"> 									
								
									<label class="span3 control-label" for="opass">Select Image</label>
									<div class="controls">
                                                                     <input type="file" class="span3 form-control" name="slider_img" id="slider_img" >
                                                                       </div>	
								</div>								
							        <div class="control-group"> 									
								
									<label class="span3 control-label" for="opass">&nbsp;</label>
									<div class="controls">
								<button type="submit" name="submit" id="submit" class="btn btn-primary">Submit </button>
								
								<button type="reset" id="reset" class="btn btn-default">Reset </button>
								 </div>	
								</div>
							</div>
									
							<div class="span9" style="margin-left:20px">
 <img src="" id="loadimg" style="width:100%">
							</div>
							
						
						</form>
<div class="span8">
<table class="table table-bordered table-hover table-condensed" id="datatable">
								<thead>
								<tr>
								<th>ID</th>
                                                                <th>Banner File</th>												
								<th>Actions</th>
								</tr>
								<thead>
								<tbody>
								</tbody>
								</table>
</div>
                            </div>
                        </div>

                    </div>
                </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        
                                      </div>
                                    </div>
                                  </div>
                                </div>

<!-- modal room book end -->

<!-- /footer --> 
<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/jquery-1.7.2.min.js"></script> 
<script src="js/excanvas.min.js"></script> 
<script src="js/chart.min.js" type="text/javascript"></script> 
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.datatables.js" type="text/javascript" ></script>

<script src="js/banner.js"></script>
<script src="js/common.js"></script>
 <script type="text/javascript">
    /* Global JavaScript File for working with jQuery library */
        $(function(){
            // execute when the HTML file's (document object model: DOM) has loaded
   
            banner_crud.init();
            roombook_crud.init();
            load_lead_count();
            load_voucher_count();
            load_quot_count();
        });
  
  
  
    </script> 

<script>
   function load_lead_count()
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
                   
                    var total=data.total;
                    $("#cntleads").html(total);
                   
                  } 
              });
              $request.always(function(data) {
          console.log(data);
            
              // resetmem();
              });
  }
  function load_voucher_count()
  {
     data = {"action": "vouchercnt"};
        var $request = $.ajax({
                              url :'inc/maintain_leads.php',
                              type: "POST",
                              data: data,               
                              dataType: 'json',
                
                 
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table

                    if (data) {                
                   
                    var total=data.total;
                    $("#cntvoucher").html(total);
                   
                  } 
              });
              $request.always(function(data) {
          console.log(data);
            
              // resetmem();
              });
  }
  function load_quot_count()
  {
     data = {"action": "quotcnt"};
        var $request = $.ajax({
                              url :'inc/maintain_leads.php',
                              type: "POST",
                              data: data,               
                              dataType: 'json',
                
                 
                            });
            $request.done(function(data) {
              //if success close modal and reload ajax table

                    if (data) {                
                   
                    var total=data.total;
                    $("#cntquot").html(total);
                   
                  } 
              });
              $request.always(function(data) {
          console.log(data);
            
              // resetmem();
              });
  }
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
