<?
include $_SERVER['DOCUMENT_ROOT']."/_common/config.php";
include $_SERVER['DOCUMENT_ROOT']."/_library/Member.php";

$rtns['errNo']	= 0;

$method				= $_SERVER['REQUEST_METHOD'];
$memberIdx			= $_SESSION['M_login']['memberIdx'];


$dbM				= getDBMemberBYmemberIdx($memberIdx);
$dbRs				= getDBMemberBankBYmemberIdx($memberIdx);

$schDateS			= isset($_GET['schDateS']) ? $_GET['schDateS'] : '';
$schDateE			= isset($_GET['schDateE']) ? $_GET['schDateE'] : '';
$sortType			= empty($_GET['sortType']) ? NULL : trim($_GET['sortType']);

$sql				= "SELECT * from Bank WHERE bankFlag > 0";
$dbBs				= $db->get_data($sql);

$addSql				= " AND mc.memberIdx = '".$memberIdx."' ";

if (empty($schDateS) == false) {
	$addSql			.= " AND mc.regDate >= CONCAT('".$schDateS."', ' 00:00:00') ";
}

if (empty($schDateE) == false) {
	$addSql			.= " AND mc.regDate <= CONCAT('".$schDateE."', ' 23:59:59') ";
}

if ($sortType == 2) {
	$addSort		= " ORDER BY mc.mcSeq ASC ";
}
else {
	$addSort		= " ORDER BY mc.mcSeq DESC ";
}

$totalCnt			= getDBMemberWithdrawGETcnt($addSql);
$dbRtns				= getDBMemberWithdrawGETlist($addSql, $addSort);

$rtns['datas']		= array();
$rtns['totalCnt']	= $totalCnt;

if (sizeof($dbRtns['mcSeq']) > 0) {
	
	for($i=0;$i<sizeof($dbRtns['mcSeq']);$i++){
		
		$regTime		= strtotime($dbRtns['regDate'][$i]);
		$bankCode		= $dbRtns['bankCode'][$i];
		$cashMoney		= $dbRtns['cashMoney'][$i];
		$bankName		= $dbRtns['bankName'][$i];
		$bankOriName	= $dbRtns['bankOriName'][$i];
		$bankFlag		= $dbRtns['bankFlag'][$i];
		$accountName	= $dbRtns['accountName'][$i];
		$accountNum		= $dbRtns['accountNum'][$i];
		$codeCS			= $dbRtns['codeCS'][$i];
		$csName			= $dbRtns['csName'][$i];
		$lastDate		= $dbRtns['lastDate'][$i];
		

		$rtns['datas'][$i]['regDate']		= date('Y-m-d H:i:s', $regTime);
		$rtns['datas'][$i]['bankCode']		= $bankCode;
		$rtns['datas'][$i]['cashMoney']		= abs($cashMoney);
		$rtns['datas'][$i]['bankName']		= $bankName;
		$rtns['datas'][$i]['bankOriName']	= $bankOriName;
		$rtns['datas'][$i]['bankFlag']		= $bankFlag;
		$rtns['datas'][$i]['accountName']	= $accountName;
		$rtns['datas'][$i]['accountNum']	= $accountNum;
		$rtns['datas'][$i]['codeCS']		= $codeCS;
		$rtns['datas'][$i]['csName']		= $csName;
		$rtns['datas'][$i]['lastDate']		= $lastDate;
		
	}
	
}

echo json_encode($rtns);
?>