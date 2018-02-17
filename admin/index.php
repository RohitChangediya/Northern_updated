<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Northern Travels Admin | Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- css -->
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="assets/css/font-awesome.min1.css" type="text/css" media="all" />
<!--// css -->
<!-- font -->
<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- //font -->
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
</head>
<body>
	<div class="login">
		<?php
            if(isset($_GET['status']) && $_GET['status']=="invalid")
            {
        ?>
        	<div class="container">
                <div class="alert alert-warning alert-dismissable col-lg-8" role="alert" style="margin-left: 20%;text-align: center;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Warning ! </strong> <?=$_GET['msg'];?>
                </div>
            </div>
        <?php
        	}
        ?>
		<div class="main-agileits">
				<div class="form-w3agile">
					<h3>Login</h3>
					<form action="includes/login.php" method="post">
						<div class="key">
							<i class="fa fa-user" aria-hidden="true"></i>
							<input  type="text" name="user_name" required="" placeholder="User Name">
							<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="password" name="password" required="" placeholder="Password">
							<div class="clearfix"></div>
						</div>
						<input type="submit" value="Login">
					</form>
				</div>
			</div>
		</div>
		<!-- newsletter -->
	
	<!-- cart-js -->
	<script src="js/minicart.js"></script>
	<!-- //cart-js -->  
</body>
</html>