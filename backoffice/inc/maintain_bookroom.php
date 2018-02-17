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

if($_POST['action']=="load")
{         
        if($_SESSION['usertype']=="HOTEL")
          {
	$sql="select hotel_id,hotelname from hotels where hotel_id='".$_SESSION['uid']."'";
	$row=$obj->getRows($sql);
	
	 $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	
	foreach($row as $rec)//foreach loop  
	{   $status = true;
		 $msg .="<option value='".$rec['hotel_id']."'>".$rec['hotelname']."</option>";  
	}
       }
      else
      {   $sql="select hotel_id,hotelname from hotels";
          $row=$obj->getRows($sql);
	
	 $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	
	foreach($row as $rec)//foreach loop  
	{   $status = true;
		 $msg .="<option value='".$rec['hotel_id']."'>".$rec['hotelname']."</option>";  
	}
      }
	
 echo json_encode(array('status' => $status, 'msg' => $msg));
}
if($_POST['action']=="loadroom")
{       
         if($_SESSION['usertype']=="HOTEL")
          {
	$sql="select hotelroom_id,roomtype,actype from hotelroom where hotel_id=:id";
	$param= array(
			'id' => $_SESSION['uid']
			);
	$row=$obj->getRows($sql,$param);
	
	 $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	
	foreach($row as $rec)//foreach loop  
	{        $status = true;
		 $msg .="<option value='".$rec['hotelroom_id']."'>".$rec['roomtype']."-".$rec['actype']."</option>";  
	}
       }
       else
        {
          $sql="select hotelroom_id,roomtype,actype from hotelroom where hotel_id=:id";
	$param= array(
			'id' => $_POST['id']
			);
	$row=$obj->getRows($sql,$param);
	
	 $msg="";
	  $msg .="<option value=''>---Select---</option>";  
	
	foreach($row as $rec)//foreach loop  
	{        $status = true;
		 $msg .="<option value='".$rec['hotelroom_id']."'>".$rec['roomtype']."-".$rec['actype']."</option>";  
	}

        }
	
 echo json_encode(array('status' => $status, 'msg' => $msg));
}
 if ( $_POST['action'] == "datatable") 
{
	
if($_SESSION['usertype']=="ADMIN" )
          {
	    $sql = " SELECT blockroom.br_id,blockroom.nameofclient, hotels.hotelname,hotelroom.roomtype,blockroom.noofrooms,blockroom.bookdate ,blockroom.status FROM  blockroom,hotels,hotelroom where blockroom.hotel_id=hotels.hotel_id and blockroom.room_id=hotelroom.hotelroom_id";
$columns = array('blockroom.br_id','blockroom.nameofclient','hotels.hotelname','hotelroom.roomtype','blockroom.noofrooms','blockroom.bookdate','blockroom.status' );
		$isResult = $obj->generateDatatableCustom($sql, $columns, 'br_id');		
		echo $isResult;			
	}
         else if($_SESSION['usertype']=="HOTEL")
          {
 $sql = "SELECT blockroom.br_id,blockroom.nameofclient, hotels.hotelname,hotelroom.roomtype,blockroom.noofrooms,blockroom.bookdate ,blockroom.status FROM  blockroom,hotels,hotelroom where blockroom.hotel_id=hotels.hotel_id and blockroom.room_id=hotelroom.hotelroom_id  and blockroom.hotel_id='".$_SESSION['uid']."'";
$columns = array('blockroom.br_id','blockroom.nameofclient','hotels.hotelname','hotelroom.roomtype','blockroom.noofrooms','blockroom.bookdate','blockroom.status' );
		$isResult = $obj->generateDatatableCustom($sql, $columns, 'br_id');		
		echo $isResult;	
           }
/*if($_SESSION['usertype']=="AGENT")
          {
 $sql = "SELECT blockroom.br_id,blockroom.nameofclient, hotels.hotelname,hotelroom.roomtype,blockroom.noofrooms,blockroom.bookdate ,blockroom.status FROM  blockroom,hotels,hotelroom where blockroom.hotel_id=hotels.hotel_id and blockroom.room_id=hotelroom.hotelroom_id and blockroom.user_id='".$_SESSION['uid']."' ";
$columns = array('blockroom.br_id','blockroom.nameofclient','hotels.hotelname','hotelroom.roomtype','blockroom.noofrooms','blockroom.bookdate','blockroom.status' );
		$isResult = $obj->generateDatatableAgentCustom($sql, $columns, 'br_id');		
		echo $isResult;	
          }*/	
		  
		
}
	


if($_POST['action']=="save")
{ // print_r($_FILES);
         $free=0;
	$sql2 = "SELECT noofrooms,hotelroom_id,roomtype,actype  FROM  hotelroom where  hotel_id=:hotel_id and hotelroom_id=:hotelroom_id";
		$param2 = array('hotel_id'=>$_POST['hotelbook'],'hotelroom_id'=>$_POST['room']);
		$res2 = $obj->getRows($sql2, $param2);
                $totcnt=0;
                foreach ($res2 as $row2)
                 { $totcnt=$row2['noofrooms'];
              
      $sql = "Select  hoteldetails.hotel_id,  hoteldetails.noofnights,  hoteldetails.fromdate,  hoteldetails.todate,  hoteldetails.room_id,  clientdetails.clientname,accomodetails.noofroom From  clientdetails Inner Join  hoteldetails    On hoteldetails.quot_id = clientdetails.quot_id Inner Join accomodetails On hoteldetails.quot_id = accomodetails.quot_id  Where  Str_To_Date('".$_POST['bookdate']."', '%d-%m-%Y') Between  Str_To_Date(hoteldetails.fromdate, '%d-%m-%Y') And  Str_To_Date(hoteldetails.todate, '%d-%m-%Y') AND  hoteldetails.hotel_id=:hotel_id and clientdetails.status='1' and hoteldetails.room_id=:room_id";
		$param = array('hotel_id'=>$_POST['hotelbook'],'room_id'=>$row2['hotelroom_id']);
		$res = $obj->getRows($sql, $param);
		  
    $cnt=0;  
    foreach ($res as $row)
    { for($i=1;$i<=$row['noofroom'];$i++)
      {
       
       $cnt=$cnt+1;
      } 
    
    }

       $sql3 = "Select noofrooms,nameofclient From  blockroom  Where  Str_To_Date('".$_POST['bookdate']."', '%d-%m-%Y')=Str_To_Date(bookdate, '%d-%m-%Y') and status='OCCUPIED' and hotel_id=:hotel_id and room_id=:room_id";
		$param3 = array('hotel_id'=>$_POST['hotelbook'],'room_id'=>$row2['hotelroom_id']);
		$res3 = $obj->getRows($sql3, $param3);
		
		 
    $cnt3=0;  
    foreach ($res3 as $row3)
    {  for($i=1;$i<=$row3['noofrooms'];$i++)
      {
      
       $cnt3=$cnt3+1;
      } 
    
    }
    
    $sql4 = "Select noofrooms,nameofclient From  blockroom  Where  Str_To_Date('".$_POST['bookdate']."', '%d-%m-%Y')=Str_To_Date(bookdate, '%d-%m-%Y') and status='BLOCK' and hotel_id=:hotel_id and room_id=:room_id";
		$param4 = array('hotel_id'=>$_POST['hotelbook'],'room_id'=>$row2['hotelroom_id']);
		$res4 = $obj->getRows($sql4, $param4);
		
		 
    $cnt4=0;  
    foreach ($res4 as $row4)
    {  for($i=1;$i<=$row4['noofrooms'];$i++)
      {
      
       $cnt4=$cnt4+1;
      } 
    
    }

     settype($totcnt,'int');
     settype($cnt,'int');
     settype($cnt3,'int');
     settype($cnt4,'int');
     $free=$totcnt-$cnt-$cnt3-$cnt4;
}
  if( $free>=$_POST['nofrooms'])
{
		
		  $id=$obj->get_max("blockroom","br_id");
			
			
	       		$query="insert into blockroom values(:id,:hotel_id,:room_id,:noofrooms,:bookdate,:nameofclient,:status,:user_id,:createat,:notes)";
		$param= array(
			'id' => $id,
			'hotel_id'=>$_POST['hotelbook'],
			'room_id' =>$_POST['room'],
			'noofrooms' =>$_POST['nofrooms'],
			'bookdate'=>$_POST['bookdate'],
                        'nameofclient'=>$_POST['nameofclient'],
                        'status'=>'BLOCK',
                        'user_id'=>$_SESSION['uid'],
                        'createat'=>date("Y-m-d H:i:s"),
                        'notes'=>$_POST['notes']

			); 
			$inserted=$obj->insert($query,$param);

			if($inserted) {
					$status = true;
					$msg = "Room Blocked Successfully.";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";
		         }
	  
	 }
else
{
                                $status = false;
				$msg = "Room not available on selected date, please try again later.";

}
	
	
        echo json_encode(array('status' => $status, 'msg' => $msg));
		
}	
	
if (isset($_POST['action']) && $_POST['action'] == "notes") {
		extract(array_map("filterIn", $_POST));
		
                $sql = "SELECT * FROM  blockroom  WHERE br_id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        if($row["notes"]!="")
        {
           $post["notes"]  = "Note: ".$row["notes"];
        }
else
 {
     $post["notes"]  = "Note: Nothing to display...!";
 }	
	
        array_push($response, $post);
    }
    echo json_encode($response);
	}

if (isset($_POST['action']) && $_POST['action'] == "edit") {
		extract(array_map("filterIn", $_POST));
		
                $sql = "Update blockroom set status=:status WHERE br_id=:id";
		$param = array('id'=>$id,'status'=>'OCCUPIED');	
		
		$inserted=$obj->update($sql,$param);

					if($inserted) {
						$status = true;
						$msg = "Successfully updated";
					} else {
						$status = false;
						$msg = "Something went wrong while Adding the Record, please try again.";
					}
                  echo json_encode(array('status' => $status, 'msg' => $msg));
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('blockroom', 'br_id', $id);
		if ($isDeleted) {
			$status = true;
			$msg = ' Record no.: '.$id.', Successfully Deleted!'; 
		} else {
			$status = false;
			$msg = 'Error, while Deleted Record no.: '.$id; 
		}
	 echo json_encode(array('status' => $status, 'msg' => $msg));
	}

?>  