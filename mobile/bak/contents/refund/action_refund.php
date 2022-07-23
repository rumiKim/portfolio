<?
include $_SERVER['DOCUMENT_ROOT']."/_common/config.php";
include $_SERVER['DOCUMENT_ROOT']."/_library/Member.php";

$rtns['errNo']	= 0;

$method				= $_SERVER['REQUEST_METHOD'];
$memberIdx			= $_SESSION['M_login']['memberIdx'];

try
{
	
	$bankCode		= $_POST['bankCode'];
	$accountNum		= trim($_POST['accountNum']);
	$accountName	= trim($_POST['accountName']);
	$residentNum	= NULL;

	$codeCT			= 'W';
	$codeCS			= 'OA';
	
	$accountNum		= str_replace('-', '', $accountNum);
	$accountNum		= str_replace(' ', '', $accountNum);
	
	$sql			= "SELECT * FROM Bank WHERE bankCode = '".$bankCode."' ";
	$dbRs			= $db->get_data($sql);
	$bankFee		= intval($dbRs['sendFee']) * -1;
	$dbRs			= NULL;
	
	
	$dbM			= getDBMemberBYmemberIdx($memberIdx);
	$memberCash		= $dbM['memberCash'];
	$dbM			= NULL;
	
	$outCash		= $memberCash;

	if ($outCash < _outMoneyMin) {
		throw new Exception("신청가능한 환급액이 없습니다", 90021);
		
	}
	
	
	
	$dbRs	= getDBMemberBankBYmemberIdx($memberIdx);
	$chkID	= $dbRs['memberIdx'];
	$dbRs	= NULL;
	
	if (empty($chkID) == true) {
		exeDBMemberBankEXEinsert($memberIdx, $bankCode, $accountNum, $accountName, $residentNum);
	}
	else {
		exeDBMemberBankEXEupdate($memberIdx, $bankCode, $accountNum, $accountName, $residentNum);
	}
	
	
	
	
	$codeCSChk	= getDBMemberWidthdrawGETcodeCSBYmemberIdxNcodeCT($memberIdx, $codeCT);

	$disAs	= array('OA', 'OI');
	
	if (in_array($codeCSChk, $disAs) == true) {			
		throw new Exception("환급 처리중에 있습니다", 90022);	
		
	}
	else {
		
		$cashCmt	= '회원 환급신청';
		
		$outCash	= $outCash * -1;
		//$bonusCash	= $outCash * _outMoneyRate + $bankFee;
		//$appCash	= $outCash - $bonusCash;
		$adminID	= 'SYSTEM';
		$otSeq		= NULL;
		$kioskID	= NULL;
		$sessionID	= NULL;
		$sysMemo	= NULL;
		$codePT		= NULL;
		$gbotSeq	= NULL;
	
		//echo $appCash; $this->rollback(); exit;
		
		exeDBMemberEXEupdateSETmemberCashBYcashMoney($memberIdx, $outCash);
		$memberCash	 = getDBMemberGETmemberCashBYmemberIdx($memberIdx);

		
	
		dbMemberCashEXEinsert($memberIdx, $codeCT, $codeCS, $codePT, $otSeq, NULL, $outCash, 0, $outCash, $memberCash, $cashCmt, $sysMemo, $sessionID, $adminID);
		$mcSeq	= dbMemberCashGETmcSeqlastBYmemberIdx($memberIdx);				
		
		exeDBMemberWitdrawEXEinsert($mcSeq, $bankCode, $accountNum, $accountName);
		dbMemberCashLogEXEinsert($mcSeq, $memberIdx, $codeCT, $codeCS, $codePT, $otSeq, NULL, $kioskID, $outCash, 0, $outCash, $memberCash, $cashCmt, $sysMemo, $sessionID, $adminID);

		
	}
	
	$rtns['errNo']	= 0;
	$rtns['rtnMsg']	= '신청되었습니다';

	alert_print($rtns['rtnMsg']);
	meta_go("/contents/refund/view_refund.html");
	
}
catch(Exception $e)
{
	$rtns['errNo']	= $e->getCode();
	$rtns['rtnMsg']	= $e->getMessage();
	
	alert_print($rtns['rtnMsg']);
	meta_go("/contents/refund/apply_refund.html");
}	
?>