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


if($_POST['action']=="show")
{

   
     $sql = "select * from contact_info";
      
        $res = $obj->getRows($sql);
        /*$send_data = array();
        foreach ($res as $key => $value) {
            $send_data[] = array_map('filterOut',$value);
        }*/
        $response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["address"]  = $row["address"];
        $post["email"]  = $row["email"];
        $post['contact']=$row['contact']; 
    
        array_push($response, $post);
    }
    echo json_encode($response);



}

if($_POST['action']=="add")
{
	
	
 $sql = "select * from contact_info";
 $res = $obj->getRows($sql);
 $cnt=count($res);
if($cnt){
	$query="update contact_info set address=:address,email=:email,contact=:contact";
	$param= array(
	'address' => $_POST['address'],
'email' => $_POST['email'],
'contact' =>$_POST['contact']
); 
//PDOBindArray($stmt,$taValues);
	$inserted=$obj->insert($query,$param);

	   if($inserted) {
            $status = true;
            $msg = "Successfully Updated";
        } else {
            $status = false;
            $msg = "Something went wrong while Adding the Record, please try again.";
        }
}
else{
	$query="insert into contact_info values(:id,:address,:email,:contact)";
	$param= array(
        'id'=>'',
	'address' => $_POST['address'],
'email' => $_POST['email'],
'contact' =>$_POST['contact']
); 
//PDOBindArray($stmt,$taValues);
	$inserted=$obj->insert($query,$param);

	   if($inserted) {
            $status = true;
            $msg = "Successfully Added";
        } else {
            $status = false;
            $msg = "Something went wrong while Adding the Record, please try again.";
        }
}
        echo json_encode(array('status' => $status, 'msg' => $msg));
}	
?>  