<?php  
session_start();
if(!isset($_SESSION['uid']) || $_SESSION['uid']==""){header("Location:index.html");}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Maintain Transportations - Admin Panel</title>
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
	      				<i class="icon-gift"></i>
	      				<h3>Maintain Transportations</h3>
	  				</div> <!-- /widget-header -->
					
					<div class="widget-content">
					<div id="reply"></div>
                      <form id="form"  class="form-horizontal">
									<fieldset>
										
										
										
										
										<div class="control-group">											
											<label class="control-label" for="transport">Transport</label>
											<div class="controls">
												<input type="text" class="span6 form-control" name="transport" id="transport"  >
												<input type="hidden" class="span6 form-control" name="trans_id" id="trans_id" >
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">                     
                      <label class="control-label" for="arrive_dest_id">Pickup Point</label>
                      <div class="controls">
                        <select class="span6 form-control" name="arrive_dest_id" id="arrive_dest_id"  ></select>
                      
                      </div> <!-- /controls -->       
                    </div>
                    <div class="control-group">                     
                      <label class="control-label" for="dep_dest_id">Drop Point</label>
                      <div class="controls">
                        <select class="span6 form-control" name="dep_dest_id" id="dep_dest_id"  ></select>
                      
                      </div> <!-- /controls -->       
                    </div>
<div class="control-group">											
											<label class="control-label" for="description">Description </label>
											<div class="controls">
												<textarea class="span6 form-control" id="description" name="description" onkeypress="return check(event)"></textarea>
											</div> <!-- /controls -->				
										</div>
										<div class="control-group">											
											<label class="control-label" for="costing">On Season Costing</label>
											<div class="controls">
												<input type="text" class="span6 form-control" name="costing" id="costing"  >
											
											</div> <!-- /controls -->				
										</div>
										    <div class="control-group">                     
                      <label class="control-label" for="costing"> Off season Costing</label>
                      <div class="controls">
                        <input type="text" class="span6 form-control" name="offcosting" id="offcosting"  >
                      
                      </div> <!-- /controls -->       
                    </div>
                                       
											
										<div class="form-actions">
											<button type="submit" id="submit"  class="btn btn-primary">Save</button> 
											<button class="btn">Cancel</button>
										</div> <!-- /form-actions -->
									</fieldset>
								</form>
								<table class="table table-bordered table-hover table-condensed" id="datatable">
								<thead>
								<tr>
								<th> ID</th>
								<th>Transport</th>
                <th>Pickup Point</th>
                 <th>Drop Point</th>   
                        
								<th>On Season Costing</th>
                <th>Off Season Costing</th>
								<th>Actions</th>
								</tr>
								<thead>
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
<script src="js/transport.js"></script>
 <script type="text/javascript">
    /* Global JavaScript File for working with jQuery library */
        $(function(){
            // execute when the HTML file's (document object model: DOM) has loaded
   
            transport_crud.init();
			  
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
