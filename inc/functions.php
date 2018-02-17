<?php
if(isset($_GET['r']) && ($_GET['r']=="index" ))
{
    session_start();
	require 'inc.con.php';
}
else{
	session_start();
	require '../../inc/inc.con.php';
}
if(isset($_GET['action'])){
	switch ($_GET['action']) {
		case 'listCountries':
			listAll('countries');
			break;
		
		case 'logout':
			logout();
		break;
		case 'getuser':
			getUser();
		break;
		default:
			# code...
			break;
	}
}
function listPlaces($id="")
	{
		$obj = new db();
		$obj->connect();
		$sql = "Select  tbl_tour.tour_id,tbl_tour.tour_title,  tbl_tour.tour_destination,  tbl_tour.tour_price,  tour_images.image_path From  tbl_tour Inner Join  tour_images    On tbl_tour.tour_id = tour_images.tour_id group by tour_images.tour_id order by tour_images.tour_id DESC";
		$param = array($id);
		$res = $obj->getRows($sql,$param);
		return $res;
	}
	function listClients($id="")
	{
		$obj = new db();
		$obj->connect();
		$sql = "Select  tbl_clients.name, tbl_clients.logo From  tbl_clients order by id ASC";
		$param = array($id);
		$res = $obj->getRows($sql,$param);
		return $res;
	}
	function listTestimonials($id="")
	{
		$obj = new db();
		$obj->connect();
		$sql = "Select  tbl_testimonials.name, tbl_testimonials.profession,tbl_testimonials.profession,tbl_testimonials.description From  tbl_testimonials order by id ASC";
		$param = array($id);
		$res = $obj->getRows($sql,$param);
		return $res;
	}
	function listGallery($id="")
	{
		$obj = new db();
		$obj->connect();
		$sql = "Select  gallery.image_title, gallery.image_path From  gallery order by id ASC Limit 9";
		$param = array($id);
		$res = $obj->getRows($sql,$param);
		return $res;
	}
function listAll($table_name,$column_name="",$column_val="")
{
	$obj = new db();
	$obj->connect();
	if($column_name!="")
		$sql = "SELECT * FROM  $table_name WHERE $column_name=$column_val";
	else
		$sql = "SELECT * FROM  $table_name WHERE 1";
	$result= $obj->ListRecords($sql);
	jsonListResult($result);
}

function list_array($table_name)
{
	$obj = new db();
	$obj->connect();
	$sql = "SELECT * FROM  $table_name WHERE 1";
	return $obj->ListRecords($sql);
}

function listCountriesCities($country_id)
{
	$obj = new db();
	$obj->connect();
	$sql = "SELECT c.* FROM  cities c JOIN states s ON c.state_id=s.id AND s.country_id=$country_id ORDER BY c.name asc";
	$result= $obj->ListRecords($sql);
	jsonListResult($result);
}

function listBedrooms()
{
	$obj = new db();
	$obj->connect();
	$sql = "SELECT DISTINCT(no_of_rooms) as bed_rooms FROM property ORDER BY no_of_rooms ASC";
	$result= $obj->ListRecords($sql);
	jsonListResult($result);
}
function listBathrooms()
{
	$obj = new db();
	$obj->connect();
	$sql = "SELECT DISTINCT(no_of_bathrooms) as bath_rooms FROM property ORDER BY no_of_bathrooms ASC";
	$result= $obj->ListRecords($sql);
	jsonListResult($result);
	
}

function listPricies()
{
	$obj = new db();
	$obj->connect();
	$sql = "SELECT DISTINCT(price) as price FROM property ORDER BY price ASC";
	$result= $obj->ListRecords($sql);
	jsonListResult($result);
	
}
function searchProperties()
{
	$obj = new db();
	$obj->connect();
	$sql = "SELECT p.*,CONCAT(p.address,' ',c.name,', ',s.name,', ',co.name) as address,pt.title as type ,c.name as city,s.name as state,co.name as country
		FROM property p
		LEFT JOIN cities c ON c.id=p.city_id
		LEFT JOIN states s ON s.id=p.state_id
		LEFT JOIN countries co ON co.id=p.country_id
		LEFT JOIN property_type pt ON pt.id=p.type_id
		WHERE 1 ";
		if(isset($_POST)){
			if(isset($_POST['country_id']) && $_POST['country_id']!=""){
				$sql.=" AND p.country_id=".$_POST['country_id'];
			}
			if(isset($_POST['city_id']) && $_POST['city_id']!=""){
				$sql.=" AND p.city_id=".$_POST['city_id'];
			}
			if(isset($_POST['type_id']) && $_POST['type_id']!=""){
				$sql.=" AND p.type_id=".$_POST['type_id'];
			}
			if(isset($_POST['bedrooms']) && $_POST['bedrooms']!=""){
				$sql.=" AND p.no_of_rooms=".$_POST['bedrooms'];
			}
			if(isset($_POST['bathrooms']) && $_POST['bathrooms']!=""){
				$sql.=" AND p.no_of_bathrooms=".$_POST['bathrooms'];
			}
			if(isset($_POST['min_price']) && $_POST['min_price']!=""){
				$sql.=" AND p.price>=".$_POST['min_price'];
			}
			if(isset($_POST['max_price']) && $_POST['max_price']!=""){
				$sql.=" AND p.price<=".$_POST['max_price'];
			}
		}
	return $obj->ListRecords($sql);
}

function list_globalconf()
{
	$obj = new db();
	$obj->connect();
	$sql = "SELECT * FROM  global_conf WHERE 1";
	$result=$obj->ListRecords($sql);
	$data=array();
	foreach ($result as $key => $value) {
		$data[$value['conf_key']]=$value['conf_value'];
	}
	return $data;
}

function getUser(){
	$obj = new db();
	$obj->connect();
	$sql = "SELECT * FROM  user WHERE id=".$_SESSION['uid'];
	$result=$obj->ListRecords($sql);
	jsonListResult($result[0]);
}

function logout(){
	$obj = new db();
	if(!empty($_SESSION))
	{
		$user_role=$_SESSION['role'];
		$_SESSION=array();
		session_destroy();
	}
	$obj->redirect('../');
}

function jsonListResult($result){
	$status=false;
	if(!empty($result)){
		$status=true;
	}
	echo json_encode(array('status' => $status, 'result' => $result));
}
?>