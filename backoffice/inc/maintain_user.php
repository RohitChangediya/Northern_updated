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


  if ( $_POST['action'] == "datatable") {
		
	    $sql = " SELECT admin.id, admin.name,admin.username,admin.usertype,admin.active FROM  admin where id>1";		
		
		$columns = array('admin.id', 'admin.name','admin.username','admin.usertype','admin.active');
		$isResult = $obj->generateDatatable($sql, $columns, 'id');		
		echo $isResult;	  
		
	}
	
if(isset($_POST['action']) && $_POST['action'] == "checkavail")
{

       $blocked=0; $html="";
      $sql2 = "SELECT noofrooms,hotelroom_id,roomtype,actype  FROM  hotelroom where  hotel_id=:hotel_id";
		$param2 = array('hotel_id'=>$_POST['checkhotel']);
		$res2 = $obj->getRows($sql2, $param2);
                $totcnt=0;
                foreach ($res2 as $row2)
                 { $totcnt=$row2['noofrooms'];
       $html.="<div class='col-md-12 roomlabel'>".$row2['roomtype']."( ".$row2['actype']." )</div>";           
      $sql = "Select  hoteldetails.hotel_id,  hoteldetails.noofnights,  hoteldetails.fromdate,  hoteldetails.todate,  hoteldetails.room_id,  clientdetails.clientname,accomodetails.noofroom From  clientdetails Inner Join  hoteldetails    On hoteldetails.quot_id = clientdetails.quot_id Inner Join accomodetails On hoteldetails.quot_id = accomodetails.quot_id  Where  Str_To_Date('".$_POST['date']."', '%d-%m-%Y') Between  Str_To_Date(hoteldetails.fromdate, '%d-%m-%Y') And  Str_To_Date(hoteldetails.todate, '%d-%m-%Y') AND  hoteldetails.hotel_id=:hotel_id and clientdetails.status='1' and hoteldetails.room_id=:room_id";
		$param = array('hotel_id'=>$_POST['checkhotel'],'room_id'=>$row2['hotelroom_id']);
		$res = $obj->getRows($sql, $param);
		  
    $cnt=0;  
    foreach ($res as $row)
    { for($i=1;$i<=$row['noofroom'];$i++)
      {
       $html.="<div class='booked'>";
       $html.="<h5>".$row['clientname']."</h5>";    
       $html.="</div>";
       $cnt=$cnt+1;
      } 
    
    }

       $sql3 = "Select noofrooms,nameofclient From  blockroom  Where  Str_To_Date('".$_POST['date']."', '%d-%m-%Y')=Str_To_Date(bookdate, '%d-%m-%Y') and status='OCCUPIED' and hotel_id=:hotel_id and room_id=:room_id";
		$param3 = array('hotel_id'=>$_POST['checkhotel'],'room_id'=>$row2['hotelroom_id']);
		$res3 = $obj->getRows($sql3, $param3);
		
		 
    $cnt3=0;  
    foreach ($res3 as $row3)
    {  for($i=1;$i<=$row3['noofrooms'];$i++)
      {
      $html.="<div class='booked'>";
      $html.="<h5>".$row3['nameofclient']."</h5>";    
      $html.="</div>";
       $cnt3=$cnt3+1;
      } 
    
    }
    
    $sql4 = "Select noofrooms,nameofclient From  blockroom  Where  Str_To_Date('".$_POST['date']."', '%d-%m-%Y')=Str_To_Date(bookdate, '%d-%m-%Y') and status='BLOCK' and hotel_id=:hotel_id and room_id=:room_id";
		$param4 = array('hotel_id'=>$_POST['checkhotel'],'room_id'=>$row2['hotelroom_id']);
		$res4 = $obj->getRows($sql4, $param4);
		
		 
    $cnt4=0;  
    foreach ($res4 as $row4)
    {  for($i=1;$i<=$row4['noofrooms'];$i++)
      {
      $html.="<div class='blocked'>";
      $html.="<h5>".$row4['nameofclient']."</h5>";    
      $html.="</div>";
       $cnt4=$cnt4+1;
      } 
    
    }

     settype($totcnt,'int');
     settype($cnt,'int');
     settype($cnt3,'int');
     settype($cnt4,'int');
     $free=$totcnt-$cnt-$cnt3-$cnt4;
     
     for($i=1;$i<=$free;$i++)
     {
       $html.="<div class='free'>";
         $html.="<h5>&nbsp;</h5>"; 
        $html.="</div>";

     }
      $html.="<div style='clear:both'></div>";
      $html.="<hr style='margin: 5px 0;'>";
      $html.="<div class='col-md-6 totalrooms'>Total Rooms : <span>" .$totcnt."</span></div>";
    $html.="<div class='col-md-6 totalrooms'> Total Rooms Occupied : <span>" .($cnt+$cnt3)."</span></div>";
    $html.="<div class='col-md-6 totalrooms'> Total Rooms Available: <span>" .$free."</span></div>";
    $html.="<div class='col-md-6 totalrooms'> Total Rooms Block:<span>".$cnt4."</span> </div>";
    $html.="<div style='clear:both'></div>";
  $html.="<hr style='margin: 5px 0;'>";
   }
  $status = true;
 echo json_encode(array('status' => $status, 'msg' => $html));
}
if(isset($_POST['action']) && $_POST['action'] == "change")
	{
        $query="update admin set password=:pass where id=:id and password=:opass";
		$param= array(
			'id' => $_SESSION['uid'],
			'pass' =>$_POST['npass'],
			'opass' =>$_POST['opass']			
			
			); 
			$inserted=$obj->update($query,$param);

			if($inserted) {
					$status = true;
					$msg = "Password Successfully Updated";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";
		
	  		}
	  		 echo json_encode(array('status' => $status, 'msg' => $msg));
	}
if($_POST['action']=="save")
{ // print_r($_FILES);

	if($_POST['id']=="")
	{
		if(!($obj->checkExiststance2("admin","username",$_POST['username'])))
		{
	         $status = false;
             $msg = "Username is already exists....!";
			 echo json_encode(array('status' => $status, 'msg' => $msg));
			 return;
		}                
		else
		{

                       if($_FILES['file']['tmp_name']=="")
	              {
		       $id=$obj->get_max("admin","id");
			
			 
	       		$query="insert into admin values(:id,:name,:username,:password,:usertype,:nameofcompany,:corp_office,:reg_office,:hotline,:emailat,:website,:active)";
		$param= array(
			'id' => $id,
			'name'=>$_POST['name'],
			'username' =>$_POST['username'],
			'password' =>$_POST['password'],
			'usertype' =>$_POST['usertype'],
                         'nameofcompany' =>$_POST['nameofcompany'],
                          'corp_office' =>$_POST['corp_office'],
                          'reg_office' =>$_POST['reg_office'],
                           'hotline' =>$_POST['hotline'],
                             'emailat' =>$_POST['emailat'],
                            'website' =>$_POST['website'],
			'active' =>$_POST['active'],
			
			); 
			$inserted=$obj->insert($query,$param);

			if($inserted) {
					$status = true;
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";
		
	                     }
              }
              else
               {
                     $data = file_get_contents($_FILES['file']['tmp_name']);
                      $id=$obj->get_max("admin","id");
			
			 
	       		$query="insert into admin values(:id,:name,:username,:password,:usertype,:nameofcompany,:corp_office,:reg_office,:hotline,:emailat,:website,:logoofcompany,:active)";
		$param= array(
			'id' => $id,
			'name'=>$_POST['name'],
			'username' =>$_POST['username'],
			'password' =>$_POST['password'],
			'usertype' =>$_POST['usertype'],
                         'nameofcompany' =>$_POST['nameofcompany'],
                          'corp_office' =>$_POST['corp_office'],
                          'reg_office' =>$_POST['reg_office'],
                           'hotline' =>$_POST['hotline'],
                             'emailat' =>$_POST['emailat'],
                            'website' =>$_POST['website'],
                            'logoofcompany' => $data,
			'active' =>$_POST['active'],
			
			); 
			$inserted=$obj->insert($query,$param);

			if($inserted) {
					$status = true;
					$msg = "Successfully Added";
			} else {
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";
		
	                     }
               }
	 }
	}
	else
	{
		if($obj->getInfo("username","admin","id",$_POST["id"])!=$_POST['username'])
                    { if(!($obj->checkExiststance2("admin","username",$_POST['username'])))
		          {
	                         $status = false;
                                 $msg = "Username is already exists....!";
			         echo json_encode(array('status' => $status, 'msg' => $msg));
			           return;
		         }
                }               
                else{

                    if($_FILES['file']['tmp_name']=="")
	              {
		$query="update admin set name=:name,username=:username,password=:password,usertype=:usertype,nameofcompany=:nameofcompany,corp_office=:corp_office,reg_office=:reg_office,hotline=:hotline,emailat=:emailat,website=:website,active=:active where id=:id";
					$param= array(
			'id' => $_POST["id"],
			'name'=>$_POST['name'],
			'username' =>$_POST['username'],
			'password' =>$_POST['password'],
			'usertype' =>$_POST['usertype'],
                          'nameofcompany' =>$_POST['nameofcompany'],
                          'corp_office' =>$_POST['corp_office'],
                          'reg_office' =>$_POST['reg_office'],
                           'hotline' =>$_POST['hotline'],
                             'emailat' =>$_POST['emailat'],
                            'website' =>$_POST['website'],
			'active' =>$_POST['active'],
			
			); 
					$inserted=$obj->update($query,$param);

					if($inserted) {
						$status = true;
						$msg = "Successfully updated";
					} else {
						$status = false;
						$msg = "Something went wrong while Adding the Record, please try again.";
					}
                         }
                         else
                         {
                             $data = file_get_contents($_FILES['file']['tmp_name']);
                             $query="update admin set name=:name,username=:username,password=:password,usertype=:usertype,nameofcompany=:nameofcompany,corp_office=:corp_office,reg_office=:reg_office,hotline=:hotline,emailat=:emailat,website=:website,logoofcompany=:logoofcompany,active=:active where id=:id";
					$param= array(
			'id' => $_POST["id"],
			'name'=>$_POST['name'],
			'username' =>$_POST['username'],
			'password' =>$_POST['password'],
			'usertype' =>$_POST['usertype'],
                          'nameofcompany' =>$_POST['nameofcompany'],
                          'corp_office' =>$_POST['corp_office'],
                          'reg_office' =>$_POST['reg_office'],
                           'hotline' =>$_POST['hotline'],
                             'emailat' =>$_POST['emailat'],
                            'website' =>$_POST['website'],
                           'logoofcompany' => $data,
			'active' =>$_POST['active'],
			
			); 
					$inserted=$obj->update($query,$param);

					if($inserted) {
						$status = true;
						$msg = "Successfully updated";
					} else {
						$status = false;
						$msg = "Something went wrong while Adding the Record, please try again.";
					}

                         }



			}
		
	}
        echo json_encode(array('status' => $status, 'msg' => $msg));
		
}	
	

if (isset($_POST['action']) && $_POST['action'] == "edit") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT admin.id, admin.name,admin.username,admin.password,admin.usertype,admin.nameofcompany,admin.corp_office,admin.reg_office,admin.hotline,admin.emailat,admin.website,admin.active FROM  admin where id={$id}";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		
		$response= array();
    
    foreach ($res as $row)
    {
        $post = array();
        $post["id"]  = $row["id"];
        $post["name"]  = $row["name"];
        $post["username"]  = $row["username"];
        $post["password"]  = $row["password"];
        $post["usertype"]  = $row["usertype"];
        $post["nameofcompany"]  = $row["nameofcompany"];
        $post["corp_office"]  = $row["corp_office"];
        $post["reg_office"]  = $row["reg_office"];
        $post["hotline"]  = $row["hotline"];
        $post["emailat"]  = $row["emailat"];
        $post["website"]  = $row["website"];
        $post["active"]  = $row["active"];
		
	
        array_push($response, $post);
    }
    echo json_encode($response);
		
	}
	if (isset($_POST['action']) && $_POST['action'] == "delete") {
		extract(array_map("filterIn", $_POST));
		$isDeleted = $obj->delete('admin', 'id', $id);
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