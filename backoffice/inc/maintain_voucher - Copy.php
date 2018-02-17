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
		


if (isset($_REQUEST['action']) && $_REQUEST['action'] == "voucher") {
		
require('WriteHTML.php');
$pdf=new PDF_HTML();
 
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 15);
 
$pdf->AddPage();
$pdf->Image('../images/logo.png',18,13,33);


 $pdf->SetFont('Arial','B',11);
 
 $html=" 
<table>
<tr>
<td>";
$markup=0;
$sql = "SELECT * FROM  admin where id='1'";
$res = $obj->getRows($sql);

    foreach ($res as $row)
    {	
    

$pdf->SetFont('Arial','B',18);
$pdf->WriteHTML('    <para style="text-align:center;"><h1>                '.$row["nameofcompany"].'</h1></para><br><br>');
 $pdf->SetFont('Arial','B',11);

if($row["corp_office"]!="")
$pdf->WriteHTML3("Corporate Office- ".$row["corp_office"]."");
if($row["reg_office"]!="")
$pdf->WriteHTML3("Regional Office- ".$row["reg_office"]."");
if($row["hotline"]!="")
$pdf->WriteHTML3("Hotline : ".$row["hotline"]."");
if($row["emailat"]!="")
$pdf->WriteHTML3("<br>Email us : ".$row["emailat"]."  Website : ".$row["website"]."");



}
$html.="</div><hr />
</td>
</tr>
<tr>
<td >
<table  >
<tr>
<td>
 <b> Confirmation Voucher</b> 
</td>
<td> 
<b>Date  :  ".date('d/m/Y')." </b> 
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>  
<p style='font-size:18px;  '> <b>Personalize Details</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td> 
<table>

<tr>
<td>CLIENT NAME:</td><td>".$_REQUEST["clientname"]."</td><td>MOBILE</td><td>".$_REQUEST["contactno"]."</td>
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
<td>  
<p style='font-size:18px;  '> <b>Travelers Details</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td> 
<table>
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
<td>  
<p style='font-size:18px;  '> <b>Arrival & Departure Details</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td> 

<table>
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
<td>  
<p style='font-size:18px;  '> <b>Accommodation & Transportation Details</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td> 

<table>
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
<td>  
<p style='font-size:18px;  '> <b>Hotels, Meals & Destination Stay</b> <br /> </p>
<hr />
</td>
</tr>
<tr>
<td>
<table>
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
<td>  
<p style='font-size:18px;  '> <b>Tour Itinerary</b> <br /> </p>
</td>
</tr>
<tr>
<td>
<table>
<tr>
<th>Day
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
<td>  
<p style='font-size:18px;  '> <b>Does & Doesnt</b> <br /> </p> 

</td>
</tr>
<tr>
<td>
<table>
<tr>
<td>".$_REQUEST["dondont"]."</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
Sincerely<br>
Reservation<br>
Northern Travels<br>
+91-XXXXXXXXXX<br>
Email: xxxxxx@northern-travels.com<br>
</td>
</tr>
</table>";
//echo $html;


$pdf->WriteHTML("<br><br> $style$html"."<br><br>");
 $pdf->SetFont('Arial','B',11);
$content=$pdf->Output("one.pdf",'F');      
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