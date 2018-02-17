<?php
    $_GET['r']='index';  
    
    include('inc/functions.php');
    //include('../admin/inc/gallery.php');
    $places=listPlaces();
    $clients=listClients();
    $gallery=listGallery();
    $testimonials=listTestimonials();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Northern Travels Website">
    <meta name="keywords" content="Travel, Srinagar, Ladakh, Leh, Pahalgam, J&K">
    <meta name="author" content="Northern Travels">
    <!-- PAGE TITLE -->
    <title>Northern Travels</title>
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- ALL GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700,800,900" rel="stylesheet">
    <!-- FONT AWESOME CSS -->
    <link rel="stylesheet" href="assets/fonts/linear-fonts.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.css">
    <!-- OWL CAROSEL CSS -->
    <link rel="stylesheet" href="assets/owlcarousel/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.css">
    <!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- ANIMATE CSS -->
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <!-- MAIN STYLE CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- RESPONSIVE CSS -->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 <style>
#status {
    margin-top: -100px;
}


#status {
    margin-right: 0;
}

#status {
    margin-bottom: 0;
}

#status {
    margin-left: -1.041666667in;
}

#status {
    background-position: center;
}

#status {
    background-repeat: no-repeat;
}

#status {
    background-image: url(../images/preloader.gif);
}

#status {
    top: 50%;
}

#status {
    left: 50%;
}

#status {
    position: absolute;
}

#status {
    height: 12.5pc;
}

#status {
    width: 200px;
}
</style>
</head>

<body>
    <!-- START PRELOADER AREA-->
    <div class="preloader-area">
        <div class="spinner">
            <!--i class="fa fa-plane" aria-hidden="true"></i-->
             <div id="status">&nbsp;</div>
            <!--h2>Northern Travels</h2-->
        </div>
    </div>
    <!-- END PRELOADER AREA -->

    <!-- START HOMEPAGE DESIGN AREA -->
    <header id="home" class="welcome-area">
        <div class="header-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <!-- START LOGO DESIGN AREA -->
                        <div class="logo">
                            <a href="index.html">
                                <img src="assets/images/logo.png" alt="Northern Travels">
                            </a>
                        </div>
                        <!-- END LOGO DESIGN AREA -->
                    </div>
                    <div class="col-md-9">
                        <!-- START MENU DESIGN AREA -->
                        <div class="mainmenu">
                            <div class="navbar navbar-nobg">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="navbar-collapse collapse">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="active"><a class="smoth-scroll" href="#home">Home <div class="ripple-wrapper"></div></a>
                                        </li>
                                         <li><a class="smoth-scroll" href="payment.php">Make Payment</a>
                                        </li>
                                        <li><a class="smoth-scroll" href="#place">Packages</a>
                                        </li>
                                        <li><a class="smoth-scroll" href="#About">About</a>
                                        </li>
                                        <li><a class="smoth-scroll" href="#gallery">Gallery</a>
                                        </li>
                                        <li><a class="smoth-scroll" href="#testimonial">Testimonials</a>
                                        </li>
                                        <li><a class="smoth-scroll" href="#team">Our Team</a>
                                        </li>
                                        <li><a class="smoth-scroll" href="#contact">Contact us</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- END MENU DESIGN AREA -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- / END HOMEPAGE DESIGN AREA -->

    <!-- START HEADER DESIGN AREA -->
    <section class="welcome-image-area" data-stellar-background-ratio="0.6">
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header-text text-center">
                                <h1>Enjoy vacation with <span>Northern Travels</span></h1>
                                <p>Travel to the any corner of the world, without going around in circles.</p>
                                <a href="#myModal" role="button" data-toggle="modal">Book a tour</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / END HEADER DESIGN AREA -->


    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- START FORM DESIGN AREA -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4>Share you details and rest easy !</h4>
                    <h5>Our Travel Planners will get in touch with you shortly</h5>
                    <h5>OR call us at +91-9082528859 / +91-9622516757
</h5>
                </div>
                <div class="modal-body">
                    <div class="contact-form">
                        <form id="enquiry" >
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" required="required">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="number" name="contact" class="form-control" id="contact" placeholder="Enter Contact Number" required="required">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required="required">
                                </div>
                             
                                <div class="form-group col-md-12">
                                    <input type="number" name="noofpersons" class="form-control" id="noofpersons" placeholder="Number of Persons" required="required">
                                </div>
                               
                                
                                <div class="form-group col-md-12">
                                    <input type="number" name="noofdays" class="form-control" id="noofdays" placeholder="Number of Days ?" required="required">
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <textarea name="message" id="message" class="form-control" placeholder="Your Message" rows="4" required></textarea>
                                </div>

                                <div class="form-group col-md-12">
                                   <input type="checkbox" name="authorize" id="authorize"  required="required" height="10px" width="10px"> I authorize Northern Travels to contact me <br>
                               </div>
                                
                                 <div class="form-group col-md-12">
                                    <input type="submit" name="submit" id="submit" value="Plan a Holiday">
                                </div>
                            </div>

                        </form>

                    </div>
                </div><!-- 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">close</button>
                </div> -->
            </div>
            <!-- / END FORM DESIGN AREA -->
        </div>
    </div>




    <!-- START TOUR PLACE DESIGN AREA -->
    <section id="place" class="tour-places section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Popular tour Packages</h2>
                    </div>
                </div>
            </div>
            <div class="tour-list">
                <!-- START SINGLE TOUR PLACE DESIGN AREA -->
                <?php
                $i=0;
                foreach ($places as $place) {
                ?>
                <a href="tour-details.php?id=<?php echo $place['tour_id'];?>" target="_blank">
                <div class="single-place" >
                    <img src="<?php echo $place['image_path'];?>" alt="">
                    <div class="tour-des">
                        <h2 ><?php echo $place['tour_title'];?></h2>
                        <h3><?php echo $place['tour_destination'];?></h3>
                        <h4><?php echo $place['tour_price'];?><!-- <span>$0000</span> --></h4>
                    </div>
                </div>
            </a>
                <?php
                $i++;
                }
                ?>
                <!-- / END SINGLE TOUR PLACE DESIGN AREA -->
                
            </div>
        </div>
    </section>
    <!-- / END  TOUR PLACE DESIGN AREA -->


    <!-- START COMPANY DESIGN AREA -->
    <section class="company-logo-area">
        <div class="container">
            <div class="row">
                <div class="company-logo-list">
                    <?php
                $i=0;
                foreach ($clients as $client) {
                ?>
                    <div class="single-company-logo">
                        <img src="<?php echo $client['logo'];?>" alt=" <?php echo $client['name'];?>">
                    </div>
                     <?php
                $i++;
                }
                ?>
                   
                </div>
            </div>
        </div>
    </section>
    <!-- / END COMPANY DESIGN AREA -->

    <!-- START ABOUT DESIGN AREA -->
    <section id="About" class="about-us-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title text-center">
                        <h2>who we are?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- START ABOUT IMAGE DESIGN AREA -->
                <div class="col-md-6 wow fadeInLeft" data-wow-delay=".2s">
                    <div class="about-image">
                        <img src="assets/images/2img.jpg" alt="" class="img-responsive">
                    </div>
                </div>
                <!-- / END ABOUT IMAGE DESIGN AREA -->
                <!-- START ABOUT TEXT DESIGN AREA -->
                <div class="col-md-6">
                    <div class="about-text">
                        
                        <p class="wow fadeInDown" data-wow-delay=".4s"><h2 class="wow fadeInDown" data-wow-delay=".2s">We are Northern Travels</h2> based in Srinagar Kashmir running a travel company since from last 25+ Years, we Northern Travels concern about our clients satisfaction with our maximum efforts and quality services, So many travel companies are around you but Northern Travels will make you sure to have a great tour and comforts, we Norther Travels focus on our services as our ground operation team is alert 24 X 7. to serve our guests we Northern Travels have a record in an entire travel industry for the protection and security of our clients, prior starting the tour our special team GOM (Ground Operational Management) give complete guidance to our travelers for weather update no doubt online you can check the weather but the Kashmir weather is unpredictable for online sites Northern travels guide to their clients about their carrying of clothes essential carrying items all those duties has been assigned to our special team GOM. Northern travels is a New Brand which travels Guests in a New Taste which you had not traveled before.</p>
                        <!--<a href="#" class="read-more wow fadeInDown" data-wow-delay=".6s">Learn more</a>-->
                    </div>
                </div>
                <!-- / END ABOUT TEXT DESIGN AREA -->
            </div>
        </div>
    </section>
    <!-- / END ABOUT DESIGN AREA -->

    <!-- START SERVICE DESIGN AREA -->
    <section id="service" class="service-area section-padding">
        <div class="container">
            <div class="row">
                <!-- START SINGLE SERVICE DESIGN AREA -->
                <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInDown" data-wow-delay=".2s">
                    <div class="single-service">
                        <div class="service-icon"><i class="fa fa-bookmark" aria-hidden="true"></i>
                        </div>
                        <h4>Personalized matching</h4>
                        <p>You can get a personalized requirements directly from our sales & Marketing team as they are using a high technology software where from the quotation will get in seconds as per your personalized matching's. </p>
                    </div>
                </div>
                <!-- / END SINGLE SERVICE DESIGN AREA -->
                <!-- START SINGLE SERVICE DESIGN AREA -->
                <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInDown" data-wow-delay=".4s">
                    <div class="single-service">
                        <div class="service-icon"><i class="fa fa-cubes" aria-hidden="true"></i>
                        </div>
                        <h4>wide variety of destinations</h4>
                        <p>We have a wide variety of destination for Kashmir -Laddakh and also pilgrimage tours like Mata Vaishno devi & Amarnath Yatra. </p>
                    </div>
                </div>
                <!-- / END SINGLE SERVICE DESIGN AREA -->
                <!-- START SINGLE SERVICE DESIGN AREA -->
                <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInDown" data-wow-delay=".6s">
                    <div class="single-service">
                        <div class="service-icon"><i class="fa fa-archive" aria-hidden="true"></i>
                        </div>
                        <h4>highly qualified service</h4>
                        <p>We are providing a high quality of services which really suits our travels reputation Northern travels always providing quality services to their clients.  </p>
                    </div>
                </div>
                 <div style="clear:both"></div>
                <!-- / END SINGLE SERVICE DESIGN AREA -->
                <!-- START SINGLE SERVICE DESIGN AREA -->
                <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInDown" data-wow-delay=".8s">
                    <div class="single-service">
                        <div class="service-icon"><i class="fa fa-bar-chart" aria-hidden="true"></i>
                        </div>
                        <h4>Handpicked Hotels</h4>
                        <p>In our online software we have variety of hotels once who will you select same will be delivered to you.  
</p>
                    </div>
                </div>
                <!-- / END SINGLE SERVICE DESIGN AREA -->
                <!-- START SINGLE SERVICE DESIGN AREA -->
                <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInDown" data-wow-delay="1s">
                    <div class="single-service">
                        <div class="service-icon"><i class="fa fa-umbrella" aria-hidden="true"></i>
                        </div>
                        <h4>Best Price Guarantee</h4>
                        <p>Regarding prices we have a very good name in market for our b2b suppliers, you will definitely book your tour package with us after checking our rates we are providing 4 star hotels in 2 star rates that's why Northern Travels is known as King of Kashmir.  
</p>
                    </div>
                </div>
                <!-- / END SINGLE SERVICE DESIGN AREA -->
                <!-- START SINGLE SERVICE DESIGN AREA -->
                <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInDown" data-wow-delay="1.2s">
                    <div class="single-service">
                        <div class="service-icon"><i class="fa fa-users" aria-hidden="true"></i>
                        </div>
                        <h4>24/7 support</h4>
                        <p> Our services support is 100% strong we have too many successful story of clients in tough situations in Kashmir like during flood's or political circumstances etc.  
</p>
                    </div>
                </div>
                <!-- / END SINGLE SERVICE DESIGN AREA -->
            </div>
        </div>
    </section>
    <!-- / END SERVICE DESIGN AREA -->



    <!-- VIDEO BACKGROUND DESIGN AREA -->
    <section class="video-area" data-stellar-background-ratio="0.6">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="video-area-text text-center wow bounceIn">
                        
<iframe width="560" height="400" src="https://www.youtube.com/embed/uJrXLQpY3dY" frameborder="0" gesture="media" allowfullscreen></iframe>
                        
                        </a>

                        <h2>Travelling Highlights</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / END VIDEO BACKGROUND DESIGN AREA -->

    <!-- START PLACE DESIGN AREA -->
    <section id="gallery" class="work section-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title text-center">
                        <h2>tour gallery</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- START SINGLE WORK DESIGN AREA -->
                 <?php
                $i=0;
                foreach ($gallery as $image) {
                ?>
                <div class="col-md-4 col-sm-6">
                    <div class="project-item">
                        <a href="<?php echo $image['image_path'];?>" class="work-popup">
                            <img src="<?php echo $image['image_path'];?>" class="img-responsive" alt="<?php echo $image['image_title'];?>" style='height:250px;'>
                            <div class="project-overlay">
                                <div class="project-info">
                                    <h2 class="wow fadeInUp">
                                       <?php echo $image['image_title'];?>
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
                    $i++;
                 }
                ?>
                <!-- END SINGLE WORK DESIGN AREA -->
                
            </div>
        </div>
    </section>
    <!-- / END PLACE WORK DESIGN AREA -->




    <!-- START TESTIMONIAL DESIGN AREA -->
    <section id="testimonial" class="testimonial-area section-padding" data-stellar-background-ratio="0.6">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Happy Clients</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="testimonial-list">
                        <!-- START SINGLE TESTIMONIAL DESIGN AREA -->
                        <?php
                         foreach ($testimonials as $testimonial) {
                            
                         ?>
                        <div class="single-testimonial">
                            <div class="single-testi-des">
                                <p><?php echo $testimonial['description'];?></p>
                            </div>
                            <div class="testi-name">
                                <h2><?php echo $testimonial['name'];?></h2>
                                <h3><?php echo $testimonial['profession'];?></h3>
                            </div>
                        </div>
                        <?php
                          }
                         ?>
                        <!-- / END SINGLE TESTIMONIAL DESIGN AREA -->
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / END TESTIMONIAL DESIGN AREA -->

    <!-- START TEAM DESIGN AREA -->
    <section id="team" class="team-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Our Team</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- START SINGLE TEAM DESIGN AREA -->
                <div class="col-md-3 col-sm-3">
                    <div class="single-team">
                        <div class="team-image">
                            <img src="assets/images/team/def.png" class="img-responsive">
                        </div>
                        <div class="team-description">
                            <h4>Mr. Amir Habib </h4>
                            <h5>SR- Sales & Marketing consultant</h5>
                            <!--<p>I’d like to send you a sincere "thank you" for all of your assistance during my recent trip to Colorado.</p>-->
                        </div>
                    </div>
                </div>
                <!-- / END SINGLE TEAM DESIGN AREA -->
                <!-- START SINGLE TEAM DESIGN AREA -->
                <div class="col-md-3 col-sm-3">
                    <div class="single-team">
                        <div class="team-image">
                            <img src="assets/images/team/def.png" class="img-responsive">
                        </div>
                        <div class="team-description">
                            <h4>Mr. Ravi Kumar </h4>
                            <h5>SR Sales & Marketing B2B</h5>
                                                   </div>
                    </div>
                </div>
                <!-- / END SINGLE TEAM DESIGN AREA -->
                <!-- START SINGLE TEAM DESIGN AREA -->
                <div class="col-md-3 col-sm-3">
                    <div class="single-team">
                        <div class="team-image">
                            <img src="assets/images/team/def.png" class="img-responsive">
                        </div>
                        <div class="team-description">
                            <h4>Mr. Subhash Pandey </h4>
                            <h5> B2B Sales Operator</h5>
                            
                        </div>
                    </div>
                </div>

<div class="col-md-3 col-sm-3">
                    <div class="single-team">
                        <div class="team-image">
                            <img src="assets/images/team/def.png" class="img-responsive">
                        </div>
                        <div class="team-description">
                            <h4>Miss. Sabreen </h4>
                            <h5> Jr- Sales executive B2C </h5>
                            
                        </div>
                    </div>
                </div>
                <div style="clear:both"></div>
<div class="col-md-3 col-sm-3">
                    <div class="single-team">
                        <div class="team-image">
                            <img src="assets/images/team/def.png" class="img-responsive">
                        </div>
                        <div class="team-description">
                            <h4>Miss. Tabinda </h4>
                            <h5> Jr- Sales executive B2C</h5>
                            
                        </div>
                    </div>
                </div>
<div class="col-md-3 col-sm-3">
                    <div class="single-team">
                        <div class="team-image">
                            <img src="assets/images/team/def.png" class="img-responsive">
                        </div>
                        <div class="team-description">
                            <h4>Miss. Saima </h4>
                            <h5> Jr. Accounts</h5>
                            
                        </div>
                    </div>
                </div>
<div class="col-md-3 col-sm-3">
                    <div class="single-team">
                        <div class="team-image">
                            <img src="assets/images/team/def.png" class="img-responsive">
                        </div>
                        <div class="team-description">
                            <h4>Mr. Umar</h4>
                            <h5>  Sr-Operation Head </h5>
                            
                        </div>
                    </div>
                </div>
<div class="col-md-3 col-sm-3">
                    <div class="single-team">
                        <div class="team-image">
                            <img src="assets/images/team/def.png" class="img-responsive">
                        </div>
                        <div class="team-description">
                            <h4>Miss. Nahida </h4>
                            <h5> Sr-Operation & GOM Specialist</h5>
                            
                        </div>
                    </div>
                </div>

                <!-- / END SINGLE TEAM DESIGN AREA -->
            </div>
        </div>
    </section>
    <!-- / END TEAM DESIGN AREA -->


    <!-- START CALL TO ACTION DESIGN AREA -->
    <section id="download" class="call-to-area" data-stellar-background-ratio="0.6">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="call-to-area-text text-center">
                        <h2>are you still intarested to tour?</h2>
                        <p>We offer a wide range of procedures to help you get the perfect smile</p>
                        <a href="#myModal" role="button" data-toggle="modal">book a tour!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / END CALL TO ACTION DESIGN AREA -->

    <!-- START CONTACT DESIGN AREA -->
    <section id="contact" class="contact-area section-padding" data-stellar-background-ratio="0.6">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>questions?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="single-contact wow fadeInUp" data-wow-delay=".2s">
                        <div class="contact-icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <h2>our head office:</h2>
                        <p>HO: Iqbal colony Shalteng Shrinagar, Kashmir 190010 , +91-9082528859 / +91-9622516757</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="single-contact wow fadeInUp" data-wow-delay=".4s">
                        <div class="contact-icon">
                            <i class="fa fa-map"></i>
                        </div>
                        <h2>branch office 1:</h2>
                        <p>BO : Mira Bhayander Road, Mumbai, Maharashtra 401107,+91-9082528859</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="single-contact wow fadeInUp" data-wow-delay=".6s">
                        <div class="contact-icon">
                            <i class="fa fa-map"></i>
                        </div>
                        <h2>branch office 2:</h2>
                        <p>BO: Hidayat Ullah Road ,  Pune college, Pune 411004, +91-7889879894</p>
                    </div>
                </div>
            </div>
            <div class="row contact-form-design-area">
                <div class="col-md-12">
                    <!-- START CONTACT FORM DESIGN AREA -->
                    <div class="contact-form">
                        <form id="contact-form" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input type="text" name="name" class="form-control" id="first-name" placeholder="Name" required="required">
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required="required">
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" name="subject" class="form-control" id="subject" placeholder="subject">
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea rows="6" name="message" class="form-control" id="description" placeholder="Your Message" required="required"></textarea>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="actions wow fadeInUp" data-wow-delay=".4s">
                                        <input type="submit" value="send message" name="submit" id="submitButton" class="" title="Submit Your Message!">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- / END CONTACT FORM DESIGN AREA -->
                </div>
            </div>
        </div>
    </section>
    <!-- / END CONTACT DESIGN AREA -->

    <!-- START FOOTER DESIGN AREA -->
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
    <!-- / END CONTACT DETAILS DESIGN AREA -->

    <!-- START SCROOL UP DESIGN AREA -->
    <div class="scroll-to-up">
        <div class="scrollup">
            <span class="lnr lnr-chevron-up"></span>
        </div>
    </div>
    <!-- / END SCROOL UP DESIGN AREA -->




    <!-- LATEST JQUERY -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- OWL CAROUSEL JS  -->
    <script src="assets/owlcarousel/js/owl.carousel.min.js"></script>
    <!-- MAGNIFICANT JS -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- STEALLER JS -->
    <script src="assets/js/jquery.stellar.min.js"></script>
    <!-- WOW JS -->
    <script src="assets/js/wow.min.js"></script>
    <!-- CONTCAT FORM JS -->
    <script src="assets/js/form-contact.js"></script>
    <!-- scripts js -->
    <script src="assets/js/scripts.js"></script>
<script>
$(function(){
$("#myModal").modal('show');
});

$("#submit").click(function(){
$('#submit').prop('disabled', true);
if($("#name").val()=="")
       {
        alert("Please Enter valid Name.....!");
        $("#name").focus();
        return;
       }
if($("#contact").val()=="")
       {
        alert("Please Enter valid contact.....!");
        $("#contact").focus();
        return;
       }
if($("#email").val()=="")
       {
        alert("Please Enter valid email.....!");
        $("#email").focus();
        return;
       }
if($("#noofpersons").val()=="")
       {
        alert("Please Enter valid no of persons.....!");
        $("#noofpersons").focus();
        return;
       }
if($("#noofdays").val()=="")
       {
        alert("Please Enter valid no of days.....!");
        $("#noofdays").focus();
        return;
       }
 var $formData = $('#enquiry').serialize();
$formData+="&action=email";
        var $request = $.ajax({
                              url :'sendmail.php',
                              type: "POST",
                              data: $formData,
                              dataType: 'json',
                
                            });
                      $request.done(function(data) {
             
                  if (data.status) {                 
                     alert(data.msg);          
                       document.getElementById("enquiry").reset();
                     $("#myModal").modal('hide');
                  } else {
                        alert(data.msg);                 
                     }
              });
              $request.always(function(data) {
          console.log(data);
            $('#submit').prop('disabled', false);
              
              });
});
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/58c8be6c6b2ec15bd9fe8684/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>
</html>
