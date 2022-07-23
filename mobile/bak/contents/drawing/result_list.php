<?
include_once $_SERVER['DOCUMENT_ROOT']."/_common/config.php";
include_once $_SERVER['DOCUMENT_ROOT']."/_library/Goods.php";


try
{
	
	
	
	$pageLimit		= empty($_GET['pageLimit']) ? 20 : intval($_GET['pageLimit']); 
	$page			= empty($_GET['page']) ? 1 : intval($_GET['page']);
	$wiSeq			= empty($_GET['wiSeq']) ? 1 : intval($_GET['wiSeq']);
	$codeLK			= empty($_GET['codeLK']) ? NULL : trim($_GET['codeLK']);
	$playDate		= empty($_GET['playDate']) ? NULL : trim($_GET['playDate']);

	$won	= dbExchangeRateGETwonBYerIdx(1);
	
	$addSql	= " AND wi.playFlag > 0 ";
	
	if (empty($codeLK) == false) {
		$addSql		.= " AND wi.codeLK = '".$codeLK."' ";
	}

	if (empty($playDate) == false) {
		$addSql		.= " AND wi.playDate = '".$playDate."' ";
	}
	

	$totalCnt	= getDBWinInfoNWinNumberGETcnt($addSql);
	$dbRtns		= getDBWinInfoNWinNumberGETList($addSql, $pageLimit);
	
	$rtns['datas']	= array();
	
	if (sizeof($dbRtns['lkName']) > 0) {

		for($i=0;$i<sizeof($dbRtns['lkName']);$i++){
			$times		= getLaTime($dbRtns['playDateTime'][$i]);
			$korTime	= $times['korTime'];

			$rtns['datas'][$i]['wiSeq']				= $dbRtns['wiSeq'][$i];
			$rtns['datas'][$i]['codeLK']			= $dbRtns['codeLK'][$i];
			$rtns['datas'][$i]['lkName']			= $dbRtns['lkName'][$i];
			$rtns['datas'][$i]['playDate']			= $dbRtns['playDate'][$i];
			$rtns['datas'][$i]['playDateTime']		= $dbRtns['playDateTime'][$i];
			$rtns['datas'][$i]['playDateTimeKor']	= date('Y-m-d H:i:s', $korTime);
			$rtns['datas'][$i]['winNums']			= $dbRtns['winNums'][$i];
			$rtns['datas'][$i]['winYN']				= $dbRtns['winYN'][$i];
			$rtns['datas'][$i]['winMoney']			= $dbRtns['winMoney'][$i];
			$rtns['datas'][$i]['won']				= $dbRtns['won'][$i];
			$rtns['datas'][$i]['winMoneyWon']		= $dbRtns['won'][$i] * $dbRtns['winMoney'][$i];
			
			$rtns['datas'][$i]['movieUrl']			= $dbRtns['movieUrl'][$i];
			
		}
		
	}
	
	$rtns['cnt']	= $totalCnt;
	
	echo json_encode($rtns);
		

}
catch(Exception $e)
{
	$rtns['errNo']	= $e->getCode();
	$rtns['errMsg']	= $e->getMessage();
	
	echo json_encode($rtns);
}
?>