  <div class="span6 modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                                      </div>
                                      <div class="modal-body">
                                        <div class="container-fluid">
                    <div class="row">
                        <div class="span5">
                            <div class="card">
                                <form id="changeform" method="POST" class="form-horizontal">
                                    <div class="card-header card-header-text">
                                 
                                    </div>
                                    <div class="card-content">
                  <div class="row" id="reply2">
                  
                  </div>
                   <div class="control-group">                      
                      <label class="span3 control-label" for="opass">Old Password</label>
                      <div class="controls">
                        <input type="password" class="span3 form-control" id="opass" name="opass">
                      </div> <!-- /controls -->       
                    </div>
                         <div class="control-group">                      
                      <label class="span3 control-label" for="npass">New Password</label>
                      <div class="controls">
                        <input type="password" class="span3 form-control" id="npass" name="npass">
                      </div> <!-- /controls -->       
                    </div>
                       <div class="control-group">                      
                      <label class="span3 control-label" for="cpass">Confirm Password</label>
                      <div class="controls">
                        <input type="password" class="span3 form-control" id="cpass" name="cpass">
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
                                        <button type="button" class="btn btn-primary" id="changepass">Save changes</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
<!--  modal change password end -->

<!-- modal check availablity start-->
  <div class="span10 modal fade" id="available" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>Check Availability</h4>
                                      </div>
                                      <div class="modal-body">
                                        <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form id="checkform" method="POST" class="form-horizontal">
                                    <div class="card-header card-header-text">
                                 
                                    </div>
                                    <div class="card-content">
                  <div class="row" id="reply23">
                  
                  </div>
                   <div class="control-group">                      
                      <label class="span3 control-label" for="opass">Select Hotel</label>
                      <div class="controls">
                        <select class="span3 form-control" id="checkhotel" name="checkhotel">
                        </select>
                      </div> <!-- /controls -->       
                    </div>
                         <div class="control-group">                      
                      <label class="span3 control-label" for="npass">Date</label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="date" name="date" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy">
                      </div> <!-- /controls -->       
                    </div>
                       <!--div class="control-group">                      
                      <label class="span3 control-label" for="cpass">Time</label>
                      <div class="controls">
                        <input type="time" class="span3 form-control" id="time" name="time">
                      </div> <!-- /controls -->       
                    </div-->                 
                     <div class="control-group">                      
                      <label class="span3 control-label" for="cpass">&nbsp;</label>
                      <div class="controls">
                         <button type="button" class="btn btn-primary" id="checkavail">Check Availability</button>
                      </div> <!-- /controls -->       
                    </div>                     
                      <div class="control-group" id="loadAvail" style="padding-left: 20px;">                

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
                                        
                                      </div>
                                    </div>
                                  </div>
                                </div>

<!-- modal check availablity end -->

<!-- modalroom book start-->
  <div class="span10 modal fade" id="roombook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>Book/Block Rooms</h4>
                                      </div>
                                      <div class="modal-body">
                                        <div class="container-fluid">
                    <div class="row">
                        <div class="span8">
                            <div class="card">
                                <form id="bookform" method="POST" class="form-horizontal">
                                    <div class="card-header card-header-text">
                                 
                                    </div>
                                    <div class="card-content">
                  <div class="row" id="reply33">
                  
                  </div>

                   <div class="control-group">                      
                      <label class="span3 control-label" for="opass">Select Hotel</label>
                      <div class="controls">
                        <select class="span3 form-control" id="hotelbook" name="hotelbook">
                        </select>
                      </div> <!-- /controls -->       
                    </div>
                    <div class="control-group">                      
                      <label class="span3 control-label" for="opass">Select Room</label>
                      <div class="controls">
                        <select class="span3 form-control" id="room" name="room">
                        </select>
                      </div> <!-- /controls -->       
                    </div>
                   <div class="control-group">                      
                      <label class="span3 control-label" for="npass">Number Of Room</label>
                      <div class="controls">
                        <input type="number" class="span3 form-control" id="nofrooms" name="nofrooms" min='1'>
                      </div> <!-- /controls -->       
                    </div>
                    <div class="control-group">                      
                      <label class="span3 control-label" for="npass">Name Of Client</label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="nameofclient" name="nameofclient" ">
                      </div> <!-- /controls -->       
                    </div>
                         <div class="control-group">                      
                      <label class="span3 control-label" for="npass">Date</label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="bookdate" name="bookdate" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy">
                      </div> <!-- /controls -->       
                    </div>
                       <div class="control-group">                      
                      <label class="span3 control-label" for="cpass">Notes</label>
                      <div class="controls">
                        <textarea class="span3 form-control" id="notes" name="notes"></textarea>
                      </div> <!-- /controls -->       
                    </div>                 
                     <div class="control-group">                      
                      <label class="span3 control-label" for="cpass">&nbsp;</label>
                      <div class="controls">
                         <button type="button" class="btn btn-primary" id="booknow">Book Now</button>
                      </div> <!-- /controls -->       
                    </div>                     
                        

    
                                    </div>
                                </form>
<div class="span9">
<table class="table table-bordered table-hover table-condensed" id="datatablebook">
								<thead>
								<tr>
								<th> ID</th>
                                                                <th> Name</th>
								<th>Hotel </th>
								<th>Room </th>
                                                                <th>Num Of Room </th>
                                                                <th>Date </th>
                                                                <th>Status</th>
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

<!-- modal voucher start-->
  <div class="span10 modal fade" id="voucher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>Confirmation Voucher</h4>
                                      </div>
                                      <div class="modal-body" style="max-height: 450px;">
                                        <div class="container-fluid">
                    <div class="row">
                        <div class="span8">
                            <div class="card">
                                <form id="voucherform" method="POST" class="form-horizontal">
                                    <div class="card-header card-header-text">
                                 
                                    </div>
                                    <div class="card-content">

                  <div class="row" id="replyconfirm">
                  
                  </div>
<fieldset>
<legend>Personalize Details:</legend>
                 
                   <div class="control-group">                      
                      <label class="span3 control-label" for="opass">Client Name</label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="clientname1" name="clientname1">
                       
                      </div> <!-- /controls -->       
                    </div>

                      <div class="control-group">                      
                      <label class="span3 control-label" for="opass">Email</label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="emailid" name="emailid">
                       
                      </div> <!-- /controls -->       
                    </div>

                    <div class="control-group">                      
                      <label class="span3 control-label" for="opass">Contact Number</label>
                      <div class="controls">
                       <input type="text" class="span3 form-control" id="contactno" name="contactno">
                      </div> <!-- /controls -->       
                    </div>
                   <div class="control-group">                      
                      <label class="span3 control-label" for="npass">Nationality</label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="nationality" name="nationality" >
                      </div> <!-- /controls -->       
                    </div>
                    <div class="control-group">                      
                      <label class="span3 control-label" for="npass">Arriving From</label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="arrivefrom" name="arrivefrom" >
                      </div> <!-- /controls -->       
                    </div>
</fieldset>

<fieldset>
<legend>Travelers Details:</legend>
                         <div class="control-group">                      
                      <label class="span3 control-label" for="npass">Number of Travelers</label>
                      <div class="controls">
                        <select " class="span3 form-control" id="nooftraveler" name="nooftraveler" >
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
                      <label class="span3 control-label" for="npass">Number of Adult's</label>
                      <div class="controls">
                        <select  class="span3 form-control" id="noofadult" name="noofadult" >
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
                      <label class="span3 control-label" for="npass">Childs Chargeable</label>
                      <div class="controls">
                        <select  class="span3 form-control" id="childchargeable" name="childchargeable" >
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
                      <label class="span3 control-label" for="npass">Kids Complementary</label>
                      <div class="controls">
                        <select  class="span3 form-control" id="kids" name="kids" >
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
</fieldset>
<fieldset>
<legend>Arrival &amp; Departure Details:</legend>
  <div class="control-group">                      
                      <label class="span3 control-label" for="npass">Arrive From </label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="arrival" name="arrival" >
                      </div> <!-- /controls -->       
                    </div>
<div class="control-group">                      
                      <label class="span3 control-label" for="npass">Date Of Travel</label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="traveldt" name="traveldt" >
                      </div> <!-- /controls -->       
                    </div>
 <div class="control-group">                      
                      <label class="span3 control-label" for="npass">Departure At </label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="departureat" name="departureat" >
                      </div> <!-- /controls -->       
                    </div>
 <div class="control-group">                      
                      <label class="span3 control-label" for="npass">Date Of Departure </label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="departuredt" name="departuredt" >
                      </div> <!-- /controls -->       
                    </div>
 <div class="control-group">                      
                      <label class="span3 control-label" for="npass">Arrival Railway/Flight No along timing </label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="arriveby" name="arriveby" >
                      </div> <!-- /controls -->       
                    </div>
<div class="control-group">                      
                      <label class="span3 control-label" for="npass">Departure Railway/Flight No along timing </label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="departureby" name="departureby" >
                      </div> <!-- /controls -->       
                    </div>
</fieldset>
<fieldset>
<legend>Accommodation &amp; Transportation Details:</legend>

<div class="control-group">                      
                      <label class="span3 control-label" for="npass">Number Of Rooms </label>
                      <div class="controls">
                        <select class="span3 form-control" id="noofroomss" name="noofroomss" >
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
                      <label class="span3 control-label" for="npass">Number Of Extra Beds </label>
                      <div class="controls">
                        <select class="span3 form-control" id="extrabeds" name="extrabeds" >
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
                      <label class="span3 control-label" for="npass">Number Of Childs W/O Beds </label>
                      <div class="controls">
                        <select class="span3 form-control" id="withoutbeds" name="withoutbeds" >
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
                      <label class="span3 control-label" for="npass">Transportaion </label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="transportation" name="transportation" >
                      </div> <!-- /controls -->       
                    </div>
<div class="control-group">                      
                      <label class="span3 control-label" for="npass">Number Of Cabs </label>
                      <div class="controls">
                        <select class="span3 form-control" id="noofcab" name="noofcab" >
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



</fieldset>
<fieldset>
<legend>Hotels, Meals &amp; Destination Stay:</legend>

<div class="control-group">                      
                      <label class="span3 control-label" for="npass">Hotel Name: </label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="hotname" name="hotname" >
                      </div> <!-- /controls -->       
                    </div>
<div class="control-group">                      
                      <label class="span3 control-label" for="npass">Destination: </label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="desti" name="desti" >
                      </div> <!-- /controls -->       
                    </div>
<div class="control-group">                      
                      <label class="span3 control-label" for="npass">Sightseeing: </label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="sightseeing" name="sightseeing" >
                      </div> <!-- /controls -->       
                    </div>
<div class="control-group">                      
                      <label class="span3 control-label" for="npass">Check In: </label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="chkin" name="chkin" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy">
                      </div> <!-- /controls -->       
                    </div>
<div class="control-group">                      
                      <label class="span3 control-label" for="npass">Check Out: </label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="chkout" name="chkout" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" >
                      </div> <!-- /controls -->       
                    </div>
<div class="control-group">                      
                      <label class="span3 control-label" for="npass">Nights: </label>
                      <div class="controls">
                        <select class="span3 form-control" id="night" name="night" >
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
                      <label class="span3 control-label" for="npass">Meals: </label>
                      <div class="controls">
                        <input type="text" class="span3 form-control" id="meals" name="meals" >
                      </div> <!-- /controls -->       
                    </div>
<div class="control-group">                      
                      <label class="span3 control-label" for="npass">Room Type: </label>
                      <div class="controls">
                          <select class="span3  form-control" id="rroomtype" name="rroomtype" >
												<option value="1">Standard</option>
											<option value="2">Deluxe</option>
											<option value="3">Super Deluxe</option>
											<option value="4">Comfort</option>
											<option value="5">Luxury</option>
											
											</select>
                      </div> <!-- /controls -->       
                    </div>
<div class="control-group">                      
                      <label class="span3 control-label" for="cpass">&nbsp;</label>
                      <div class="controls">
                         <button type="button" class="btn btn-primary" id="addhotelbtn">Add</button>
                      </div> <!-- /controls -->       
                    </div>  

<div class="span8">
<table class="table table-bordered table-hover table-condensed" >
								<thead>
								<tr>
                                                                <th> Sr.No</th>
								<th> Hotel Name</th>
                                                                <th> Destination</th>
								<th>Sightseeing </th>
								<th>Check In</th>
                                                                <th>Check Out </th>
                                                                <th>Nights</th>
                                                                <th>Meal</th>
								<th>Room Type</th>
                                                                 <th> Action</th>
								</tr>
								<thead>
								<tbody id="datatablevoucher">
								</tbody>
								</table>
</div>

</fieldset>
<fieldset>
<legend>Tour Itinerary:</legend>
<div class="control-group">                      
                      <label class="span3 control-label" for="npass">Day: </label>
                      <div class="controls">
                        <select class="span3 form-control" id="dy" name="dy" >
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
                      <label class="span3 control-label" for="cpass">Description</label>
                      <div class="controls">
                        <textarea class="span3 form-control" id="dsc" name="dsc"></textarea>
                      </div> <!-- /controls -->       
                    </div>      
<div class="control-group">                      
                      <label class="span3 control-label" for="cpass">&nbsp;</label>
                      <div class="controls">
                         <button type="button" class="btn btn-primary" id="additday">Add</button>
                      </div> <!-- /controls -->       
                    </div>  

<div class="span8">
<table class="table table-bordered table-hover table-condensed" >
								<thead>
								<tr>
                                                                <th> Sr No</th>
								<th> Day</th>
                                                                <th> Description</th>
                                                                <th> Action</th>
								</tr>
								<thead>
								<tbody id="datatableitinerary">
								</tbody>
								</table>
</div>
           
</fieldset>
<fieldset>
<legend>Do'es And Don'ts:</legend>
 <div class="control-group">                      
                      <label class="span3 control-label" for="cpass">Do'es And Don'ts</label>
                      <div class="controls">
                        <textarea class="span3 form-control" id="dondont" name="dondont"></textarea>
                      </div> <!-- /controls -->       
                    </div> 

                                     
                     
</fieldset>
<fieldset>
<legend>Special Additions:</legend>
 <div class="control-group">                      
                      <label class="span3 control-label" for="cpass">Special Additions</label>
                      <div class="controls">
                        <textarea class="span3 form-control" id="specialads" name="specialads"></textarea>
                      </div> <!-- /controls -->       
                    </div> 

                                     
                     
</fieldset>
    
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="voucherprint">Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        
                                      </div>
                                    </div>
                                  </div>
                                </div>

<!-- modal confirm voucher end -->



<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.html">Admin Panel </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
 <?php
          if($_SESSION['usertype']=='AGENT' ||  $_SESSION['usertype']=='ADMIN')
          {
          ?>
                <li class="dropdown" ><i class=" icon-group" style="float: left;margin-top: 11px;color: white;font-size: 20px;"></i><a href="manageleads.php" style="float:left;"><span>Manage Leads</span> </a> </li>
          <?php
           }
          if($_SESSION['usertype']!='AGENT' &&  $_SESSION['usertype']!='USER')
          {
          ?>
<li class="dropdown" ><i class=" icon-list" style="float: left;margin-top: 11px;color: white;font-size: 20px;"></i><a href="viewVouchers.php" style="float:left;"><span>View Vouchers</span> </a> </li>
<li class="dropdown"><i class="icon-book" style="float: left;margin-top: 11px;color: white;font-size: 20px;"></i> <a href="#" data-toggle='modal' data-target='#roombook' style="float:left;">Room Bookings</a></li>
<li class="dropdown"><i class="icon-file" style="float: left;margin-top: 11px;color: white;font-size: 20px;"></i> <a href="#" data-toggle='modal' data-target='#voucher' style="float:left;">Confirmation Voucher</a></li>
<?php }
 if($_SESSION['usertype']=='USER' )
          {
          ?>
           <li class="dropdown"><i class="icon-check" style="float: left;margin-top: 11px;color: white;font-size: 20px;"></i> <a href="view.php" style="float:left;" target='_blank'>View Voucher</a></li>

          <?php }
          if($_SESSION['usertype']=='ADMIN' )
          {
          ?>
           <li class="dropdown"><i class="icon-check" style="float: left;margin-top: 11px;color: white;font-size: 20px;"></i> <a href="#" data-toggle='modal' data-target='#available' style="float:left;">Check Availability</a></li>

          <?php }?>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> <?php echo $_SESSION['username'];?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <?php if($_SESSION['usertype']!='USER'){?>
              <li><a data-toggle='modal' data-target='#myModal' > <i class=" icon-cog"></i>  Change Password</a></li>
              <?php }?>
              <li><a href="logout.php"> <i class="icon-off"></i>  Logout</a></li>
            </ul>
          </li>
        </ul>
        
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <?php
          if($_SESSION['usertype']=='ADMIN' ){
          ?>
        <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='dashboard.php')? 'active' : '';?>"><a href="dashboard.php"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='maintainAgents.php')? 'active' : '';?>"><a href="maintainAgents.php"><i class="icon-group"></i><span>Agents / Users</span> </a> </li>
		   <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='maintainDestinations.php')? 'active' : '';?>"><a href="maintainDestinations.php"><i class="icon-road"></i><span>Destinations</span> </a> </li>

  <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='maintainHaltDestinations.php')? 'active' : '';?>"><a href="maintainHaltDestinations.php"><i class="icon-umbrella"></i><span>Night Halt Destinations</span> </a> </li>

          <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='maintainTour.php')? 'active' : '';?>"><a href="maintainTour.php"><i class="icon-flag"></i><span>Tours </span> </a> </li>
       <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='maintainTransDestinations.php')? 'active' : '';?>"><a href="maintainTransDestinations.php"><i class="icon-truck"></i><i class="icon-road"></i><span>Transport Dest</span> </a> </li>
		  
        <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='maintaintransport.php')? 'active' : '';?>"><a href="maintaintransport.php"><i class="icon-truck"></i><span>Transportations</span> </a> </li>
       <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='maintainservices.php')? 'active' : '';?>"><a href="maintainservices.php"><i class="icon-gift"></i><span>Services</span> </a> </li>
        <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='maintainhotel.php')? 'active' : '';?>"><a href="maintainhotel.php"><i class="icon-list-alt"></i><span>Hotels</span> </a> </li>
        <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='maintainrooms.php')? 'active' : '';?>"><a href="maintainrooms.php"><i class="icon-money"></i><span>Hotel Rooms</span> </a></li>
         <!--li class="<?php echo (basename($_SERVER['PHP_SELF'])=='maintainmeal.php')? 'active' : '';?>"><a href="maintainmeal.php"><i class="icon-fire"></i><span>Mealtype</span> </a> </li-->
          <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='prepareQuote.php')? 'active' : '';?>"><a href="prepareQuote.php"><i class="icon-credit-card"></i><span>Prepare Quotation</span> </a> </li>
        <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='viewQuote.php')? 'active' : '';?>"><a href="viewQuote.php"><i class=" icon-list"></i><span>View Quotations</span> </a> </li>

        <?php 
          }
      ?> 
        <?php
          if($_SESSION['usertype']=='AGENT' )
          {
          ?>
            <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='dashboard.php')? 'active' : '';?>"><a href="dashboard.php"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='prepareQuote.php')? 'active' : '';?>"><a href="prepareQuote.php"><i class="icon-credit-card"></i><span>Prepare Quotation</span> </a> </li>
        <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='viewQuote.php')? 'active' : '';?>"><a href="viewQuote.php"><i class=" icon-list"></i><span>View Quotations</span> </a> </li>
       <?php 
          }
          ?>
  <?php
          if($_SESSION['usertype']=='HOTEL' )
          {
          ?>
          <li class="<?php echo (basename($_SERVER['PHP_SELF'])=='dashboard.php')? 'active' : '';?>"><a href="dashboard.php"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        <!--li class="<?php echo (basename($_SERVER['PHP_SELF'])=='viewQuote.php')? 'active' : '';?>"><a href="viewQuote.php"><i class=" icon-list"></i><span>View Quotations</span> </a> </li-->
       <?php 
          }
          ?>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>