<?php 
	require_once('header.php');
?>
<link rel="stylesheet" type="text/css" href="css/chekbox.css">
      <div class="page-header">
              <h1>
               Maintain Tour Itinerary
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
              <button class='btn btn-success btn-round btn-add-client'><i class='material-icons'></i> Add New Tour Itinerary<div class='ripple-container'></div></button><br><br>
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
                                  <th>Tour</th>
                                  <th>Day</th>
                                  <th>Title</th>
                                  <!-- <th>Description</th> -->
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
  <div class="modal fade" id="client-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add New Tour Itinerary</h4> 
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-default">

                <div class="panel-body">
                <form role="form" id ="form"  method="post" enctype="multipart/form-data">
                    <input type='hidden' class="form-control" name='id' id="id">
                  
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Select Tour Name</label>
                            <select type="text" class="form-control" id="tour_id" name="tour_id"  required="">
                            </select>
                        </div>
                       <div class="form-group">
                            <label for="">Day</label>
                            <input type="text" class="form-control" id="day" name="day" placeholder="Enter Testimonial Name" required="">
                        </div>
                         <div class="form-group">
                            <label for="">Title</label>
                           <input type="text" class="form-control" id="title" name="title" placeholder="Enter Testimonial Name" required="">
                        </div>
                         <div class="form-group">
                            <label for="">Description</label>
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter Testimonial Name" required=""></textarea>
                        </div>
                          <div class="form-group">
                 <label for="">Image</label>
                             <input type="file" class="form-control" id="image" name="image" placeholder="Select Image" required="">
                                <div class="thumbnail tour-img-class" style="display: none;border: none !important;">
                                  <img src="#" style="width:50%;">
                              </div>
                            
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
<script type="text/javascript" src="js/TourItinerary.js"></script>
<script>
  $(document).ready(function(){
   		TourItinerary.init();
    });

</script>
 
<style >
    .pad-left{
       padding-left: 1px !important;
    }
</style>