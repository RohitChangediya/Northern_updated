<?php 
	require_once('header.php');
?>
<link rel="stylesheet" type="text/css" href="css/chekbox.css">
      <div class="page-header">
              <h1>
                Maintain Tours
                <small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  
                </small>
              </h1>
      </div><!-- /.page-header -->
  <!-- <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">      -->
   
        <div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
              <button class='btn btn-success btn-round btn-add-tour'><i class='material-icons'></i> Add New Tour<div class='ripple-container'></div></button><br><br>
                <div class="tools">
                    <a href="" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="" class="reload"></a>
                    <a href="" class="remove"></a>
                </div>
            </div>

            <div class="portlet-body">

                <div class="row">
                    <div class="col-md-12">
                         <table class="table table-bordered table-hover table-condensed" id="datatable">
                            <thead>
                               <tr>
                                  <th>Id</th>
                                  <th>Category</th>
                                  <th>Title</th>
                                  <th>Destination</th>
                                  <th>Duration</th>
                                  <th>Price</th>
                                  <!-- <th>Desription</th> -->
                                  <th width="12%">ACTIONS</th>
                               </tr>
                            </thead>
                            <tbody></tbody>
                         </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
  <div class="modal fade" id="tour-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add New Tour</h4> 
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-default">

                <div class="panel-body">
                <form role="form" id ="form"  method="post" enctype="multipart/form-data">
                    <input type='hidden' class="form-control" name='tour_id' id="tour_id">
                  
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Category</label>
                            <input type="text" class="form-control" id="tour_category" name="tour_category" placeholder="Enter Category " required="">
                        </div>
                        <div class="form-group">
                            <label for="">Tour Title</label>
                            <input type="text" class="form-control" id="tour_title" name="tour_title" placeholder="Enter Testimonial Name" required="">
                        </div>
                         <div class="form-group">
                            <label for="">Destination</label>
                            <input type="text" class="form-control" id="tour_destination" name="tour_destination" placeholder="Enter Destination" required="">
                        </div>
                         <div class="form-group">
                            <label for="">Duration</label>
                            <input type="text" class="form-control" id="tour_duration" name="tour_duration" placeholder="Enter Duration" required="">
                        </div>
                         <div class="form-group">
                            <label for="">Price</label>
                            <input type="text" class="form-control" id="tour_price" name="tour_price" placeholder="Enter Price" required="">
                        </div>
                         <div class="form-group">
                            <label for="">Description</label>
                            <textarea type="text" class="form-control" id="tour_description" name="tour_description" placeholder="Enter Description" required=""></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Longitude</label>
                            <input type="text" class="form-control" id="tour_longitude" name="tour_longitude" placeholder="Enter longitude" required="">
                        </div>
 <div class="form-group">
                            <label for="">Latitude</label>
                            <input type="text" class="form-control" id="tour_latitude" name="tour_latitude" placeholder="Enter latitude" required="">
                        </div>
                       
	                     <div class="form-group">
		                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit </button>
		                     <button type="reset" id="reset"  class="btn btn-default">Reset </button>
	                     </div>
                    </div>
                </form>

                </div>
                </div>
              </div><!-- /.col-->
            </div><!-- /.row -->
          </div>
        </div>
      </div>
    </div>
  </div>

 <?php require_once('footer.php');?>                               
<script type="text/javascript"></script>
<script type="text/javascript" src="js/Tours.js"></script>
<script>
  $(document).ready(function(){
   		Tours.init();
    });

</script>
 
<style >
    .pad-left{
       padding-left: 1px !important;
    }
</style>