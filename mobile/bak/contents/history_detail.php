<?
include $_SERVER['DOCUMENT_ROOT']."/_common/config.php";
include $_SERVER['DOCUMENT_ROOT']."/_library/Goods.php";
include $_SERVER['DOCUMENT_ROOT']."/_library/Orders.php";

$memberIdx = $_SESSION['M_login']['memberIdx'];

$oSeq	= $_GET['oSeq'];

$dbRtns	= getDBOrderGamesBYoSeq($oSeq);

$memberIdxChk	= $dbRtns['memberIdx'][0];

if($memberIdx != $memberIdxChk){

	$rtns['errNo']		= 99;
	$rtns['errMsg']		= '잘못된 접근입니다';

}else{
	$rtns['errNo']		= 0;
	$rtns['datas']		= array();
	$rtns['totalCnt']	=	0;

	if (sizeof($dbRtns['lkName']) > 0){

		$rtns['lkName']	= $dbRtns['lkName'][0];

		//foreach($dbRtns as $dbRs) {
		for($i = 0;$i < sizeof($dbRtns['lkName']);$i++){

			$qpYNs		= explode(',', $dbRtns['qpYNs'][$i]);
			$ballNums	= explode(',', $dbRtns['ballNums'][$i]);
			$winYNs		= explode(',', $dbRtns['winYNs'][$i]);

			$rtns['datas'][$i]['ticketNum']	= $dbRtns['ticketNum'][$i];
			$rtns['datas'][$i]['gameNo']	= $dbRtns['gameNo'][$i];
			$rtns['datas'][$i]['winNo']		= $dbRtns['winNo'][$i];
			$rtns['datas'][$i]['winYNs']	= $winYNs;

			$rtns['datas'][$i]['qpYN']		= $qpYNs[0];
			$rtns['datas'][$i]['ballNumDs']	= array_splice($ballNums, 0, 5);
			$rtns['datas'][$i]['ballNumP']	= array_splice($ballNums, -1);
		}

		$rtns['totalCnt']	= sizeof($dbRtns['lkName']);
	}
}

echo json_encode($rtns);
?>