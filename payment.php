<?php
    $_GET['r']='index';  
    include('inc/inc.con.php');
        $obj = new db();
		$obj->connect();

// Merchant key here as provided by Payu
$MERCHANT_KEY = "eTs22MFM"; //rjQUPktU

// Merchant Salt as provided by Payu
$SALT = "Iw41AfanGq";//e5iIg1jwi8

// End point - change tohttps://test.payu.in https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
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

<body onload="submitPayuForm()">
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
	
	<!--====== TOUR DETAILS - BOOKING ==========-->

	<!--====== TOUR DETAILS ==========-->
	<section>
		<div class="rows inn-page-bg com-colo">
			<div class="container inn-page-con-bg tb-space">
				<div class="col-md-9">
					<!--====== TOUR TITLE ==========-->
					<div class="tour_head">
						<h2>Pay Online</h2> </div>
					<!--====== TOUR DESCRIPTION ==========-->
					<div class="tour_head1">
						
						<p> Click here to Pay using your Credit Card / Visa Debit Card, HDFC / ICICI /CITY Bank - Netbanking without adding.</p>
					</div>
					<?php if($formError) { ?>
	
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>
					<div class="col-xs-12 col-sm-6 col-md-6 mt50">
				<div class="mcol sercol text-center">
					<h4 class="infotitle">Click to Pay Through</h4>
					<img src="images/payumoney.png" class="fifty mt20 mb10">
					<div style="clear:both;"></div>
					<a data-toggle="modal" href="#ccvenuemodal">Click Here to Pay through PayUMoney</a>
					<div class="modal fade" id="ccvenuemodal" style="display: none;">
						<div class="modal-dialog paymodal">
							<div class="modal-content">
								<div class="modal-header md-heading">
									<button type="button" class="closer" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title">Pay through PayUMoney</h4>
								</div>
								<div class="modal-body">
									<p class="md-info">
										The Billing details of the customer have to be mandatory sent via the below mentioned parameters. Please note this has to be authentic data else the transaction would be rejected by the risk team.
									</p>
									<br>
									<h5>Billing information</h5>
									<div class="formwrap">
									
				<form action="<?php echo $action; ?>" method="post" name="payuForm">
				    
					
					
					  <div class="row">
				
					  <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
                      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      				  <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />		<input type="hidden" name="productinfo"  value="Tour Package">
				  
			
				
				<input type="hidden" name="surl" value="http://northern-travels.com/success.php">
				<!-- <input type="hidden" name="surl" value="https://northern-travels.com/payment/success.php"> -->
			 	
               <input type="hidden" name="furl" value="http://northern-travels.com/failure.php">
			 	<!-- <input type="hidden" name="furl" value="https://northern-travels.com/failure.php"> -->
			 <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
				
		     	<div class="col-xs-12 col-sm-6">
				<div class="md-inputdiv">
					<label for="" class="vab">Amount</label>
					<input type="text" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" placeholder="Amount" required="">
													
												   </div>
												</div>
				
				<div class="col-xs-12 col-sm-6">
													<div class="md-inputdiv">
														<label for="" class="vab">Billing Name</label>
														<input type="text" name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>"  placeholder="Bill Name" required="">
													
												   </div>
				</div>
				
				
				
				
				<div class="col-xs-12 col-sm-6">
													<div class="md-inputdiv">
														<label for="" class="vab">Billing Address</label>
														<input type="text" name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" placeholder="Bill Address" required="">
													
												   </div>
												</div>
		        
		       
			   
			   
			   <div class="col-xs-12 col-sm-6">
													<div class="md-inputdiv">
														<label for="" class="vab">Billing City</label>
														<input type="text" name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" placeholder="Bill City" required="">
													
												   </div>
			   
		        </div>
				
				
				
				
				<div class="col-xs-12 col-sm-6">
													<div class="md-inputdiv">
														<label for="" class="vab">Billing State</label>
														
										<input type="text" name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" placeholder="Bill State" required="">
													
												   </div>
												   
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="md-inputdiv">
														<label for="" class="vab">Billing Zip</label>
														<input type="text" name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>"placeholder="Bill Zip" value="" required="">
													
												   </div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="md-inputdiv">
														<label for="" class="vab ">Billing Country</label>
														
														<select name="country"  required="" class="browser-default" style="width:66%;" >
														
														<option value="">Select Country</option>
	                     <option value="Afghanistan">Afghanistan</option>
<option value="Aland Islands">Aland Islands</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antarctica">Antarctica</option>
<option value="Antigua and Barbuda">Antigua and Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia" >Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Bouvet Island">Bouvet Island</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
<option value="Brunei Darussalam">Brunei Darussalam</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Islands">Cocos Islands</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote dIvoire">Cote dIvoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curacao">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Territories">French Southern Territories</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guernsey">Guernsey</option>
<option value="Guinea">Guinea</option>
<option value="Guinea Bissau">Guinea Bissau</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
<option value="Vatican City">Vatican City</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India" selected="selected">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jersey">Jersey</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="North Korea">North Korea</option>
<option value="South Korea">South Korea</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macao">Macao</option>
<option value="Republic of Macedonia">Republic of Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malawi">Malawi</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Federated States of Micronesia">Federated States of Micronesia</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montenegro">Montenegro</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Namibia">Namibia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Northern Mariana Islands">Northern Mariana Islands</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau">Palau</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Philippines">Philippines</option>
<option value="Pitcairn">Pitcairn</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russian Federation">Russian Federation</option>
<option value="Rwanda">Rwanda</option>
<option value="Saint Barthelemy">Saint Barthelemy</option>
<option value="Saint Helena">Saint Helena</option>
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
<option value="Saint Lucia">Saint Lucia</option>
<option value="Saint Martin">Saint Martin</option>
<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
<option value="Samoa">Samoa</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome and Principe">Sao Tome and Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Sint Maarten Dutch part">Sint Maarten Dutch part</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
<option value="South Sudan">South Sudan</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syrian Arab Republic">Syrian Arab Republic</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="East Timor">East Timor</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad and Tobago">Trinidad and Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Emirates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States">United States</option>
<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
<option value="Uruguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Venezuela">Venezuela</option>
<option value="Viet Nam">Viet Nam</option>
<option value="British Virgin Islands">British Virgin Islands</option>
<option value="United States Virgin Islands">United States Virgin Islands</option>
<option value="Wallis and Futuna">Wallis and Futuna</option>
<option value="Western Sahara">Western Sahara</option>
<option value="Yemen">Yemen</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
												</select>		
													
												   </div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="md-inputdiv">
														<label for="" class="vab">Billing Tel</label>
														<input type="text" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" value="" placeholder="Bill Tel" required="">
													
												   </div>
												</div>
												<div class="col-xs-12 col-sm-6">
													<div class="md-inputdiv">
														<label for="" class="vab">Billing Email</label>
														<input type="text" name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" value="" placeholder="Bill Email " required="">
													
												   </div>
												</div>
				<input type="hidden" name="lastname" value="">
				<input type="hidden" name="address2" value="">
				<input type="hidden" name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>">
				<input type="hidden" name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>">
				<input type="hidden" name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>">
				<input type="hidden" name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>">
				<input type="hidden" name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>">
                <input type="hidden" name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" />
	      </div>
	      <?php if(!$hash) { ?>
		  <button type="submit" class="md-submit">Submit</button>
		  <?php } ?>
		  
				  </form>
							    	</div>
								</div>
								<div class="modal-footer md-footer">
									<a href="javascript:void(0)" data-dismiss="modal" aria-hidden="true" class="md-close">Close</a>
								</div>
							</div>
						</div>
					</div>
				</div>
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