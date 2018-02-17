<?php  
session_start();
require 'inc/inc.con.php';
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
  if(isset($_SESSION['uid']) && $_SESSION['uid']!="")
  {
require('inc/WriteHTML.php');

$sql = "SELECT * FROM  confirm_voucher where voucher_id='".$_SESSION['uid']."'";
$res = $obj->getRows($sql);

$vdate="";$client_name="";$email="";$contact_no="";$nationality="";$arriving_from="";$no_of_traveller="";
$no_of_adults="";$childs_chargable="";$kids_complementary="";$arrive_from="";$departure_at="";
$arrival_railway="";$departure_railway="";$no_of_rooms="";$no_of_extrabeds="";$no_of_childswobeds="";
$transportation="";$no_of_cabs="";$does_n_donts="";$special_addition="";$traveldt="";$departuredt="";
    foreach ($res as $row)
    {
      $vdate=$row["voucher_date"];
      $client_name=$row["client_name"];
      $email=$row["email"];
      $contact_no=$row["contact_no"];
      $nationality=$row["nationality"];
      $arriving_from=$row["arriving_from"];
      $no_of_traveller=$row["no_of_traveller"];
      $no_of_adults=$row["no_of_adults"];
      $childs_chargable=$row["childs_chargable"];
      $kids_complementary=$row["kids_complementary"];
      $arrive_from=$row["arrive_from"];
      $traveldt=$row["traveldt"];
      $departuredt=$row["departuredt"];
      $departure_at=$row["departure_at"];
      $arrival_railway=$row["arrival_railway"];
      $departure_railway=$row["departure_railway"];
      $no_of_rooms=$row["no_of_rooms"];
      $no_of_extrabeds=$row["no_of_extrabeds"];
      $no_of_childswobeds=$row["no_of_childswobeds"];
      $transportation=$row["transportation"];
      $no_of_cabs=$row["no_of_cabs"];
      $does_n_donts=$row["does_n_donts"];
      $special_addition=$row["special_addition"];

    }
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
<table class='table table-bordered table-hover table-condensed' style=\"margin-left:auto; margin-right:auto; border:1px solid #666; height:auto; width:800px\"  >
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
<b>Voucher ID  :  ".$_SESSION['uid']." </b> 
</td>
<td class='td' width='50%' align='right' valign='top' style='font-size:16px;'> 
<b>Date  :  ".$vdate." </b> 
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
<td>CLIENT NAME:</td><td>".$client_name."</td><td>MOBILE</td><td>".$contact_no."</td>
</tr>
<tr>
<td>Nationality</td><td>".$nationality."</td><td>MAIL</td><td>".$email."</td>
</tr>
<tr>
<td>Arriving From</td><td>".$arriving_from."</td><td>&nbsp;</td><td>&nbsp;</td>
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
<td>Number of Travelers</td><td>".$no_of_traveller."</td><td>Number of Adult's</td><td>".$no_of_adults."</td>
</tr>
<tr>
<td>Childs Chargeable</td><td>".$childs_chargable."</td><td>Kids Complementary</td><td>".$kids_complementary."</td>
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
<td>Arrive From</td><td>".$arrive_from."</td><td>Departure At</td><td>".$departure_at."</td>
</tr>
<tr>
<td>Travel Date</td><td>".$traveldt."</td><td>Departure Date</td><td>".$departuredt."</td>
</tr>
<tr>
<td>Arrival Railway/Flight No along timing</td><td>".$arrival_railway."</td><td>Departure Railway/Flight No along timing</td><td>".$departure_railway."</td>
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
<td>Number Of Rooms</td><td>".$no_of_rooms."</td><td>Number Of Extra Beds</td><td>".$no_of_extrabeds."</td>
</tr>
<tr>
<td>Number Of Childs W/O Beds</td><td>".$no_of_childswobeds."</td><td>Transportaion</td><td>".$transportation."</td>
</tr>
<tr>
<td>Number Of Cabs</td><td>".$no_of_cabs."</td><td>&nbsp;</td><td>&nbsp;</td>
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
$sql = "SELECT * FROM  voucher_hotel_meals where voucher_id='".$_SESSION['uid']."'";
$res = $obj->getRows($sql);

    foreach ($res as $row)
    { 
$html.="<tr>"; 
         $html.="<td>".$row["hotel_name"]."</td>";
         $html.="<td>".$row["destination"]." </td>";
         $html.="<td>".$row["sightseeing"]." </td>";
         $html.="<td>".$row["checkin"]." </td>";
         $html.="<td>".$row["checkout"]."</td>";
         $html.="<td>".$row["nights"]."</td>";
          $html.="<td>".$row["meals"]."</td>"; 
          $html.="<td>".$row["roomtype"]."</td>"; 
         
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

$sql = "SELECT * FROM  voucher_itinerary where voucher_id='".$_SESSION['uid']."'";
$res = $obj->getRows($sql);

    foreach ($res as $row)
    { 

         $html.="<tr>"; 
         $html.="<td>".$row["day"]."</td>";
         $html.="<td>".$row["description"]." </td>";         
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
<td>".$does_n_donts."</td>
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
<td>".$special_addition."</td>
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
}
else
{
  header("Location:index.html");
}
?>
