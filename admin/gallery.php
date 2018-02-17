<?php 
	require_once('header.php');
?>

<link rel="stylesheet" type="text/css" href="css/chekbox.css">
      <div class="page-header">
              <h1>
                Image Gallery
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
              <button class='btn btn-success btn-round btn-add-photo'><i class='material-icons'></i> Add New<div class='ripple-container'></div></button><br><br>
                <div class="tools">
                    <a href="" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="" class="reload"></a>
                    <a href="" class="remove"></a>
                </div>
            </div>

            <div class="portlet-body">

               <div class="row text-center text-lg-left image-div" style="margin-left: unset !important;margin-right: unset !important;">
                 
                   </div>

            </div>

        </div>
    </div>
</div>
  <div class="modal fade" id="gallery-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add New Image</h4> 
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
                            <label for="">Title</label>
                            <input type="text" class="form-control" id="image_title" name="image_title" placeholder="Title" required="">
                        </div>
                        <div class="form-group">
							<div class="form-group">
								 <label for="">Image</label>
		                         <input type="file" class="form-control" id="image" name="image" placeholder="Select Image" required="">
                                <div class="thumbnail gallery-img-class" style="display: none;border: none !important;">
                                  <img src="#" style="width:50%;">
                              </div>
		                        
		                    </div>
	                    </div>  
                      <div class="form-group">
                 <label for="">Description</label>
                                <textarea class="form-control" id="image_description" name="image_description" rows=5 required=""></textarea>
                       
                        </div>
                      </div>                      
                        <!-- <div class="form-group div-toggle-btn">
                                                  <input type="checkbox" data-on="Active" data-off="Inactive" name="status" 
                                                 data-width="100" data-toggle="toggle" id="toggle-status" value=1>
                                              </div> -->
	                     <div class="form-group">
		                    <button type="submit" name="submit" id="submit" class="btn btn-gallery">Submit </button>
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
<script type="text/javascript" src="js/Gallery.js"></script>
<script>
  $(document).ready(function(){
   		Gallery.init();
    });

</script>
 
<style type="text/css">
    .pad-left{
       padding-left: 1px !important;
    }
</style>