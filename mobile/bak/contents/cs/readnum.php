<?
include_once $_SERVER['DOCUMENT_ROOT']."/_common/config.php";

$bo_type	= isset($_GET['bo_type']) ? intval($_GET['bo_type']) : NULL;
$no			= isset($_GET['no']) ? intval($_GET['no']) : NULL;
$table		= "";

switch($bo_type){
	case 'notice' :
		$table	= 'BBSNotices';
		$method	= 'exeDBBBSNOTICE';
		$field  = 'bnSeq';
	break;
	
	case 'faq' :
		$table	= 'BBSFAQ';
		$method	= 'exeDBBBSFAQ';
		$field  = 'bfSeq';
	break;
}

if(!$table || !$no){
	echo json_encode(array("error"=>"none"));
	exit;
}

if(empty($_COOKIE[$method][$no])){
	setcookie($method.'['.$no.']',$no,time() + 365*24*3600,"/",$_SERVER['HTTP_HOST']);

	$sql = "UPDATE ".$table." SET readNum = readNum + 1 WHERE ".$field." = '".$no."' ";
	$db->query($sql);

	echo json_encode(array("error"=>"ok"));
	exit;
}

echo json_encode(array("error"=>"none"));
exit;
?>