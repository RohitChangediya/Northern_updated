<?php
    $_GET['r']='index';  
    $tour_id=$_REQUEST['id'];
   

    
    include('inc/inc.con.php');
        $obj = new db();
		$obj->connect();
		$sql = "Select  * From  tbl_tour Where tour_id=:tour_id";
		$param = array('tour_id'=> $tour_id);
		$res = $obj->getRows($sql,$param);
                 $price=$res[0]['tour_price'];
                 $dest=$res[0]['tour_destination'];
                 $dur=$res[0]['tour_duration'];
$longitude=$res[0]['tour_longitude'];
$latitude=$res[0]['tour_latitude'];
	$sql1 = "Select  * From  tour_images Where tour_id=:tour_id";
		                            $param1 = array('tour_id'=> $tour_id);
		                            $res1 = $obj->getRows($sql1,$param1);
		                            $firstimg=$res1[0]['image_path'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Northern Travels- Tour</title>
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
<style>
[class~=inner_banner_4] {
    background: url(<?php echo $firstimg;?>) no-repeat center center;
}
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
			<div class="mob-head-right"> <a href="#"><i class="fa fa-bars mob-menu-icon" aria-hidden="true"></i></a> <a href="index.php" class="btn-close-menu"><i class="fa fa-times" aria-hidden="true"></i></a>
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
			<div class="container">
				<div>
					<!--====== BRANDING LOGO ==========-->
					<div class="col-md-4 col-sm-12 col-xs-12 head_left">
						<a href="index.php"><img src="assets/images/logo.png" style="width: 150px;" alt="" /> </a>
					</div>
					<!--====== HELP LINE & EMAIL ID ==========-->
					<div class="col-md-8 col-sm-12 col-xs-12 head_right head_right_all" style="padding-top: 24px;">
						<ul>
							<!--li><a href="#">Help Line: +101-1231-1231</a> </li>
							<li><a href="#">Email: contact@worldtours.com</a> </li-->
							<li>
								<a class='dropdown-button waves-effect waves-light profile-btn' href='index.php' data-activates='myacc1'><i class="fa fa-home" aria-hidden="true"></i> Home</a>
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
	<section>
		<div class="rows inner_banner inner_banner_4">
			<div class="container">
				<h2><span><?php echo $res[0]['tour_title'];?> - </span> <?php echo $res[0]['tour_category'];?></h2>
				<ul>
					<li><a href="index.php">Home</a>
					</li>
					<li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>
					<li><a href="tour-details.php?id=<?php echo $res[0]['tour_id'];?>" class="bread-acti"><?php echo $res[0]['tour_destination'];?></a>
					</li>
				</ul>
				<p>Book travel packages and enjoy your holidays with distinctive experience</p>
			</div>
		</div>
	</section>
	<!--====== TOUR DETAILS - BOOKING ==========-->
	<section>
		<div class="rows banner_book" id="inner-page-title">
			<div class="container">
				<div class="banner_book_1">
					<ul>
						<li class="dl1">Location : <?php echo $res[0]['tour_destination'];?></li>
						<li class="dl2">Price : <?php echo $res[0]['tour_price'];?></li>
						<li class="dl3">Duration : <?php echo $res[0]['tour_duration'];?></li>
						<!-- <li class="dl4"><a href="booking.html">Book Now</a> </li> -->
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!--====== TOUR DETAILS ==========-->
	<section>
		<div class="rows inn-page-bg com-colo">
			<div class="container inn-page-con-bg tb-space">
				<div class="col-md-9">
					<!--====== TOUR TITLE ==========-->
					<div class="tour_head">
						<h2><?php echo $res[0]['tour_title'];?> <span class="tour_star"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i></span><span class="tour_rat">4.5</span></h2> </div>
					<!--====== TOUR DESCRIPTION ==========-->
					<div class="tour_head1">
						<h3>Description</h3>
						<p><?php echo $res[0]['tour_description'];?></p>
					</div>
					<!--====== ROOMS: HOTEL BOOKING ==========-->
					<div class="tour_head1 hotel-book-room">
						<h3>Photo Gallery</h3>
						<div id="myCarousel1" class="carousel slide" data-ride="carousel">
							<!-- Indicators -->
							<ol class="carousel-indicators carousel-indicators-1">
								<?php

								    $sql = "Select  * From  tour_images Where tour_id=:tour_id";
		                            $param = array('tour_id'=> $tour_id);
		                            $res = $obj->getRows($sql,$param);
		                            $cntr=0;
		                            foreach ($res as $image) {
		                            ?>	
		                            
								<li data-target="#myCarousel1" data-slide-to="<?php echo $cntr;?>"><img src="<?php echo $image['image_path'];?>" alt="<?php echo $image['tour_id'];?>">
								</li>
								<?php
								         $cntr++;
								      }
								?>
							</ol>
							<!-- Wrapper for slides -->
							<div class="carousel-inner carousel-inner1" role="listbox">

                                  <?php
								        $cntr=0;
		                            foreach ($res as $image) {
		                            	if($cntr==0)
		                            		{?>
								<div class="item active"> <img src="<?php echo $image['image_path'];?>" alt="<?php echo $image['tour_id'];?>" width="460" height="345"> </div>
								<?php
								  }
								  else
								  	{?>
								<div class="item"> <img src="<?php echo $image['image_path'];?>" alt="<?php echo $image['tour_id'];?>" width="460" height="345"> </div>
                                 <?php 
                                   }
                                     $cntr++;
                                } // foreach

                                   ?>
								
							</div>
							<!-- Left and right controls -->
							<a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev"> <span><i class="fa fa-angle-left hotel-gal-arr" aria-hidden="true"></i></span> </a>
							<a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next"> <span><i class="fa fa-angle-right hotel-gal-arr hotel-gal-arr1" aria-hidden="true"></i></span> </a>
						</div>
					</div>
					<!--====== TOUR LOCATION ==========-->
					<div class="tour_head1 tout-map map-container">
						<h3>Location</h3>
  <div id="map"></div>
    <script>
      function initMap() {
        var uluru = {lat: <?php echo $latitude?>, lng: <?php echo $longitude?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
    
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDaRmuq0DovYYtVAx6IyGvrZsP1ukrEg9s&callback=initMap">
    </script>				
					</div>
					<!--====== ABOUT THE TOUR ==========-->
					<div class="tour_head1">
						<h3>About The Tour</h3>

						<?php
							 $sql = "Select  * From  tour_details Where tour_id=:tour_id group by tag";
		                            $param = array('tour_id'=> $tour_id);
		                            $res = $obj->getRows($sql,$param);
		                           
		                            $cntr=0;
		                            foreach ($res as $details) {
		                            ?>	
						<table>

							<tr>
								<th style="width: 35%;"><?php echo $details['tag'];?></th>
								<th class="event-res">Pax Minimum</th>
								<th class="event-res">April – Sep.</th>
								<th>Oct. – March</th>
							</tr>
							<tr>
								<td><?php echo $details['description'];?></td>
								<td class="event-res"><?php echo $details['pax'];?></td>
								<td class="event-res"><?php echo $details['april_sep'];?></td>
								<td><?php echo $details['oct_march'];?></td>
							</tr>
						</table> <br>
						<?php
					      }
						?>
					</div>
					<!--====== DURATION ==========-->
					<div class="tour_head1 l-info-pack-days days">
						<h3>Detailed Day Wise Itinerary</h3>
						<ul>
							<?php

								    $sql = "Select  * From  tour_itinerary Where tour_id=:tour_id";
		                            $param = array('tour_id'=> $tour_id);
		                            $res = $obj->getRows($sql,$param);
		                            $cntr=0;
		                            foreach ($res as $day) {
		                            ?>	
							<li class="l-info-pack-plac"> <i class="fa fa-clock-o" aria-hidden="true"></i>
								<h4><span>Day : <?php echo $day['day'];?>  </span> <?php echo $day['title'];?></h4>
								<p><?php echo $day['description'];?></p>
							</li>

							<?php
							  }

							  ?>
						</ul>
					</div>

					
				</div>
				<div class="col-md-3 tour_r">
					<!--====== SPECIAL OFFERS ==========-->
					<div class="tour_right tour_offer">
						<div class="band1"><img src="images/offer.png" alt="" /> </div>
						<p>Special Offer</p>
						<h4><?php echo $price;?><span class="n-td">
								<!--span class="n-td-1">$800</span-->
								
							</h4> <a href="booking.html" class="link-btn">Book Now</a> </div>
					<!--====== TRIP INFORMATION ==========-->
					<div class="tour_right tour_incl tour-ri-com">
						<h3>Trip Information</h3>
						<ul>
							<li>Location : <?php echo $dest;?></li>
							<li>Duration: <?php echo $dur;?></li>
							<li>Price: <?php echo $price;?></li>
							
						</ul>
					</div>
					<!--====== PACKAGE SHARE ==========-->
					<!--div class="tour_right head_right tour_social tour-ri-com">
						<h3>Share This Package</h3>
						<ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
							<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
							<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>
							<li><a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a> </li>
						</ul>
					</div-->
					<!--====== HELP PACKAGE ==========-->
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
	

	<!--====== FOOTER - COPYRIGHT ==========-->
	<!--section>
		<div class="rows copy">
			<div class="container">
				<p>Copyrights © <?php //echo date('Y');?> Northern Travels. All Rights Reserved</p>
			</div>
		</div>
	</section-->
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
	<!--section>
		<div class="icon-float">
			<ul>
				<li><a href="#" class="sh">1k <br> Share</a> </li>
				<li><a href="#" class="fb1"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
				<li><a href="#" class="gp1"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </li>
				<li><a href="#" class="tw1"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
				<li><a href="#" class="li1"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>
				<li><a href="#" class="wa1"><i class="fa fa-whatsapp" aria-hidden="true"></i></a> </li>
				<li><a href="#" class="sh1"><i class="fa fa-envelope-o" aria-hidden="true"></i></a> </li>
			</ul>
		</div>
	</section-->
	<!--========= Scripts ===========-->
	<script src="js/jquery-latest.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/materialize.min.js"></script>
	<script src="js/custom.js"></script>

</body>

</html>