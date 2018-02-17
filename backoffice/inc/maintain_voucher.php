<?php  
session_start();
require 'inc.con.php';
	$obj = new db();     
	$obj->connect();
		function filterIn($str)
	{
		return addslashes(htmlspecialchars($str));		
	}
	function filterOut($str)
	{
		return stripslashes(htmlspecialchars_decode($str));		
	}

function convert_number_to_words($number=NULL){
if (($number < 0) || ($number > 999999999)) {
			throw new Exception("Number is out of range");  
		}
		$Gn = floor($number / 1000000);
		/* Millions (giga) */
		$number -= $Gn * 1000000;
		
		$Ln = floor($number / 100000);
		/* Lakh (Lakh) */
		$number -= $Ln * 100000;
		
		$kn = floor($number / 1000);
		/* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);
		/* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);
		/* Tens (deca) */
		$n = $number % 10;
		/* Ones */
		$res = "";
		if ($Gn) {
			$res .= convert_number_to_words($Gn) .  "Million";
		}
		if ($Ln) {
			$res .= (empty($res) ? "" : " ") .convert_number_to_words($Ln) . " Lakh";
		}
		if ($kn) {
			$res .= (empty($res) ? "" : " ") .convert_number_to_words($kn) . " Thousand";
		}
		if ($Hn) {
			$res .= (empty($res) ? "" : " ") .convert_number_to_words($Hn) . " Hundred";
		}
		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
		if ($Dn || $n) {
			if (!empty($res)) {
				$res .= " and ";
			}
			if ($Dn < 2) {
				$res .= $ones[$Dn * 10 + $n];
			} else {
				$res .= $tens[$Dn];
				if ($n) {
					$res .= "-" . $ones[$n];
				}
			}
		}
		if (empty($res)) {
			$res = "zero";
		}
		return $res;
 
}
if (isset($_POST['action']) && $_POST['action'] == "voucher") {
	
     $secret=$obj->get_secretkey();
	 $id=$obj->get_max("confirm_voucher","voucher_id");
 $query="insert into confirm_voucher values(:voucher_id,:secret_key,:clientname1,:emailid,:contactno,:nationality,:arrivefrom,:nooftraveler,:noofadult,:childchargeable,:kids,:arrival,:traveldt,:departuredt,:departureat,:arriveby,:departureby,:noofroomss,:extrabeds,:withoutbeds,:transportation,:noofcab,:dondont,:specialads,:voucher_date)";
		$param= array(
			'voucher_id' => $id,
			'secret_key'=>$secret,
			'clientname1'=>$_POST["clientname1"],
			'emailid'=>$_POST["emailid"],
			'contactno'=>$_POST["contactno"],			
			'nationality'=>$_POST["nationality"],
			'arrivefrom'=>$_POST["arrivefrom"],
			'nooftraveler'=>$_POST["nooftraveler"],
			'noofadult'=>$_POST["noofadult"],
			'childchargeable'=>$_POST["childchargeable"],
			'kids'=>$_POST["kids"],
			'arrival'=>$_POST["arrival"],
'traveldt'=>$_POST["traveldt"],
'departuredt'=>$_POST["departuredt"],
			'departureat'=>$_POST["departureat"],
			'arriveby'=>$_POST["arriveby"],
			'departureby'=>$_POST["departureby"],
			'noofroomss'=>$_POST["noofroomss"],
			'extrabeds'=>$_POST["extrabeds"],
			'withoutbeds'=>$_POST["withoutbeds"],
			'transportation'=>$_POST["transportation"],
			'noofcab'=>$_POST["noofcab"],
			'dondont'=>$_POST["dondont"],
			'specialads'=>$_POST["specialads"],
			'voucher_date'=>date('d/m/Y')
			); 
			$inserted=$obj->insert($query,$param);

			


$inserted2=0;
$hotname=explode(',',$_POST['hotname']);
$desti=explode(',',$_POST['desti']);
$sightseeing=explode(',',$_POST['sightseeing']);
$night=explode(',',$_POST['night']);
$chkin=explode(',',$_POST['chkin']);
$chkout=explode(',',$_POST['chkout']);
$roomtype=explode(',',$_POST['roomtype']);
$meals=explode(',',$_POST['meals']);
for($i=0;$i<sizeof($hotname);$i++)
		{
       
       $id2=$obj->get_max("voucher_hotel_meals","vhm_id");	
			 
	   $query="insert into voucher_hotel_meals values(:vhm_id,:voucher_id,:hotname,:desti,:sightseeing,:chkin,:chkout,:night,:meals,:roomtype)";
		$param= array(
			'vhm_id' => $id2,
			'voucher_id' =>$id,
            'hotname'=> $hotname[$i],
            'desti'=> $desti[$i],
			'sightseeing' =>$sightseeing[$i],
			'chkin' => $chkin[$i],
            'chkout' => $chkout[$i],
            'night' => $night[$i],
			'meals' =>$meals[$i] ,			
			'roomtype' =>$roomtype[$i]
			); 
			$inserted2+=$obj->insert($query,$param);
      }

      
$inserted3=0;
$day=explode(',',$_POST['day']);
$descr=explode(',',$_POST['descr']);

for($i=0;$i<sizeof($day);$i++)
		{
           
           
         $id2=$obj->get_max("voucher_itinerary","it_id");	
			 
	     $query="insert into voucher_itinerary values(:it_id,:voucher_id,:day,:descr)";
		 $param= array(
			'it_id' => $id2,
			'voucher_id' =>$id,
            'day'=> $day[$i],
			'descr' =>$descr[$i]
			); 
			$inserted3+=$obj->insert($query,$param);
      }
     require('WriteHTML.php');


$html="<html><head><style rel='stylesheet' type='text/css'>
tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
}
.tr:nth-child(odd) td,tr:nth-child(odd) th {
    background-color: #f9f9f9;
} 
th, td {
    font-size: 13px;
    word-break: break-word;
    padding: 8px 10px;
}

.td {
     font-size: 13px;
    word-break: break-word;
    padding: 0px 10px;
}
p{font-size: 13px;
	    word-wrap: break-word;
    width: 800px;
    white-space: pre-line;
}
div
{
	width:100%;
}
</style></head><body>";
$html.=" 
<table class='table table-bordered table-hover table-condensed' style=\"margin-left:0px; margin-right:auto; border:1px solid #666; height:auto; width:800px\"  >
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>";

$sql = "SELECT * FROM  admin where id='1'";
$res = $obj->getRows($sql);

    foreach ($res as $row)
    {	
//$html.="<img src='data:image/jpg;base64,".base64_encode($row["logoofcompany"])."' style='width:40%;float: left;'> <div>";
if($row["logoofcompany"]!="")
 $html.="<img src='http://backoffice.northern-travels.com/images/logo.png' style='width:40%;float: left;'> <div>";
$html.="<h1>".$row["nameofcompany"]."</h1> ";
$html.="<p style='font-size:15px;  '>";
if($row["corp_office"]!="")
$html.="Corporate Office- ".$row["corp_office"]."<br />";
if($row["reg_office"]!="")
$html.="Regional Office- ".$row["reg_office"]."<br/>";
if($row["hotline"]!="")
$html.="Hotline : ".$row["hotline"]."<br/>";
if($row["emailat"]!="")
$html.="Email us : ".$row["emailat"]."<br/>";
if($row["website"]!="")
$html.="Website : ".$row["website"]."";

$html.="</p>";
}
$html.="</div><hr />
</td>
</tr>
<tr>
<td class='td' align='center' style='font-size:16px;' >
 <b> Confirmation Voucher</b> 
 <hr />
</tr>
<tr>
<td class='td'>
<table width='100%' >
<tr>
<td class='td' width='50%' height='25' valign='top' style='font-size:16px;'>
<b>Voucher ID  :  ".$id." </b> 
</td>
<td class='td' width='50%' align='right' valign='top' style='font-size:16px;'> 
<b>Date  :  ".date('d/m/Y')." </b> 
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Personalize Details</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td> 
<table width='100%' border='' cellpadding='0' cellspacing='0' >

<tr>
<td>CLIENT NAME:</td><td>".$_POST["clientname1"]."</td><td>MOBILE</td><td>".$_POST["contactno"]."</td>
</tr>
<tr>
<td>Nationality</td><td>".$_POST["nationality"]."</td><td>MAIL</td><td>".$_POST["emailid"]."</td>
</tr>
<tr>
<td>Arriving From</td><td>".$_POST["arrivefrom"]."</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Travelers Details</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td height='66' style='font-size:16px;' > 
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<td>Number of Travelers</td><td>".$_POST["nooftraveler"]."</td><td>Number of Adult's</td><td>".$_POST["noofadult"]."</td>
</tr>
<tr>
<td>Childs Chargeable</td><td>".$_POST["childchargeable"]."</td><td>Kids Complementary</td><td>".$_POST["kids"]."</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Arrival & Departure Details</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td height='66' style='font-size:16px;' > 

<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<td>Arrive From</td><td>".$_POST["arrival"]."</td><td>Departure At</td><td>".$_POST["departureat"]."</td>
</tr>
<tr>
<td>Travel Date</td><td>".$_POST["traveldt"]."</td><td>Departure Date</td><td>".$_POST["departuredt"]."</td>
</tr>
<tr>
<td>Arrival Railway/Flight No along timing</td><td>".$_POST["arriveby"]."</td><td>Departure Railway/Flight No along timing</td><td>".$_POST["departureby"]."</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Accommodation & Transportation Details</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td height='66' style='font-size:16px;' > 

<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<td>Number Of Rooms</td><td>".$_POST["noofroomss"]."</td><td>Number Of Extra Beds</td><td>".$_POST["extrabeds"]."</td>
</tr>
<tr>
<td>Number Of Childs W/O Beds</td><td>".$_POST["withoutbeds"]."</td><td>Transportaion</td><td>".$_POST["transportation"]."</td>
</tr>
<tr>
<td>Number Of Cabs</td><td>".$_POST["noofcab"]."</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Hotels, Meals & Destination Stay</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<th>Hotel Name
<th>Destination
<th>Sightseeing
<th>Check In
<th>Check Out
<th>Nights
<th>Meals
<th>Room Type
</tr>";
$hotname=explode(',',$_POST['hotname']);
$desti=explode(',',$_POST['desti']);
$sightseeing=explode(',',$_POST['sightseeing']);
$night=explode(',',$_POST['night']);
$chkin=explode(',',$_POST['chkin']);
$chkout=explode(',',$_POST['chkout']);
$roomtype=explode(',',$_POST['roomtype']);
$meals=explode(',',$_POST['meals']);
for($i=0;$i<sizeof($hotname);$i++)
		{
$html.="<tr>"; 
         $html.="<td>".$hotname[$i]."</td>";
         $html.="<td>".$desti[$i]." </td>";
         $html.="<td>".$sightseeing[$i]." </td>";
         $html.="<td>".$chkin[$i]." </td>";
         $html.="<td>".$chkout[$i]."</td>";
         $html.="<td>".$night[$i]."</td>";
          $html.="<td>".$meals[$i]."</td>"; 
          $html.="<td>".$roomtype[$i]."</td>"; 
         
         $html.="</tr>";
      }
$html.="</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Tour Itinerary</b> <br /> </p>
 <hr />
</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<th width='10%'>Day
<th>Description

</tr>";

$day=explode(',',$_POST['day']);
$descr=explode(',',$_POST['descr']);

for($i=0;$i<sizeof($day);$i++)
		{
$html.="<tr>"; 
         $html.="<td>".$day[$i]."</td>";
         $html.="<td>".$descr[$i]." </td>";
         
         $html.="</tr>";
      }

$html.="</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Does & Doesnt</b> <br /> </p> 
 <hr />
</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<td>".$_POST["dondont"]."</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Special Additions</b> <br /> </p> 
 <hr />
</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<td>".$_POST["specialads"]."</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
Sincerely<br>
Reservation<br>
Northern Travels<br>
+91-7006179868<br>
Email: admin@northern-travels.com<br>
</td>
</tr>
</table>

</div></body></html>";



$from_mail='support@northern-travels.com';
	$from_name='Northern Travels';
	
	$subject='Confirm Voucher from northern-travels';
      require_once 'class.phpmailer.php';
$mail = new PHPMailer();
// Now you only need to add the necessary stuff
 
// HTML body
 
$body = "</pre>
<div>";

$body .= " Hello ".$_POST["clientname1"]."<br> <p> Your Secret Key to view / print voucher from our website 'backoffice.northern-travels.com' is '".$secret."', Please login with voucher id and secret key. <br>";
$body .= $html."<br>";
$body .= "Sincerely,<br>
";
$body .= "Northern Travels";
$body .= "</div>" ;
 
// And the absolute required configurations for sending HTML with attachement
 
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "bh-61.webhostbox.net";//smtp.zoho.com
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "support@northern-travels.com";//"support@northern-travels.com";
$mail->Password = "support@northern1"; //support@northern
$mail->SetFrom($from_mail);
$mail->Subject =$subject;

$mail->AddAddress($_POST["emailid"]);//ADMIN@KALPAKPEB.COM

$mail->MsgHTML($body);
//$mail->AddAttachment($file);
if(!$mail->Send()) {
	}

if($inserted && ($inserted2 ==sizeof($hotname)) && ($inserted3 ==sizeof($day)) ) {
					$status = true;					
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";	
	             }

 echo json_encode(array('status' => $status, 'msg' => $msg));
}		


if (isset($_REQUEST['action']) && $_REQUEST['action'] == "print") {
		
		require('WriteHTML.php');


$html="<html><head><style rel='stylesheet' type='text/css'>
tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
}
.tr:nth-child(odd) td,tr:nth-child(odd) th {
    background-color: #f9f9f9;
} 
th, td {
    font-size: 13px;
    word-break: break-word;
    padding: 8px 10px;
}

.td {
     font-size: 13px;
    word-break: break-word;
    padding: 0px 10px;
}
p{font-size: 13px;
	    word-wrap: break-word;
    width: 800px;
    white-space: pre-line;
}
div
{
	width:100%;
}
</style></head><body>";
$html.=" 
<table class='table table-bordered table-hover table-condensed' style=\"margin-left:0px; margin-right:auto; border:1px solid #666; height:auto; width:800px\"  >
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>";
$markup=0;
$sql = "SELECT * FROM  admin where id='1'";
$res = $obj->getRows($sql);

    foreach ($res as $row)
    {	
//$html.="<img src='data:image/jpg;base64,".base64_encode($row["logoofcompany"])."' style='width:40%;float: left;'> <div>";
if($row["logoofcompany"]!="")
 $html.="<img src='http://backoffice.northern-travels.com/images/logo.png' style='width:40%;float: left;'> <div>";
$html.="<h1>".$row["nameofcompany"]."</h1> ";
$html.="<p style='font-size:15px;  '>";
if($row["corp_office"]!="")
$html.="Corporate Office- ".$row["corp_office"]."<br />";
if($row["reg_office"]!="")
$html.="Regional Office- ".$row["reg_office"]."<br/>";
if($row["hotline"]!="")
$html.="Hotline : ".$row["hotline"]."<br/>";
if($row["emailat"]!="")
$html.="Email us : ".$row["emailat"]."<br/>";
if($row["website"]!="")
$html.="Website : ".$row["website"]."";

$html.="</p>";
}
$html.="</div><hr />
</td>
</tr>
<tr>
<td class='td'>
<table width='100%' >
<tr>
<td class='td' width='50%' height='25' valign='top' style='font-size:16px;'>
 <b> Confirmation Voucher</b> 
</td>
<td class='td' width='50%' align='right' valign='top' style='font-size:16px;'> 
<b>Date  :  ".date('d/m/Y')." </b> 
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Personalize Details</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td> 
<table width='100%' border='' cellpadding='0' cellspacing='0' >

<tr>
<td>CLIENT NAME:</td><td>".$_REQUEST["clientname1"]."</td><td>MOBILE</td><td>".$_REQUEST["contactno"]."</td>
</tr>
<tr>
<td>Nationality</td><td>".$_REQUEST["nationality"]."</td><td>MAIL</td><td>".$_REQUEST["emailid"]."</td>
</tr>
<tr>
<td>Arriving From</td><td>".$_REQUEST["arrivefrom"]."</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Travelers Details</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td height='66' style='font-size:16px;' > 
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<td>Number of Travelers</td><td>".$_REQUEST["nooftraveler"]."</td><td>Number of Adult's</td><td>".$_REQUEST["noofadult"]."</td>
</tr>
<tr>
<td>Childs Chargeable</td><td>".$_REQUEST["childchargeable"]."</td><td>Kids Complementary</td><td>".$_REQUEST["kids"]."</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Arrival & Departure Details</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td height='66' style='font-size:16px;' > 

<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<td>Arrive From</td><td>".$_REQUEST["arrival"]."</td><td>Departure At</td><td>".$_REQUEST["departureat"]."</td>
</tr>
<tr>
<td>Arrival Railway/Flight No along timing</td><td>".$_REQUEST["arriveby"]."</td><td>Departure Railway/Flight No along timing</td><td>".$_REQUEST["departureby"]."</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Accommodation & Transportation Details</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td height='66' style='font-size:16px;' > 

<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<td>Number Of Rooms</td><td>".$_REQUEST["noofroomss"]."</td><td>Number Of Extra Beds</td><td>".$_REQUEST["extrabeds"]."</td>
</tr>
<tr>
<td>Number Of Childs W/O Beds</td><td>".$_REQUEST["withoutbeds"]."</td><td>Transportaion</td><td>".$_REQUEST["transportation"]."</td>
</tr>
<tr>
<td>Number Of Cabs</td><td>".$_REQUEST["noofcab"]."</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Hotels, Meals & Destination Stay</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<th>Hotel Name
<th>Destination
<th>Sightseeing
<th>Check In
<th>Check Out
<th>Nights
<th>Meals
<th>Room Type
</tr>";
$hotname=explode(',',$_REQUEST['hotname']);
$desti=explode(',',$_REQUEST['desti']);
$sightseeing=explode(',',$_REQUEST['sightseeing']);
$night=explode(',',$_REQUEST['night']);
$chkin=explode(',',$_REQUEST['chkin']);
$chkout=explode(',',$_REQUEST['chkout']);
$roomtype=explode(',',$_REQUEST['roomtype']);
$meals=explode(',',$_REQUEST['meals']);
for($i=0;$i<sizeof($hotname);$i++)
		{
$html.="<tr>"; 
         $html.="<td>".$hotname[$i]."</td>";
         $html.="<td>".$desti[$i]." </td>";
         $html.="<td>".$sightseeing[$i]." </td>";
         $html.="<td>".$chkin[$i]." </td>";
         $html.="<td>".$chkout[$i]."</td>";
         $html.="<td>".$night[$i]."</td>";
          $html.="<td>".$meals[$i]."</td>"; 
          $html.="<td>".$roomtype[$i]."</td>"; 
         
         $html.="</tr>";
      }
$html.="</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Tour Itinerary</b> <br /> </p>
</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<th width='10%'>Day
<th>Description

</tr>";

$day=explode(',',$_REQUEST['day']);
$descr=explode(',',$_REQUEST['descr']);

for($i=0;$i<sizeof($day);$i++)
		{
$html.="<tr>"; 
         $html.="<td>".$day[$i]."</td>";
         $html.="<td>".$descr[$i]." </td>";
         
         $html.="</tr>";
      }

$html.="</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Does & Doesnt</b> <br /> </p> 

</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<td>".$_REQUEST["dondont"]."</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>  
<p style='font-size:18px;  '> <b>Special Additions</b> <br /> </p> 

</td>
</tr>
<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<td>".$_REQUEST["specialads"]."</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
Sincerely<br>
Reservation<br>
Northern Travels<br>
+91-7006179868<br>
Email: admin@northern-travels.com<br>
</td>
</tr>
</table>
<script type='text/javascript'>
window.print(); 
</script>
</div></body></html>";
echo $html;


$from_mail='northerntravelsindiapvtltd@gmail.com';
	$from_name='Northern Travels';
	
	$subject='Confirm Voucher from northern-travels';
      require_once 'class.phpmailer.php';
$mail = new PHPMailer();
// Now you only need to add the necessary stuff
 
// HTML body
 
$body = "</pre>
<div>";

$body .= " Hello ".$_REQUEST["clientname1"]."<br>,
";
$body .= $html."<br>";
$body .= "Sincerely,<br>
";
$body .= "Northern Travels";
$body .= "</div>" ;
 
// And the absolute required configurations for sending HTML with attachement
 
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "northerntravelsindiapvtltd@gmail.com";//"enquiry@kalpakpeb.com";
$mail->Password = "northern123";
$mail->SetFrom($from_mail);
$mail->Subject =$subject;

$mail->AddAddress($_REQUEST["emailid"]);//ADMIN@KALPAKPEB.COM

$mail->MsgHTML($body);
//$mail->AddAttachment($file);
if(!$mail->Send()) {
	}


}

if($_REQUEST['action']=="ssss")
{

 
$from_mail='northerntravelsindiapvtltd@gmail.com';
	$from_name='Northern Travels';
	
	$subject='Quotation from northern-travels';

 
 require_once 'class.phpmailer.php';
$mail = new PHPMailer();
// Now you only need to add the necessary stuff
 
// HTML body
 
$body = "<div>";
$body .= " Hello User<br>,";
$body .= "<br>";
$body .= "Sincerely,<br>";
$body .= "Northern Travels";
$body .= "</div>" ;
 
// And the absolute required configurations for sending HTML with attachement
 
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // 465 or 587
$mail->IsHTML(true);
$mail->Username = "northerntravelsindiapvtltd@gmail.com";//"enquiry@kalpakpeb.com";
$mail->Password = "AMIR@1234#";
$mail->SetFrom($from_mail);
$mail->Subject =$subject;

$mail->AddAddress("rahul.samrut@gmail.com");//ADMIN@KALPAKPEB.COM

$mail->MsgHTML($body);
echo $res=$mail->Send();
if($res) {
echo "Error";
}
else
{
echo "success";
}
}
?>  