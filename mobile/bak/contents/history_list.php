<?
include $_SERVER['DOCUMENT_ROOT']."/_common/config.php";
include $_SERVER['DOCUMENT_ROOT']."/_library/Goods.php";
include $_SERVER['DOCUMENT_ROOT']."/_library/Member.php";


$getIdx = $_SESSION['M_login']['memberIdx'];

$pageLimit	= empty($_GET['pageLimit']) ? 20 : intval($_GET['pageLimit']);
$schCodeLK	= empty($_GET['codeLK']) ? NULL : trim($_GET['codeLK']);
$schWinYN	= empty($_GET['winYN']) ? NULL : trim($_GET['winYN']);
$schDateS	= empty($_GET['schDateS']) ? NULL : trim($_GET['schDateS']);
$schDateE	= empty($_GET['schDateE']) ? NULL : trim($_GET['schDateE']);
$sortType	= empty($_GET['sortType']) ? NULL : trim($_GET['sortType']);

$addSql		= " AND o.memberIdx = '".$getIdx."' ";

if (empty($schCodeLK) == false){
	$addSql			.= " AND o.codeLK = '".$schCodeLK."' ";
}

if (empty($schWinYN) == false ){
	if ($schWinYN == 'Y'){
		$addSql		.= " AND cashMoneySum > 0  AND  ( playFlagS = 2 OR playFlagE = 2 ) ";
	}
	else{
		$addSql		.= " AND cashMoneySum IS NULL  AND ( playFlagS = 2 OR playFlagE = 2 )  ";
	}
}

if (empty($schDateS) == false){
	$addSql			= " AND o.regDate >= CONCAT('".$schDateS."', ' 00:00:00') ";
}

if (empty($schDateE) == false){
	$addSql			= " AND o.regDate <= CONCAT('".$schDateE."', ' 23:59:59') ";
}		
		
if ($sortType == 2) {
	$addSort	= " ORDER BY oSeq ASC ";
}
else {
	$addSort	= " ORDER BY oSeq DESC ";
}


$rtns['errNo']	= 0;

$won	= dbExchangeRateGETwonBYerIdx(1);


$totalCnt	= getDBOrderMemberGetCnt($addSql);
$dbRtns		= getDBOrderMemberGetList($addSql, $addSort, $pageLimit);

$rtns['totalCnt']	= $totalCnt;
$rtns['datas']		= array();

if (sizeof($dbRtns['oSeq']) > 0) {
	
	for($i=0;$i<sizeof($dbRtns['oSeq']);$i++){
		
		$oSeq			= $dbRtns['oSeq'][$i];
		$regTime		= strtotime($dbRtns['regDate'][$i]);
		$codeLK			= $dbRtns['codeLK'][$i];
		$lkName			= $dbRtns['lkName'][$i];
		$playDate		= $dbRtns['playDateS'][$i];
		$playTime		= strtotime($dbRtns['playDateTimeS'][$i]);
		$gameCnt		= $dbRtns['gameCnt'][$i];
		$ticketCnt		= $dbRtns['gameCnt'][$i];
		$playFlag		= $dbRtns['playFlagS'][$i];
		$ticketImgs		= explode(',', $dbRtns['ticketImgs'][$i]);
		$ticketImgDates	= explode(',', $dbRtns['ticketImgDates'][$i]);
		$winMoney		= $dbRtns['cashMoneySum'][$i];
		$settlePrice	= $dbRtns['settlePrice'][$i];
		$winNos			= $dbRtns['winNos'][$i];
		$imgServer		= $dbRtns['imgServer'][$i];
		$won			= empty($dbRtns['won'][$i]) ? $won : $dbRtns['won'][$i];
		
		
		$ticketUrls	= NULL;
		if (sizeof($ticketImgs) > 0) {
			for($s = 0; $s < sizeof($ticketImgs); $s++) {
				$ti 			= $ticketImgs[$s];
					
				if (empty($ti) == false) {
					if($imgServer == "N"){
						$dir = 'http://aimg.2pmcompany.com/';
					}else{
						$dir = 'http://img.2pmcompany.com/scan3/scan1_end/';
					}
					
					if (strpos($ti, "/") === false) {
						
						$ticketTime 	= strtotime($ticketImgDates[$s]);
						$ticketDir		= date('ymd', $ticketTime);
						$ticketUrls[]	= $dir . $ticketDir . '/'. $ti;
					}
					else {
						$ticketDir		= '';
						$ticketUrls[]	= $dir. $ti;
					}
				}
			}
		}
		else {
			$ticketUrls	= NULL;
		}
		
		$rtns['datas'][$i]['oSeq']			= $oSeq;
		$rtns['datas'][$i]['codeLK']		= $codeLK;
		$rtns['datas'][$i]['lkName']		= $lkName;
		$rtns['datas'][$i]['playDate']		= $playDate;
		$rtns['datas'][$i]['playDateTime']	= date('Y-m-d H:i:s', $playTime);
		$rtns['datas'][$i]['gameCnt']		= $gameCnt;
		$rtns['datas'][$i]['ticketCnt']		= $ticketCnt;
		$rtns['datas'][$i]['ticketUrls']	= $ticketUrls;
		$rtns['datas'][$i]['playFlag']		= $playFlag;
		$rtns['datas'][$i]['winMoney']		= $winMoney;
		$rtns['datas'][$i]['regDate']		= date('Y-m-d H:i:s', $regTime);
		$rtns['datas'][$i]['settlePrice']	= $settlePrice;
		$rtns['datas'][$i]['won']			= $won;
		$rtns['datas'][$i]['winNos']		= $winNos;
		
		
	}
	
}

echo json_encode($rtns);
?>