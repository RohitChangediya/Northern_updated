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
$leaddate="";
if($_REQUEST['leadsdate']=="")
       $leaddate=date("Y-m");
      else
       $leaddate=$_REQUEST['leadsdate'];
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
$html.="<table class='table table-bordered table-hover table-condensed' style=\"margin-left:auto; margin-right:auto; border:1px solid #666; height:auto; width:800px\" id='main' >
<tr>
<td align='center' style='border-bottom:1px solid #999l;'>";

$sql = "SELECT * FROM  admin where id='1'";
$res = $obj->getRows($sql);

    foreach ($res as $row)
    { 
//$html.="<img src='data:image/jpg;base64,".base64_encode($row["logoofcompany"])."' style='width:40%;float: left;'> <div>";
if($row["logoofcompany"]!="")
 $html.="<img src='http://backoffice.northern-travels.com/images/logo.jpeg' style='width:40%;float: left;'> <div>";
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
 <b> Leads Of ".$leaddate."</b> 
 <hr />
</tr>


<tr>
<td>
<table width='100%' border='' cellpadding='0' cellspacing='0' >
<tr>
<th style='width: 5%;'>Sr.No</th>
<th style='width: 10%;'>Customer</th>
<th style='width: 11%;'>Contact</th>
<th style='width: 12%;'>E-mail</th>
<th style='width: 10%;'>Location</th>
<th>Details</th>
<th style='width: 11%;'>Date</th>
<th style='width: 10%;'>Lead Type</th></tr>";
$sql = "";
if($_SESSION['usertype']=='ADMIN')
    {
     $sql = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".$leaddate."','%Y-%m') order by leads.cust_status";
    }
    if($_SESSION['usertype']=='AGENT')
    {
      $sql = "SELECT leads.id,leads.cust_name,admin.name,leads.cust_contact,leads.cust_email,leads.cust_location,leads.cust_status,leads.cust_details,leads.lead_date From leads,admin where admin.id=leads.user_id and user_id='".$_SESSION['uid']."' and STR_TO_DATE(lead_date,'%Y-%m')=STR_TO_DATE('".$leaddate."','%Y-%m') order by leads.cust_status";
    }
   


$res = $obj->getRows($sql);
$i=1;
    foreach ($res as $row)
    { 
$html.="<tr>"; 
           $html.="<td>".$i."</td>";
         $html.="<td>".$row["cust_name"]."</td>";
         $html.="<td>".$row["cust_contact"]." </td>";
         $html.="<td>".$row["cust_email"]." </td>";
         $html.="<td>".$row["cust_location"]." </td>";
         $html.="<td>".$row["cust_details"]."</td>";
         $html.="<td>".$row["lead_date"]."</td>";
         $html.="<td>".$row["cust_status"]."</td>"; 
         
         $html.="</tr>";
         $i++;
      }
$html.="</table>
</td>
</tr>

</table><br>
<input type='button' onclick='toexcel(event)' id='excel' value='Export' style='float:right;margin-right:19%;margin-bootom:20px;'/>&nbsp;&nbsp;<input type='button' onclick='topdf(event)' id='pdf' value='PDF' style='float:right;margin-right:1%;margin-bootom:20px;'/><br><br><br><br>
<script type='text/javascript'>
function topdf(e)
{
var pdf=document.getElementById('pdf');
pdf.style.display = 'none';
var excel=document.getElementById('excel');
excel.style.display = 'none';
window.print();
var pdf=document.getElementById('pdf');
pdf.style.display = 'block';
var excel=document.getElementById('excel');
excel.style.display = 'block';
}
function toexcel(e)
{
  var pdf=document.getElementById('pdf');
pdf.style.display = 'none';
var excel=document.getElementById('excel');
excel.style.display = 'none';
        var postfix ='".$leaddate."';
        
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_div = document.getElementById('main');
        var table_html = table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        //setting the file name
        a.download = 'exported_table_' + postfix + '.xls';
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
var pdf=document.getElementById('pdf');
pdf.style.display = 'block';
var excel=document.getElementById('excel');
excel.style.display = 'block';
        e.preventDefault();
}
</script>
</div></body></html>";
echo $html;
}
else
{
  header("Location:index.html");
}
?>
