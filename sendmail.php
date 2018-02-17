<?php  

if (isset($_POST['action']) && $_POST['action'] == "email") {
	
     
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
<td class='td' align='center' style='font-size:16px;' >
 <br><b> Enquiry From Website</b> 
 <hr />
</tr>
<tr>
<td class='td'>
<table width='100%' >
<tr>
<td>&nbsp;</td>
<td class='td' width='50%' align='right' valign='top' style='font-size:16px;'> 
<b>Date  :  ".date('d/m/Y')." </b> 
</td>
</tr>
</table>
</td>
</tr>

<tr>
<td> 
<table width='100%' border='' cellpadding='0' cellspacing='0' >

<tr>
<td>Name:</td><td>".$_POST["name"]."</td><td>Contact: </td><td>".$_POST["contact"]."</td>
</tr>
<tr>
<td>Email-id:</td><td>".$_POST["email"]."</td><td>Number of Persons</td><td>".$_POST["noofpersons"]."</td>
</tr>
<tr>
<td>Number of Days</td><td>".$_POST["noofdays"]."</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr>
<td colspan='4'>Message:<br><p> ".$_POST["message"]."</p></td>
</tr>
</table>
</td>
</tr>


</table>

</div></body></html>";



$from_mail='support@northern-travels.com';
$from_name=''.$_POST["name"];
	
$subject="Enquiry From ".$_POST["name"];
require_once 'class.phpmailer.php';
$mail = new PHPMailer();
// Now you only need to add the necessary stuff
 
// HTML body
 
$body = "</pre>
<div>";

$body .= "Enquiry From ".$_POST["name"]."<br> <p><br>";
$body .= $html."<br>";
$body .= "Sincerely,<br>
";
$body .= "".$_POST["name"];
$body .= "</div>" ;
 
// And the absolute required configurations for sending HTML with attachement
 
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "bh-61.webhostbox.net";//smtp.gmail.com or smtp.zoho.com
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "support@northern-travels.com";//"enquiry@kalpakpeb.com";support@northern-travels.com
$mail->Password = "support@northern1"; //support@northern
$mail->SetFrom($from_mail);
$mail->Subject =$subject;

$mail->AddAddress("admin@northern-travels.com");//ADMIN@KALPAKPEB.COM

$mail->MsgHTML($body);
//$mail->AddAttachment($file);
if($mail->Send()) {
	                                $status = true;					
					$msg = "Enquiry sent Successfully....!";
					
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";	
	             }

 echo json_encode(array('status' => $status, 'msg' => $msg));
}		

?>  