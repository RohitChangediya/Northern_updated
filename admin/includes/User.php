<?php 
	if(isset($_POST) && $_POST['file']=="search")
		require '../inc/inc.con.php';
	else
		require '../../inc/inc.con.php';
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
	function listAllUsers()
    {
    	$obj = new db();
	    $obj->connect();
		return $obj->ListRecords("select id,user_name as name FROM registration");
    }
    function ListAllCategories()
    {
    	$obj = new db();
	    $obj->connect();
		return $obj->ListRecords("select category_id as id,title as name FROM bf_category");
    }
    
if(!empty($_POST))
{
	if ( $_POST['action'] == "allusersdatatable") {
		$sql = "SELECT r.id,CONCAT(r.first_name,' ',r.last_name) as name,r.email,r.phone_number,CONCAT(r.address,', ',r.city) as address,CASE WHEN is_verified=1 THEN 'Verified' else 'Unverified' END as status
				FROM registration As r    
				LEFT JOIN user_documents u ON u.uid = r.id
				where  r.is_del='No' GROUP BY r.id";
		$columns = array('id','name','email','phone_number','address','status');
		$isResult = $obj->generateDatatables($sql, $columns, 'id',array(array('view'=>1)));		
		echo $isResult;	
	}
  	if ( $_POST['action'] == "datatable") {
		$sql = "SELECT r.id,CONCAT(r.first_name,' ',r.last_name) as name,r.email,r.phone_number,CONCAT(r.address,', ',r.city) as address
				FROM user_documents u
				INNER JOIN registration As r ON u.uid = r.id   
				where  u.is_deleted=0 AND u.is_verified=0 GROUP BY u.uid";
		$columns = array('id','name','email','phone_number','address');
		$isResult = $obj->generateDatatables($sql, $columns, 'id',array(array('view'=>1)));		
		echo $isResult;	
	}
		if ( $_POST['action'] == "verifieddatable") {
		$sql = "SELECT r.id,CONCAT(r.first_name,' ',r.last_name) as name,r.email,r.phone_number,CONCAT(r.address,', ',r.city) as address
				FROM user_documents u
				INNER JOIN registration As r ON u.uid = r.id   
				where  u.is_deleted=0 AND u.is_verified=1 GROUP BY u.uid";
		$columns = array('id','name','email','phone_number','address');
		$isResult = $obj->generateDatatables($sql, $columns, 'id',array(array('view'=>1)));		
		echo $isResult;	
	}

	if ($_POST['action'] == "getMessages") {
		$data=getMessages();
		echo json_encode($data);
	}

	if ( $_POST['action'] == "getUser") {
		extract(array_map("filterIn", $_POST));
		$sql = "SELECT r.id as uid,u.id as doc_id,CONCAT(r.first_name,' ',r.last_name) as name,r.email,r.phone_number,CONCAT(r.address,', ',r.city) as address,
				DATE_FORMAT(r.birth_date,'%d/%m/%Y') as birth_date,age,gender,u.doc_file,u.doc_title,r.pin_code,r.profile_photo,r.is_verify as profile_photo_verified,r.status
				FROM registration As r 
				LEFT JOIN user_documents u ON u.uid = r.id   
				where  r.is_del='No' ";
				if($is_verified!=2)
					$sql.="AND u.is_verified={$is_verified}";
				$sql.=" AND r.id={$id} GROUP BY r.id";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		$result=$res[0];
		$result['doc_file']=base64_encode($result['doc_file']);
		$result['profile_photo']=base64_encode($result['profile_photo']);
		echo json_encode($result);
	}
	if ( $_POST['action'] == "verifydoc") {
		extract(array_map("filterIn", $_POST));
			$query="update user_documents set is_verified=:is_verified WHERE id=:id";
			$param= array(
				'id' => $doc_id,
				'is_verified' =>1
			); 
			$inserted=$obj->insert($query,$param);

			$query="update registration set is_user_verified=:is_user_verified WHERE id=:id";
			$param= array(
				'id' => $uid,
				'is_user_verified' =>1
			); 
			$inserted=$obj->insert($query,$param);

			if($inserted) {
				$status = true;
				$msg = "Successfully Verified !";
			}
			else{
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";
			}
			echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	if ( $_POST['action'] == "changeprofilephotostage") {
		extract(array_map("filterIn", $_POST));
			$query="update registration set is_verify=:is_verify WHERE id=:id";
			$param= array(
				'id' => $uid,
				'is_verify' =>$is_verified
			); 
			$inserted=$obj->insert($query,$param);
			if($inserted) {
				$status = true;
				if($is_verified==2)
					$msg = "Successfully Rejected !";
				else 
					$msg="Successfully Verified !";
			}
			else{
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";
			}
			echo json_encode(array('status' => $status, 'msg' => $msg));
	}
	if ( $_POST['action'] == "user_autocomplete") {
		$keyword=strval($_POST['query']);
		$sql = "SELECT id,user_name FROM registration WHERE user_name LIKE '%".$keyword."%'";
		$param = array($id);
		$res = $obj->getRows($sql, $param);
		$json=array();
		foreach ($res as $result) {
			$json[]=array(
				'id'=>$result['id'],
				'title'=>$result['user_name']
				);
		}
		echo json_encode($json);
	}
	if($_POST['action']=="search"){
		$_POST['date']=date("d/m/Y", strtotime(str_replace("-", "/", $_POST['date'])));
		$json=array(
			'posts'=>listPost(),
			'videos'=>listVideos(),
			'photos'=>listPhotos(),
			'jobs'=>listJobPost()
		);
		echo json_encode($json);
	}
	if($_POST['action']=="deleteobject"){
		$_POST['date']=date("d/m/Y", strtotime(str_replace("-", "/", $_POST['date'])));
		//extract(array_map("filterIn", $_POST));
		$query="update ".$_POST['tablename']." set is_deleted=:is_deleted WHERE id=:id";
		$param= array(
			'id' => $_POST['oid'],
			'is_deleted' =>1
		); 
		$deleted=$obj->insert($query,$param);
		if($deleted) {
			$status = true;
			if($_POST['otype']=="video")
				$data =listVideos();
			if($_POST['otype']=="photos")
				$data =listPhotos();
			if($_POST['otype']=="posts")
				$data =listPost();
			if($_POST['otype']=="jobs")
				$data =listJobPost();
			$msg =array(
				'data'=>$data,
				'otype'=>$_POST['otype']
			);
		}
		else{
			$status = false;
			$msg = "Something went wrong while Adding the Record, please try again.";
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}

	if ( $_POST['action'] == "changestatus") {
		extract(array_map("filterIn", $_POST));
			$query="update registration set status=:status WHERE id=:id";
			$param= array(
				'id' => $uid,
				'status' =>$status
			); 
			$inserted=$obj->insert($query,$param);
			if($inserted) {
				if($status==1)
					$msg = "This user profile is now displayed on index";
				else 
					$msg="This user profile is now hidden from the index";
				$status = true;
			}
			else{
				$status = false;
				$msg = "Something went wrong while Adding the Record, please try again.";
			}
			echo json_encode(array('status' => $status, 'msg' => $msg));
	}
}
function getMessages(){
	$obj = new db();
	    $obj->connect();
		extract(array_map("filterIn", $_POST));
		$sql="SELECT  r.id as uid,CONCAT(r.first_name,' ',r.last_name) as name,r.profile_photo
			FROM registration As r 
			JOIN(
			SELECT from_id as id
			FROM message_box m
			WHERE m.to_id=$id and is_deleted='0' GROUP BY from_id
			UNION 
			SELECT to_id as id
			FROM message_box m
			WHERE m.from_id=$id and is_deleted='0' GROUP BY to_id
		) as t1 ON r.id IN(t1.id)
		";
		$users=$obj->ListRecords($sql);
		$data=array();
		foreach ($users as $user) {
			$user["profile_photo"]=base64_encode($user["profile_photo"]);
			$user_id=$user['uid'];
			$sql="SELECT m.* ,r_from.profile_photo from_profile,CONCAT(r_from.first_name,' ',r_from.last_name) as from_name,m.added_date,r_to.profile_photo as to_profile,CONCAT(r_to.first_name,' ',r_to.last_name) as to_name,CASE WHEN m.to_id=$id THEN 'in' ELSE 'out' END as type
			FROM message_box m
			JOIN registration as r_from ON r_from.id=m.from_id
			JOIN registration as r_to ON r_to.id=m.to_id
			WHERE ((m.to_id=$id and m.from_id=$user_id) OR (m.from_id=$id and m.to_id=$user_id))  and is_deleted='0' ORDER BY m.added_date";
			$messages=$obj->ListRecords($sql);
			$msg=array();
			foreach ($messages as $key=>$value) {
				$messages[$key]["from_profile"]=base64_encode($value["from_profile"]);
				$messages[$key]["to_profile"]=base64_encode($value["to_profile"]);
				//$msg[]=$message;
			}
			$user['messages']=$messages;
			$data[]=$user;
		}
		return $data;
}
function listJobPost(){
	$obj = new db();
	    $obj->connect();
	$sql="SELECT bfn.id,r.id as uid,r.user_name,r.first_name,r.last_name,r.profile_photo,bfn.title,bfn.description,bfn.added_date,bfn.is_deleted,r.is_verify
	FROM bf_news AS bfn 
	INNER JOIN bf_category ON bfn.categorytype = bf_category.category_id 
    INNER JOIN registration AS r ON bfn.user_id = r.id   
    WHERE 1 ";
    if($_POST['is_deleted'])
    	$sql.=" AND bfn.is_deleted=1";
    else
    	$sql.=" AND bfn.is_deleted=0";
    if($_POST['is_date'])
    	$sql.=" AND bfn.added_date='".$_POST['date']."'";
    if($_POST['user_id']!="")
    	$sql.=" AND bfn.user_id=".$_POST['user_id'];
    if($_POST['cat_id']!="")
    	$sql.=" AND bfn.categorytype=".$_POST['cat_id'];
    $sql.=" order by  bfn.id desc";
	$result=$obj->ListRecords($sql);
	$data=array();
	foreach ($result as $res) {
		$res['profile_photo']=base64_encode($res['profile_photo']);
		//list reply
		$sqlapply="SELECT r.id,r.first_name,r.last_name,r.profile_photo
			FROM casting_crew_job_apply AS cca 
			INNER Join registration AS r ON cca.uid = r.id 
			WHERE cca.job_id= '".$res['id']."'";
		$applyres=$obj->ListRecords($sqlapply);
		$applyjob=array();
		foreach ($applyres as $row) {
			$row['profile_photo']=base64_encode($row['profile_photo']);
			$applyjob[]=$row;
		}
		$res['applyjobs']=$applyjob;
		$data[]=$res;
	}
	return $data;

} 
function listPost(){
	$obj = new db();
	    $obj->connect();
	$sql = "SELECT ad.id,r.id as uid,r.user_name,
	r.first_name,r.last_name,
	r.profile_photo,ad.post,ad.post_img,ad.add_date,ad.is_deleted,r.is_verify
	FROM aad_post as ad 
	INNER JOIN bf_category as bf_cat ON ad.type = bf_cat.category_id 
	INNER JOIN registration as r ON ad.uid = r.id   
    WHERE 1 ";
    if($_POST['is_deleted'])
    	$sql.=" AND ad.is_deleted=1";
    else
    	$sql.=" AND ad.is_deleted=0";
    if($_POST['is_date'])
    	$sql.=" AND ad.add_date='".$_POST['date']."'";
    if($_POST['user_id']!="")
    	$sql.=" AND ad.uid=".$_POST['user_id'];
    if($_POST['cat_id']!="")
    	$sql.=" AND ad.type=".$_POST['cat_id'];
    $sql.=" order by  ad.id desc";
	$result=$obj->ListRecords($sql);
	$data=array();
	foreach ($result as $res) {
		$res['profile_photo']=base64_encode($res['profile_photo']);
		$res['post_img']=base64_encode($res['post_img']);
		$data[]=$res;
	}
	return $data;

}

function listVideos(){
	$obj = new db();
	    $obj->connect();
	$sql = "SELECT v.id, r.id as uid, r.user_name, r.first_name, r.last_name, r.profile_photo,
	 bf_cat.title, v.file_link, v.add_date,v.is_deleted,r.is_verify
	FROM video_gallery AS v
	Inner Join bf_category AS bf_cat On v.categorytype = bf_cat.category_id 
	Inner Join registration AS r On v.uid = r.id   
    WHERE 1 ";
    if($_POST['is_deleted'])
    	$sql.=" AND v.is_deleted=1";
    else
    	$sql.=" AND v.is_deleted=0";
    if($_POST['is_date'])
    	$sql.=" AND v.add_date='".$_POST['date']."'";
    if($_POST['user_id']!="")
    	$sql.=" AND v.uid=".$_POST['user_id'];
    if($_POST['cat_id']!="")
    	$sql.=" AND v.categorytype=".$_POST['cat_id'];
    $sql.=" order by  v.id desc";
	$result=$obj->ListRecords($sql);
	$data=array();
	foreach ($result as $res) {
		$res['profile_photo']=base64_encode($res['profile_photo']);
		$data[]=$res;
	}
	return $data;
}
function listPhotos(){
	$obj = new db();
	    $obj->connect();
	$sql = "SELECT pg.id,r.id as uid,r.user_name,
	r.first_name,r.last_name,r.profile_photo,bf_cat.title,
	pg.photo,pg.added_date,pg.is_deleted,r.is_verify
	From photo_gallery AS pg
	Inner Join bf_category AS bf_cat On pg.categorytype = bf_cat.category_id 
	Inner Join registration AS r On pg.uid = r.id WHERE 1";
    if($_POST['is_deleted'])
    	$sql.=" AND pg.is_deleted=1";
    else
    	$sql.=" AND pg.is_deleted=0";
    if($_POST['is_date'])
    	$sql.=" AND pg.added_date='".$_POST['date']."'";
    if($_POST['user_id']!="")
    	$sql.=" AND pg.uid=".$_POST['user_id'];
    if($_POST['cat_id']!="")
    	$sql.=" AND pg.categorytype=".$_POST['cat_id'];
    $sql.=" order by  pg.id desc";
	$result=$obj->ListRecords($sql);
	$data=array();
	foreach ($result as $res) {
		$res['profile_photo']=base64_encode($res['profile_photo']);
		$res['photo']=base64_encode($res['photo']);
		$data[]=$res;
	}
	return $data;
}
?>