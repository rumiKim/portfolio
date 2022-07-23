<?
include_once $_SERVER['DOCUMENT_ROOT']."/_common/config.php";
include_once $_SERVER['DOCUMENT_ROOT']."/_library/Goods.php";

$rtns['errNo']	= 0;

try
{

	$wiSeq		= empty($_GET['wiSeq']) ? 0 : intval($_GET['wiSeq']);
	
	if ($wiSeq < 1) throw new Exception("필수값 누락", 1);
	
	$won	= dbExchangeRateGETwonBYerIdx(1);
	
	$dbRs		= getDBWinInfoBYwiSeq($wiSeq);
	
	//printPre($dbRs);

	$playDate	= $dbRs['playDate'];
	$codeLK		= $dbRs['codeLK'];
	$movieUrl	= $dbRs['movieUrl'];
	$winYN		= $dbRs['winYN'];
	$winMoney	= $dbRs['winMoney'];

	$dbRs		= NULL;
	
	
	$dbRs			= getDBLottoPlayDateBYcodeLKNplayDate($codeLK, $playDate);
	$playDateTime	= $dbRs['playDateTime'];
	$lkName			= $dbRs['lkName'];
	$dbRs			= NULL;
	
	
	$playTime	= strtotime($playDateTime);
	$times		= getLaTime($playDateTime);
	$korTime	= $times['korTime'];
	$times		= NULL;
	
	$winNum		= getDBWinNumberGETwinNumsBYwiSeq($wiSeq);
	$winNums	= explode(',', $winNum);
	
	for($i = 0; $i < sizeof($winNums); $i++) {
	
		$winNs	= explode('-', $winNums[$i]);
	
		if ($winNs[0] == 'D') {
			$winDs[]	= intval($winNs[1]);
		}
		else {
			$winP	= intval($winNs[1]);
		}
	
	}
	$winNums	= NULL;	
	
	
	array_push($winDs, $winP);
	//printPre($winDs);
	
	$rtns['datas']['wiSeq']			= $wiSeq;
	$rtns['datas']['codeLK']		= $codeLK;
	$rtns['datas']['lkName']		= $lkName;
	$rtns['datas']['playDate']		= $playDate;
	$rtns['datas']['playDateTime']	= $playDateTime;
	$rtns['datas']['winMoney']		= $winMoney;
	$rtns['datas']['winYN']			= $winYN;
	$rtns['datas']['movieUrl']		= $movieUrl;
	$rtns['datas']['won']			= $won;

	
	
	
	$dbRtns	= getDBWinCntGETlistBYwiSeq($wiSeq);
	
	if (sizeof($dbRtns) > 0) {
	
		foreach($dbRtns as $dbRs) {
			//$winNo		= $dbRs['winNo'];
			$winCntD	= $dbRs['winCntD'];
			$winCntP	= $dbRs['winCntP'];
			$winMoney	= $dbRs['winMoney'];
	
			//$rtns[$winNo]['winCnt']		= $winCntD;
			//$rtns[$winNo]['winCntX']	= $winCntP;
			//$rtns[$winNo]['winMoney']	= $winMoney;
			//$rtns[$winNo]['winMoneyX']	= empty($winMoneyXs[$winNo]) ? 0 : $winMoneyXs[$winNo];
			
			$winCnts[]		= $winCntD;
			$winMoneys[]	= $winMoney;
		}
	

		$rtns['datas']['winCnts']		= $winCnts;
		$rtns['datas']['winMoneys']		= $winMoneys;
		
	
		//$rtns	= NULL;
	
	}
			

	echo json_encode($rtns);
		

}
catch(Exception $e)
{
	$rtns['errNo']	= $e->getCode();
	$rtns['errMsg']	= $e->getMessage();
	
	echo json_encode($rtns);
}

?>