<?php

 $_GET['r']='index';  
    include('inc/inc.con.php');
        $obj = new db();
		$obj->connect();
date_default_timezone_set("Asia/Kolkata");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Northern Travels- Payments</title>
	<!--== META TAGS ==-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Northern Travels Website">
    <meta name="keywords" content="Travel, Srinagar, Ladakh, Leh, Pahalgam, J&K">
    <meta name="author" content="Northern Travels">
	<!-- FAV ICON -->
	<link rel="shortcut icon" href="images/fav.ico">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:400,500,700" rel="stylesheet">
	<!-- FONT-AWESOME ICON CSS -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!--== ALL CSS FILES ==-->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/materialize.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/mob.css">
	<link rel="stylesheet" href="css/animate.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
  
	<![endif]-->
	 <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
<style>
/* [class~=inner_banner_4] {
    background: url(<?php echo $firstimg;?>) no-repeat center center;
} */
</style>
  <style>
       #map {
        height: 400px;
        width: 100%;
       }
.section-padding {
    padding: 70px 0px;
}
.footer-area {
    background: #1E1E1E;
    padding: 30px 0px;
}
.footer-text h6 {
    text-transform: capitalize;
    color: #fff;
    font-weight: 300;
    font-size: 16px;
}
.paymentrow .sercol {
    min-height: 100px;
}

.infotitle {
    font-size: 16px;
    margin: 0px;
    font-weight: bold;
}

.paymentrow .sercol img {
    margin-right: auto;
    margin-left: auto;
    display: block;
}

.fifty {
    width: 70%;
}

.mt20 {
    margin-top: 20px;
}

.mb10 {
    margin-bottom: 10px;
}
.sercol {
   
    background: #fbfbfb;
    -webkit-box-shadow: 2px 3px 6px #ccc;
    box-shadow: 2px 3px 6px #ccc;
    border-bottom: 2px solid #f5f5f5;
    border: 1px solid #ddd;
}
.sercol {
    padding: 15px;
   
    min-height: 150px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -ms-border-radius: 4px;
    -o-border-radius: 4px;
    border-radius: 4px;
    min-height: 180px;
}

.text-center {
    text-align: center;
}
a {
    color: #337ab7;
    text-decoration: none;
        font-size: 13px;
}
.md-heading {
    background: #19b5fe;
    color: #ffffff;
    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
    font-size: 16px;
    text-align: center;
    margin: 0px;
    padding: 15px 0px;
    position: relative;
    -webkit-border-radius: 3px 3px 0 0;
    -moz-border-radius: 3px 3px 0 0;
    -ms-border-radius: 3px 3px 0 0;
    -o-border-radius: 3px 3px 0 0;
    border-radius: 3px 3px 0 0;
}
.closer {
    position: absolute;
    right: -10px;
    height: 30px;
    width: 30px;
    background: #000000;
    color: #ffffff;
    top: -10px;
    padding: 6px;
    cursor: pointer;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    border: 1px solid;
    z-index: 1;
}
.paymodal .md-inputdiv input, .paymodal .md-inputdiv textarea {
    width: 66%;
}
 .md-inputdiv input, .md-inputdiv textarea, .md-close, .md-submit, .closer, .packbox, .box, .done, #detailslider, .details_tab_panel, .inputdiv input, .inputdiv textarea, .mcontainer, .logoholder, .formholder, .m-form>div select, .m-form>div input, .innerholder, .room, .mytextarea, .smimg {
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    border-radius: 3px;
    overflow: hidden;
}

.paymodal {
    width: 100%;
    max-width: 1000px;
}
.md-inputdiv input, .md-inputdiv textarea {
    width: 77%;
    border: 1px solid #dddddd;
    height: 35px;
    padding: 7px 15px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    vertical-align: text-top;
}
.md-inputdiv input, .md-inputdiv textarea {
    width: 77%;
    border: 1px solid #dddddd;
    height: 35px;
    padding: 7px 15px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    vertical-align: text-top;
}
.paymodal .md-inputdiv label {
    width: 30%;
    text-align: left;
}
label {
    border: 0;
    font-size: 100%;
    font-family: 'Open Sans', sans-serif;
    margin: 0;
    padding: 0;
    font-size: 13px;
}

.md-inputdiv label {
    width: 20%;
    display: inline-block;
}

.vab {
    vertical-align: middle;
}

label {
    font-weight: normal;
}

button, input, select, textarea {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
    margin-bottom: 5px;
}


select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: url(images/caret.png) !important;
    background-position: 94%;
    background-size: 12px;
    background-repeat: no-repeat;
}
.md-submit {
    background: #30B945;
    color: #ffffff;
    padding: 4px 12px;
    border: 0;
    position: absolute;
    right: 10px;
    bottom: -35px;
}
.md-close {
        background: #19b5fe;
    color: #ffffff;
    padding: 5px 13px;
    margin-right: 85px;
}
    </style>


</head>
<body onload="initialize()">
<!-- Preloader -->
	<div id="preloader">
		<div id="status">&nbsp;</div>
	</div>

	<!--====== MOBILE MENU ==========-->
	<section class="mob-top">
		<div class="mob-menu">
			<div class="mob-head-left"> <img src="assets/images/logo.png"  style="width: 150px;" alt=""> </div>
			<div class="mob-head-right"> <a href="#"><i class="fa fa-bars mob-menu-icon" aria-hidden="true"></i></a> <a href="#" class="btn-close-menu"><i class="fa fa-times" aria-hidden="true"></i></a>
				<div class="mob-menu-slide">
					<h4>Home</h4>
					
				</div>
			</div>
		</div>
	</section>
	<!--====== END MOBILE MENU ==========-->
	<!--====== TOP HEADER ==========-->
	<section>
		<div class="rows head" data-spy="affix" data-offset-top="120">
			<div class="container" style="padding-top: 5px;padding-bottom: 5px;">
				<div>
					<!--====== BRANDING LOGO ==========-->
					<div class="col-md-4 col-sm-12 col-xs-12 head_left">
						<a href="index.php"><img src="assets/images/logo.png" style="width: 150px;" alt="" /> </a>
					</div>
					<!--====== HELP LINE & EMAIL ID ==========-->
					<div class="col-md-8 col-sm-12 col-xs-12 head_right head_right_all" style="padding-top: 6px;">
						<ul>
							<!--li><a href="#">Help Line: +101-1231-1231</a> </li>
							<li><a href="#">Email: contact@worldtours.com</a> </li-->
							<li>
								<a class='dropdown-button waves-effect waves-light profile-btn' href='#!' data-activates='myacc1'><i class="fa fa-home" aria-hidden="true"></i> Home</a>
								<!-- Dropdown Structure -->
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== NAVIGATION MENU ==========-->	

		
	<!--====== BANNER ==========-->
	
	<!--====== TOUR DETAILS - BOOKING ==========-->

	<!--====== TOUR DETAILS ==========-->
	<section>
		<div class="rows inn-page-bg com-colo">
			<div class="container inn-page-con-bg tb-space">
				<div class="col-md-9">
                                        <img src="images/payumoney_logo.png">
					<!--====== TOUR TITLE ==========-->
					<div class="tour_head"><h3> Payment status</h3></div>
					<!--====== TOUR DESCRIPTION ==========-->
					<div class="tour_head1">
						
						<p> 
<?php
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$salt="Iw41AfanGq";

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {
           	                $id=$obj->get_max('tbl_online_payments','id');
				$query="insert into tbl_online_payments values(:id,:txnid,:firstname,:email,:phone,:amount,:transdate)";
				$param=array('id'=>$id,'txnid'=>$txnid,'firstname'=>$firstname,'email'=>$email,'phone'=>$phone,'amount'=>$amount,'transdate'=>date('d-m-Y h:i a'));
				$inserted=$obj->insert($query,$param);
				if($inserted) {
          echo "Thank You. Your order status is ". $status .".<br>";
          echo "Your Transaction ID for this transaction is ".$txnid.".<br>";
          echo "We have received a payment of Rs. " . $amount . ". Our account department will contact you soon.<br>";
           }
else{
 echo "Thank You. Your order status is ". $status .".<br>";
          echo "Your Transaction ID for this transaction is ".$txnid.".<br>";
          echo "We have received a payment of Rs. " . $amount . ". Our account department will contact you soon.<br>";
}
		   }         
?>	


					</div>
</div>
				<div class="col-md-3 tour_r">
					<!--====== SPECIAL OFFERS ==========-->
					<!-- <div class="tour_right tour_offer">
						<div class="band1"><img src="images/offer.png" alt="" /> </div>
						<p>Special Offer</p>
						<h4>Price ????<span class="n-td">
								span class="n-td-1">$800</span
								
							</h4> <a href="http://northern-travels.com/" class="link-btn">Place Enquiry</a> 
					</div> -->
					<!--====== TRIP INFORMATION ==========-->
				<!-- 	<div class="tour_right tour_incl tour-ri-com">
					<h3>Trip Information</h3>
					<ul>
						<li>Location : </li>
						<li>Duration: </li>
						<li>Price: </li>
						
					</ul>
				</div> -->
					
					<div class="tour_right head_right tour_help tour-ri-com">
						<h3>Help & Support</h3>
						<div class="tour_help_1">
							<h4 class="tour_help_1_call">Call Us Now</h4>
							<h4><i class="fa fa-phone" aria-hidden="true"></i> +91-9082528859  +91-9622516757</h4> </div>
					</div>
					<!--====== PUPULAR TOUR PACKAGES ==========-->
					<div class="tour_right tour_rela tour-ri-com">
						<h3>Popular Packages</h3>
                                        <?php
                                               $sql = "Select  tbl_tour.tour_id,tbl_tour.tour_title,  tbl_tour.tour_destination,  tbl_tour.tour_price,  tour_images.image_path From  tbl_tour Inner Join  tour_images    On tbl_tour.tour_id = tour_images.tour_id group by tour_images.tour_id ORDER BY RAND() LIMIT 4";
		                               $param = array('tour_id'=> $tour_id);
		                               $res = $obj->getRows($sql,$param);
                                                    foreach ($res as $place) {
                                         ?>
						<div class="tour_rela_1"> <img src="<?php echo $place['image_path'];?>" alt="<?php echo $place['tour_title'];?>" />
							<h4><?php echo $place['tour_title'];?></h4>
							<p><?php echo $place['tour_destination'];?></p> <a href="tour-details.php?id=<?php echo $place['tour_id'];?>" target="_blank" class="link-btn">View this Package</a> </div>
				        <?php
                                                }
                                         ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== TIPS BEFORE TRAVEL ==========-->
	

	
    <footer class="footer-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="footer-text">
                        <h6>Copyrights &copy; <?php echo date('Y');?> Northern Travels. All Rights Reserved</h6>
                    </div>
                </div>
            </div>
        </div>
    </footer>
	
	<!--========= Scripts ===========-->
	<script src="js/jquery-latest.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/wow.min.js"></script>
	<!--script src="js/materialize.min.js"></script-->
	<script src="js/custom.js"></script>

</body>

</html>