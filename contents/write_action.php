<?

include_once $_SERVER['DOCUMENT_ROOT']."/_common/config.php";
include_once $_SERVER['DOCUMENT_ROOT']."/_common/sms/sms.php";

function dbSmsHpAuthGETlast1BYhpNsmsFlag($hp, $smsFlag)
{
	global $db;
	$sql	= "SELECT * FROM SmsHpAuth WHERE hp = '".$hp."' AND smsFlag = '".$smsFlag."' ORDER BY shaSeq DESC LIMIT 1";
	$info = $db->get_data($sql);

	return $info;
}

function dbSmsHpAuthSETchkYN($shaSeq)
{
	global $db;
	$sql	= "UPDATE SmsHpAuth SET chkYN = 'Y' WHERE shaSeq = '".$shaSep."' ";
	$info = $db->get_data($sql);

	return $info;
}

function dbMemberExeInsert($kioskID, $password, $phoneNo, $birthDay)
{
	global $db;
	$sql	= "INSERT INTO Member (kioskID, password, phoneNo, birthDay) VALUES ( '".$kioskID."', '".$password."', '".$phoneNo."', '".$birthDay."');";
	
	$db->query($sql);
}

function getDBCodeLottoKindBYcodeLK($codeLK)
{
	global $db;
	$sql	= "SELECT * FROM CodeLottoKind WHERE codeLK = '".$codeLK."' ";
	$info = $db->get_data($sql);

	return $info;
}

function dbMemberCashEXEinsert($memberIdx, $codeCT, $codeCS, $codePT, $otSeq, $payno, $appCash, $bonusCash, $cashMoney, $memberCash, $cashCmt, $sysMemo, $sessionID, $adminID)
{
	global $db;

	if($otSeq == ''){
		$otSeq_query = " NULL, ";
	}else{
		$otSeq_query = "'".$otSeq."',";
	}
	$sql	= "
		INSERT INTO MemberCash 
			(memberIdx, codeCT, codeCS, codePT, otSeq, payno, appCash, bonusCash, cashMoney, memberCash, cashCmt, sysMemo, sessionID, adminID, lastDate)
		VALUES 
			('".$memberIdx."', '".$codeCT."', '".$codeCS."', '".$codePT."', ".$otSeq_query." '".$payno."', '".$appCash."', '".$bonusCash."', '".$cashMoney."', '".$memberCash."', '".$cashCmt."', '".$sysMemo."', '".$sessionID."', '".$adminID."', NOW()); 
	";
	
	$db->query($sql);
}

function dbMemberCashGETmcSeqlastBYmemberIdx($memberIdx)
{
	global $db;
	$sql	= "SELECT mcSeq FROM MemberCash WHERE memberIdx = '".$memberIdx."' ORDER BY mcSeq DESC LIMIT 1 ";
	$info = $db->get_data($sql);

	return $info['mcSeq'];
}

function dbMemberCashLogEXEinsert($mcSeq, $memberIdx, $codeCT, $codeCS, $codePT, $otSeq, $payno, $kioskID, $appCash, $bonusCash, $cashMoney, $memberCash, $cashCmt, $sysMemo, $sessionID, $adminID)
{
	global $db;

	if($otSeq == ''){
		$otSeq_query = " NULL, ";
	}else{
		$otSeq_query = "'".$otSeq."',";
	}
	$sql	= "
		INSERT INTO MemberCashLog
			(mcSeq, memberIdx, codeCT, codeCS, codePT, otSeq, payno, kioskID, appCash, bonusCash, cashMoney, memberCash, cashCmt, sysMemo, sessionID , adminID)
		VALUES 
			('".$mcSeq."', '".$memberIdx."', '".$codeCT."', '".$codeCS."', '".$codePT."', ".$otSeq_query." '".$payno."', '".$kioskID."', '".$appCash."', '".$bonusCash."', '".$cashMoney."', '".$memberCash."', '".$cashCmt."', '".$sysMemo."', '".$sessionID."' , '".$adminID."'); 
	";
	
	$db->query($sql);
}

function dbGameCntBYcodeLKNgameCnt($codeLK, $gameCnt)
{
	global $db;
	$sql	= "SELECT * FROM GameCnt WHERE codeLK = '".$codeLK."' AND gameCnt = '".$gameCnt."' ";
	$info = $db->get_data($sql);

	return $info;
}

function getDBLottoPlayDateGETendDateTimeNowBigger1BYcodeLK($codeLK)
{
	global $db;
	$sql	= "
		SELECT
			lpd.codeLK, lpd.playDate, lpd.summerYN, lpd.playDateTime, lpd.endDateTime, lpd.adminID,
			wi.wiSeq, wi.winMoney, wi.optX, wi.winYN, wi.movieUrl
		FROM
			LottoPlayDate lpd
			INNER JOIN WinInfo wi		ON lpd.codeLK = wi.codeLK AND lpd.playDate = wi.playDate
		WHERE
			lpd.codeLK = '".$codeLK."' AND lpd.endDateTime > NOW()
		ORDER BY
			lpd.playDate ASC
		LIMIT 1
	";
	$info = $db->get_data($sql);

	return $info;
}

function exeDBOrdersEXEinsert($memberIdx, $kioskID, $codeLK, $mcSeq, $gcSeq, $optYN, $sessionID)
{
	global $db;
	$sql	= "INSERT INTO Orders (memberIdx, kioskID, codeLK, mcSeq, gcSeq, optYN, sessionID) VALUES ( '".$memberIdx."', '".$kioskID."', '".$codeLK."', '".$mcSeq."', '".$gcSeq."', '".$optYN."', '".$sessionID."')";
	
	$db->query($sql);
	
}

function dbOrdersGEToSeqLastBYmemberIdx($memberIdx)
{
	global $db;
	$sql	= "SELECT oSeq FROM Orders WHERE memberIdx = '".$memberIdx."' ORDER BY oSeq DESC LIMIT 1";
	$info = $db->get_data($sql);

	return $info['oSeq'];
	
}

function exeDBOrderTicketEXEinsert($oSeq, $codeOT, $playDate, $multidrawCnt, $ticketNum)
{
	global $db;
	$sql	= "INSERT INTO OrderTicket (oSeq, codeOT, playDate, multidrawCnt, ticketNum ) VALUES ('".$oSeq."', '".$codeOT."', '".$playDate."', '".$multidrawCnt."', '".$ticketNum."')";
	
	$db->query($sql);
}

function getDBOrderTicketGETotSeqLast1BYoSeq($oSeq)
{
	global $db;
	$sql	= "SELECT otSeq FROM OrderTicket WHERE oSeq = '".$oSeq."' ORDER BY otSeq DESC LIMIT 1 FOR UPDATE ";
	$info = $db->get_data($sql);

	return $info['otSeq'];
}

function exeDBOrderGameNoEXEinsert($otSeq, $gameNo, $qpYN)
{
	global $db;
	$sql	= "INSERT INTO OrderGameNo (otSeq, gameNo, qpYN) VALUES ('".$otSeq."', '".$gameNo."', '".$qpYN."')";
	
	$db->query($sql);
}

function getDBOrderGameNoGETognSeqLast1BYotSeq($otSeq)
{
	global $db;
	$sql	= "SELECT ognSeq FROM OrderGameNo WHERE otSeq = '".$otSeq."' ORDER BY ognSeq DESC LIMIT 1 FOR UPDATE ";
	$info = $db->get_data($sql);

	return $info['ognSeq'];
}

function exeDBOrderNumBallExeInsert($ognSeq, $codeBK, $qpYN, $ballNum)
{
	global $db;
	$sql	= "INSERT INTO OrderNumBall (ognSeq, codeBK, qpYN, ballNum) VALUES ('".$ognSeq."', '".$codeBK."', '".$qpYN."', '".$ballNum."') ";
	
	$db->query($sql);
}

function dbMemberSETinMoneyNgameCntBYmemberIdx($inMoney, $gameCnt, $memberIdx)
{
	global $db;
	$sql	= "UPDATE Member SET lastDeposit = NOW(), inMoney = inMoney + '".$inMoney."', gameCnt = gameCnt + '".$gameCnt."' WHERE memberIdx = '".$memberIdx."' ";
	
	$db->query($sql);
}

function dbAgentGTETagtCodesBYkioskID($kioskID)
{
	global $db;
	$sql	= "			
		SELECT
			agt2.agtCode agtCode2, agt4.agtCode
		FROM
			AgtKiosk ak
			INNER JOIN Agent agt4 	ON ak.agtCode = agt4.agtCode
			INNER JOIN Agent agt3	ON agt4.agtCodeP = agt3.agtCode
			INNER JOIN Agent agt2	ON agt3.agtCodeP = agt2.agtCode
		WHERE
			ak.kioskID = '".$kioskID."' AND agt2.agtDepth = 2 
	";
	$info = $db->get_data($sql);

	return $info;
}

function dbAgtDepositBalancGETdepositBalanceBYagtCode($agtCode)
{
	global $db;
	$sql	= "SELECT depositBalance FROM AgtDepositBalance WHERE agtCode = '".$agtCode."' FOR UPDATE";
	$info = $db->get_data($sql);

	return $info['depositBalance'];
}

function AgtSalesEXEinsertBYkiosk($agtCode, $useDeposit, $gameCnt, $cashMoney, $agtDepth)
{
	global $db;

	$sql	= "UPDATE AgtSales SET useDeposit = useDeposit + '".$useDeposit."', gameCntSum = gameCntSum + '".$gameCnt."', cashMoneySum = cashMoneySum + '".$cashMoney."', lastDate = NOW() WHERE agtCode = ".$agtCode."'  ";
	
	$db->query($sql);

	if ($agtDepth == 2) {

		$rtns['agtCode2']	= $agtCode;

		$sql	= "UPDATE AgtDepositBalance SET depositBalance = depositBalance + '".$useDeposit."' WHERE agtCode = '".$agtCode."'";
		
		$db->query($sql);
	}

	$sql	= "SELECT agtCodeP FROM Agent WHERE agtCode = '".$agtCode."' ";
	$data	= $db->get_data($sql);
	$agtCodeP = $data['agtCodeP'];


	if (empty($agtCodeP) == false) {
		return AgtSalesEXEinsertBYkiosk($agtCodeP, $useDeposit, $gameCnt, $cashMoney, $agtDepth - 1);
	}
	else {

		//$this->rtns['errNo']	= 0;
		$rtns['errNo']	= 0;
		//return	$this->rtns;
		return	$rtns;
	}
}

function dbAgtDepositLogEXEinsert($agtCode, $codeAD, $codeS, $oSeq, $adaSeq, $useDeposit, $depositBalance, $depositBalanceP, $sysLog)
{	
	global $db;
	$sql	= "
		INSERT INTO AgtDepositLog (agtCode, codeAD, codeS, oSeq, adaSeq, useDeposit, depositBalance, depositBalanceP, sysLog) 
		VALUES ('".$agtCode."', '".$codeAD."', '".$codeS."', '".$oSeq."', '".$adaSeq."', '".$useDeposit."', '".$depositBalance."', '".$depositBalanceP."', '".$sysLog."'); ";
		
	$db->query($sql);
}

function dbAgtKioskSalesEXEupdate($kioskID, $useDeposit, $gameCnt, $cashMoney)
{
	global $db;
	$sql	= "UPDATE AgtKioskSales SET useDeposit = useDeposit + '".$useDeposit."', gameCntSum = gameCntSum + '".$gameCnt."', cashMoneySum = cashMoneySum + '".$cashMoney."', lastDate = NOW() WHERE kioskID = '".$kioskID."'  ";
	
	$db->query($sql);
}

function getDBSmsTempletBYcodeSKNautoIdx($codeSK, $autoIdx)
{
	global $db;
	$sql	= "SELECT * FROM SmsTemplet WHERE codeSK = '".$codeSK."' AND autoIdx = '".$autoIdx."' AND stopYN = 'N' AND delYN = 'N' ";
	$info = $db->get_data($sql);

	return $info;
}

function dbSmsHpAuthEXEinsert($smsFlag, $sessionID, $hpAuth, $hp)
{
	global $db;
	$sql	= "INSERT INTO SmsHpAuth ( smsFlag, sessionID, hpAuth, hp ) VALUES ('".$smsFlag."', '".$sessionID."', '".$hpAuth."', '".$hp."') ";
	
	$db->query($db);
}

function exeDBOrderGroupBallExeInsert($ballGroup){
	global $db;
	$sql	= "INSERT INTO OrderBallGroup ( no, oSeq, codeLK, playDate, ball1, ball2, ball3, ball4, ball5 ) VALUES ('', '".$ballGroup['oSeq']."', '".$ballGroup['codeLK']."', '".$ballGroup['playDate']."', '".$ballGroup['ball1']."', '".$ballGroup['ball2']."', '".$ballGroup['ball3']."', '".$ballGroup['ball4']."', '".$ballGroup['ball5']."') ";
	
	$db->query($sql);
}

//$_SESSION['kioskID'] = '1C697A4B1F39';
kiosk_login($_COOKIE['kioskID']);

//테스트
$kioskID = $_COOKIE['kioskID'];

$data = array_merge(apache_request_headers(), $_POST, $_SERVER);
file_put_contents($_SERVER['DOCUMENT_ROOT']."/logs/kiosk/".date('Ymdhis')."-XXX-".$kioskID.".log", json_encode($data));

$sessionID	= $kioskID;
$adminID	= 'KIOSK';

/*$_POST = array(
	'codeLK'=>'MM',
	'codeOT'=>'AT',
	'num'=>'5',
	'number1'=>'1,2,3,4,5,1,',
	'number2'=>'11,12,13,14,15,1,',
	'number3'=>'21,22,23,24,25,10,',
	'number4'=>'21,31,41,51,61,1,',
	'number5'=>'1,2,3,5,7,2,',
	'authNum'=>'',
	'birthDay'=>'890504',
	'phoneNo'=>'01038915488',
	'txtAgentPortNo'=>'60110',
	'tran_code'=>'D1',
	'txtAmount'=>'27500',
	'txtPeriod'=>'00',
	'txtCreditCardNo'=>'548020',
	'txtAuthNo'=>'26150051',
	'txtAuthDate'=>'20210426',
	'txtFICode'=>'01',
	'txtFIName'=>'비씨카드',
	'txtIssuerCode'=>'01',
	'txtIssuerName'=>'우리신용카드',
	'txtMemberNo'=>'773471647',
	'txtTranNo'=>'',
	'txtTradeNum'=>'000039',
	'txtTradeReqDate'=>'20210426',
	'txtTradeReqTime'=>'150052',
);*/
if($_POST['txtTestMode'] == 'Y'){
	$_POST['txtCreditCardNo']	=	"123456";
	$_POST['txtAuthNo']			=	"12345678";
	$_POST['txtFIName']			=	"테스트카드";
	$_POST['txtIssuerName']		=	"테스트카드";
	$_POST['txtMemberNo']		=	"123456789";
	$_POST['txtTradeNum']		=	"000001";
	$_POST['txtTradeReqDate']	=	date("Ymd");
	$_POST['txtTradeReqTime']	=	date("His");
	$_POST['txtAuthDate']		=	date("Ymd");
}

try
{

	$phoneNo	= empty($_POST['phoneNo']) ? $rtns['inErr'] = 'phoneNo' : trim(str_replace('-', '', $_POST['phoneNo']));
	$birthDay	= empty($_POST['birthDay']) ? $rtns['inErr'] = 'birthDay' : trim($_POST['birthDay']);
	//$authNum	= empty($_POST['authNum']) ? $rtns['inErr'] = 'authNum' : intval($_POST['authNum']);

	$payno		= empty($_POST['txtAuthNo']) ? $rtns['inErr'] = 'txtAuthNo' : intval(trim($_POST['txtAuthNo']));
	$cashMoney	= empty($_POST['txtAmount']) ? $rtns['inErr'] = 'txtAmount' : trimComma($_POST['txtAmount']);
	$codeLK		= empty($_POST['codeLK']) ? $rtns['inErr'] = 'codeLK' : strtoupper(trim($_POST['codeLK']));
	$gameCnt	= empty($_POST['num']) ? $rtns['inErr'] = 'num' : intval(trim($_POST['num']));
	$codeOT		= empty($_POST['codeOT']) ? $rtns['inErr'] = 'codeOT' : strtoupper(trim($_POST['codeOT']));

	$_POST['txtTradeReqTime']	= empty($_POST['txtTradeReqTime']) ? date("His") : $_POST['txtTradeReqTime'];

	$ballNums	= array();

	$s			= 0;
	for($i=1;$i<=$gameCnt;$i++){
		if(empty($_POST['number'.$i])){
			$rtns['inErr']	= 'number'.$i;
		}else{
			$number_arr	=	explode(",",$_POST['number'.$i]);
			
			unset($number_arr[6]);
			
			$ballNums[$s]		= $number_arr;
			$s++;
		}
	}

	$ballGroup	= array(
		"oSeq"		=> "",
		"codeLK"	=> $codeLK,
		"playDate"	=> "",
		"ball1"	=> ($_POST['number1'] != '')? substr($_POST['number1'],0,strlen($_POST['number1'])-1):"",
		"ball2"	=> ($_POST['number2'] != '')? substr($_POST['number2'],0,strlen($_POST['number2'])-1):"",
		"ball3"	=> ($_POST['number3'] != '')? substr($_POST['number3'],0,strlen($_POST['number3'])-1):"",
		"ball4"	=> ($_POST['number4'] != '')? substr($_POST['number4'],0,strlen($_POST['number4'])-1):"",
		"ball5"	=>($_POST['number5'] != '')? substr($_POST['number5'],0,strlen($_POST['number5'])-1):""
	);

	if(sizeof($ballNums) != $gameCnt){
		$rtns['inErr'] = 'ballNums';
	}

	if (empty($rtns['inErr']) == false) {
		throw new Exception("필수값 누락", 1);
	}
	unset($rtns['inErr']);


	$rtns	= chkMemberStatus($phoneNo, $birthDay);
	if ($rtns['errNo'] > 0) throw new Exception($rtns['rtnMsg'], $rtns['errNo']);


	/*$smsFlag	= 'O';
	$dbRs		= dbSmsHpAuthGETlast1BYhpNsmsFlag($phoneNo, $smsFlag);
	$hpAuth		= $dbRs['hpAuth'];
	$chkYN		= $dbRs['chkYN'];
	$shaSeq		= $dbRs['shaSeq'];
	$regTime	= strtotime($dbRs['regDate']);
	$dbRs		= NULL;

	if ($hpAuth != $authNum) {
		throw new Exception("인증번호가 틀립니다", 90009);
	}

	if (empty($shaSeq) == true) {
		throw new Exception("인증번호가 틀립니다", 90010);
	}


	if ($regTime < time() - 300) {
		throw new Exception("인증시간이 초과했습니다", 90011);
	}

	if ($chkYN == 'N') {
		dbSmsHpAuthSETchkYN($shaSeq);
	}
	else {
		throw new Exception("해당 인증번호는 폐기되었습니다", 90012);
	}*/



	$rtns	= adultChk($birthDay);

	if ($rtns['errNo'] > 0) throw new Exception($rtns['errMsg'], $rtns['errNo']);
	$birthDay	= $rtns['birthDay'];
	$age		= $rtns['age'];


	$info		= dbMemberBYphoneNoNbirthDay($phoneNo, $birthDay);
	$memberIdx	= $info['memberIdx'];


	if (empty($memberIdx) == true) {

		$newYN		= 'Y';
		$randPW		= rand(10000, 99999);

		$password	= makePW($randPW);
		dbMemberExeInsert($kioskID, $password, $phoneNo, $birthDay);

		$info		= dbMemberBYphoneNoNbirthDay($phoneNo, $birthDay);
		$memberIdx	= $info['memberIdx'];
		$memberCash	= 0;


	}
	else {

		$newYN		= 'N';

		$dbRs		= dbMemberBYmemberIdx($memberIdx);
		$memberCash	= $dbRs['memberCash'];
		$dbRs		= NULL;

	}




	$dbRs	= getDBCodeLottoKindBYcodeLK($codeLK);
	$lkName	= $dbRs['lkName'];
	$dbRs	= NULL;


	// 입력
	$codeCT	= 'O';
	$codeCS	= 'OS';
	$codePT	= 'C';
	$otSeq		= NULL;

	$ticketCnt	= ceil($gameCnt / 5);


	$cashCmt	= $lkName. ' '. $gameCnt . 'Game';
	$sysMemo	= '키오스크 구매()';


	$bonusCash	= 0;
	$appCash	= $cashMoney;

	dbMemberCashEXEinsert($memberIdx, $codeCT, $codeCS, $codePT, $otSeq, $payno, $appCash, 0, $cashMoney, $memberCash, $cashCmt, $sysMemo, $sessionID, $adminID);
	$mcSeq	= dbMemberCashGETmcSeqlastBYmemberIdx($memberIdx);
	dbMemberCashLogEXEinsert($mcSeq, $memberIdx, $codeCT, $codeCS, $codePT, $otSeq, $payno, $kioskID, $appCash, 0, $cashMoney, $memberCash, $cashCmt, $sysMemo, $sessionID, $adminID);

	$dbRs	= dbGameCntBYcodeLKNgameCnt($codeLK, $gameCnt);
	$gcSeq	= $dbRs['gcSeq'];
	$dbRs	= NULL;

	if (empty($gcSeq)) throw new Exception("게임 구매 갯수 오류", 90107);


	$dbRs					= getDBLottoPlayDateGETendDateTimeNowBigger1BYcodeLK($codeLK);
	$playDate				= $dbRs['playDate'];
	$ballGroup['playDate']	= $playDate;
	$dbRs					= NULL;


	if (empty($playDate)) throw new Exception("해당 게임의 구매날짜를 불러올 수 없습니다", 90108);


	if ($gameCnt != sizeof($ballNums)) {
		throw new Exception("게임 구매 개수와 실 게임 구매수가 맞지 않습니다", 90101);
	}



	$ballDMaxs	= array('MM' => 70, 'PB' => 69);
	$ballPMaxs	= array('MM' => 25, 'PB' => 26);

	$ballDMax	= $ballDMaxs[$codeLK];
	$ballPMax	= $ballDMaxs[$codeLK];


	for($i = 0; $i < $gameCnt; $i++) {

		$balls	= $ballNums[$i];

		if (sizeof($balls) != 6) {
			throw new Exception("볼은 총 6개 입니다", 90102);
		}

		$ballDs	= array_slice($balls, 0, 5);
		$ballP	= array_slice($balls, -1);

		$ballDs	= array_unique($ballDs);

		if (sizeof($ballDs) != 5) {
			throw new Exception("볼은 총 5개 입니다", 90103);
		}


		for($j = 0; $j < sizeof($ballDs); $j++) {

			$ballNum	= intval($ballDs[$j]);

			if ($ballNum < 1 || $ballNum > $ballDMax) {
				throw new Exception("볼 최소 혹은 최대값을 확인해 주세요", 90104);
			}

		}

		$ballNum	= intval($ballP);

		if ($ballNum < 1 || $ballNum > $ballPMax) {
			throw new Exception("볼 최소 혹은 최대값을 확인해 주세요", 90105);
		}



	}

	$optYN	= 'N';
	$qpYN	= 'N';
	exeDBOrdersEXEinsert($memberIdx, $kioskID, $codeLK, $mcSeq, $gcSeq, $optYN, $sessionID);
	$oSeq	= dbOrdersGEToSeqLastBYmemberIdx($memberIdx);

	$ballGroup['oSeq']	= $oSeq;


	$multidrawCnt	= 1;
	$ticketNum		= 0;
	$ticketNumOld	= 0;


	for($i = 0; $i < sizeof($ballNums); $i++) {

		$gameNo		= $i + 1;

		$ticketNum	= ceil($gameNo / 5);

		if ($ticketNum > $ticketNumOld) {

			exeDBOrderTicketEXEinsert($oSeq, $codeOT, $playDate, $multidrawCnt, $ticketNum);
			$otSeq	= getDBOrderTicketGETotSeqLast1BYoSeq($oSeq);
		}

		exeDBOrderGameNoEXEinsert($otSeq, $gameNo, $qpYN);
		$ognSeq	= getDBOrderGameNoGETognSeqLast1BYotSeq($otSeq);


		$balls	= $ballNums[$i];

		$ballDs	= array_slice($balls, 0, 5);
		$ballP	= array_slice($balls, -1)[0];

		sort($ballDs);

		//printPre($balls); $this->rollback(); exit;

		$codeBK	= 'D';

		for($j = 0; $j < sizeof($ballDs); $j++) {
			$ballNum	= intval($ballDs[$j]);
			exeDBOrderNumBallExeInsert($ognSeq, $codeBK, $qpYN, $ballNum);
		}

		$codeBK		= 'P';
		$ballNum	= intval($ballP);

		exeDBOrderNumBallExeInsert($ognSeq, $codeBK, $qpYN, $ballNum);

		$ticketNumOld	= $ticketNum;

	}

	exeDBOrderGroupBallExeInsert($ballGroup);


	dbMemberSETinMoneyNgameCntBYmemberIdx($cashMoney, $gameCnt, $memberIdx);


	// 디파짓 차감
	/*$depositMoney	= $gameCnt * _gameDollar * -1;
	//$dbRs			= $this->dbAgentBYkioskID($kioskID);
	//$agtCode		= $dbRs['agtCode'];
	//$agtMoneyP		= $dbRs['agtMoney'];
	//$dbRs			= NULL;
	$dbRs			= dbAgentGTETagtCodesBYkioskID($kioskID);
	$agtCode		= $dbRs['agtCode'];
	$agtCode2		= $dbRs['agtCode2'];
	$dbRs			= NULL;

	if (empty($agtCode2) == true || empty($agtCode) == true) throw new Exception("사용할 수 없는 키오스크 입니다", 12);



	$depositBalanceP	= dbAgtDepositBalancGETdepositBalanceBYagtCode($agtCode2);
	$depositBalance		= $depositBalanceP + $depositMoney;

	//echo $depositBalanceP; $this->rollback(); exit;


	$rtns	= AgtSalesEXEinsertBYkiosk($agtCode, $depositMoney, $gameCnt, $cashMoney, 4);

	//printPre($rtns);

	if ($rtns['errNo'] > 0) throw new Exception("AGT MONEY LOG INSERT ERROR", 9999);
	//else $agtCode2	= $rtns['agtCode2'];

	$codeAD	= 'O';
	$codeS	= 'S';
	$adaSeq	= NULL;
	$sysLog	= $lkName . " ".$gameCnt."게임 판매 디파짓 사용, 주문번호 : ". $oSeq;
	dbAgtDepositLogEXEinsert($agtCode2, $codeAD, $codeS, $oSeq, $adaSeq, $depositMoney, $depositBalance, $depositBalanceP, $sysLog);



	$rtns	= dbAgtKioskSalesEXEupdate($kioskID, $depositMoney, $gameCnt, $cashMoney);*/


	// 문자 발송
	$codeSK		= 'S';
	$fromHP		= _fromHP;
	$toHP		= $phoneNo;
	if ($newYN == 'Y') {

		$dbRs		= getDBSmsTempletBYcodeSKNautoIdx($codeSK, 1);
		if (empty($dbRs['stSeq']) == false) {

			$stSeq		= $dbRs['stSeq'];
			$smsMsg		= $dbRs['content'];
			$smsSubject	= $dbRs['subject'];
			$filePath	= NULL;
			$sendCnt	= 1;
			$adminID	= 'KIOSK';
			$dbRs		= NULL;

			$smsSubject		= str_replace('{TMPPASS}', $randPW, $smsSubject);
			$smsSubject		= str_replace('{BIRTHDAY}', $birthDay, $smsSubject);
			$smsSubject		= str_replace('{LOTTONAME}', $lkName, $smsSubject);
			$smsSubject		= str_replace('{PHONENO}', $phoneNo, $smsSubject);
			$smsSubject		= str_replace('{REGDATE}', date('Y-m-d H:i'), $smsSubject);
			$smsSubject		= str_replace('{APPCASH}', $appCash, $smsSubject);

			$smsMsg		= str_replace('{TMPPASS}', $randPW, $smsMsg);
			$smsMsg		= str_replace('{BIRTHDAY}', $birthDay, $smsMsg);
			$smsMsg		= str_replace('{LOTTONAME}', $lkName, $smsMsg);
			$smsMsg		= str_replace('{PHONENO}', $phoneNo, $smsMsg);
			$smsMsg		= str_replace('{REGDATE}', date('Y-m-d H:i'), $smsMsg);
			$smsMsg		= str_replace('{APPCASH}', $appCash, $smsMsg);

			exeDBSmsSendGrpEXEInsert('S', NULL, NULL, $fromHP, $smsSubject, $smsMsg, 1, $adminID);
			$ssgSeq	= getDBSmsSendGrpGETssgSeqBYlast1();
			exeDBSmsSendLogEXEInsert($ssgSeq, NULL, $toHP, $smsMsg);
			$sslSeq	= dbSmsSendLogGETsslSeqBYlast1();

			/*$messages = array(
						  array(
							"to" => $toHP,
							"from" => $fromHP,
							"subject" => $smsSubject,
							"text" => $smsMsg
						  )
						);
			$sms_info	= send_messages($messages);

			if ($sms_info->errorMessage == "") {
				exeDBSmsSendLogSETscsFlagBYssSeq($sslSeq, 'S');
			}else{
				$smsRtns['errNo'] = 0;
				$smsRtns['errMsg'] = $sms_info->errorMessage;
				exeDBSmsSendLogSETscsFlagBYssSeq($sslSeq, 'F');
			}*/

			$sms_info	= LMS($toHP,$fromHP, $smsSubject, $smsMsg);

			$smsRtns['errNo'] = 0;
			$smsRtns['errMsg'] = '';
			exeDBSmsSendLogSETscsFlagBYssSeq($sslSeq, 'F');

			if ($smsRtns['errNo'] > 0) {
				$rtns['smsErr']	= $smsRtns;
			}

			dbSmsHpAuthEXEinsert('J', 'KIOSK', $randPW, $phoneNo);

		}

		$dbRs	= NULL;
	}
	else {
		$dbRs	= getDBSmsTempletBYcodeSKNautoIdx($codeSK, 2);

		if (empty($dbRs['stSeq']) == false) {

			$stSeq		= $dbRs['stSeq'];
			$smsMsg		= $dbRs['content'];
			$smsSubject	= $dbRs['subject'];
			$filePath	= NULL;
			$sendCnt	= 1;
			$adminID	= 'KIOSK';
			$dbRs		= NULL;


			$smsSubject		= str_replace('{BIRTHDAY}', $birthDay, $smsSubject);
			$smsSubject		= str_replace('{LOTTONAME}', $lkName, $smsSubject);
			$smsSubject		= str_replace('{PHONENO}', $phoneNo, $smsSubject);
			$smsSubject		= str_replace('{REGDATE}', date('Y-m-d H:i'), $smsSubject);
			$smsSubject		= str_replace('{APPCASH}', $appCash, $smsSubject);

			$smsMsg		= str_replace('{BIRTHDAY}', $birthDay, $smsMsg);
			$smsMsg		= str_replace('{LOTTONAME}', $lkName, $smsMsg);
			$smsMsg		= str_replace('{PHONENO}', $phoneNo, $smsMsg);
			$smsMsg		= str_replace('{REGDATE}', date('Y-m-d H:i'), $smsMsg);
			$smsMsg		= str_replace('{APPCASH}', $appCash, $smsMsg);

			exeDBSmsSendGrpEXEInsert('S', NULL, NULL, $fromHP, $smsSubject, addslashes($smsMsg), 1, $adminID);
			$ssgSeq	= getDBSmsSendGrpGETssgSeqBYlast1();
			exeDBSmsSendLogEXEInsert($ssgSeq, NULL, $toHP, addslashes($smsMsg));
			$sslSeq	= dbSmsSendLogGETsslSeqBYlast1();

			/*$messages = array(
						  array(
							"to" => $toHP,
							"from" => $fromHP,
							"subject" => $smsSubject,
							"text" => $smsMsg
						  )
						);
			$sms_info	= send_messages($messages);

			if ($sms_info->errorMessage == "") {
				exeDBSmsSendLogSETscsFlagBYssSeq($sslSeq, 'S');
			}else{
				$smsRtns['errNo'] = 0;
				$smsRtns['errMsg'] = $sms_info->errorMessage;
				exeDBSmsSendLogSETscsFlagBYssSeq($sslSeq, 'F');
			}*/

			$sms_info	= LMS($toHP,$fromHP, $smsSubject, $smsMsg);

			$smsRtns['errNo'] = 0;
			$smsRtns['errMsg'] = '';
			exeDBSmsSendLogSETscsFlagBYssSeq($sslSeq, 'F');

			if ($smsRtns['errNo'] > 0) {
				$rtns['smsErr']	= $smsRtns;
			}
		}

		$dbRs	= NULL;


	}

	//$this->dbMemberEXEloginCnt($memberIdx);


	$rtns['errNo']	= 0;
	$rtns['rtnMsg']	= '정상 주문 처리되었습니다';
	$rtns['rtnUrl']	= "/contents/complete.html";
	$rtns['datas']['oSeq']	= $oSeq;

	//$db->Commit();


}
catch(Exception $e)
{

	//$this->rollback();

	$rtns['errNo']	= $e->getCode();
	$rtns['rtnMsg']	= $e->getMessage();

	$rtns['rtnUrl']	= "/";

}


include $_SERVER['DOCUMENT_ROOT']."/include/meta.html";

?>
<style>

.font_11{
			   color: #000000;
			   font-family: "돋음";
			   font-size: 11px;
			   letter-spacing:0;
			   font-weight:bold;
			   line-height:150%
}
.font_14{
			   color: #000000;
			   font-family: "돋음";
			   font-size: 14px;
			   letter-spacing:0;
			   font-weight:bold;
			   line-height:150%

}
</style>
<script type="text/javascript">
<!--
$(function(){
	function print_bill(){
		//alert(IEPageSetupX.header);
		//IEPageSetupX.header = "";
		//alert(1111);
		document.print_bill.printWindow();
		//alert(2222);
		setTimeout(function () {
			location.href="<?=$rtns['rtnUrl']?>";
		}, 4000);
	}

	$(document).on("click",".btn_print",function(){
		$(this).hide();
		print_bill();
	});

	$(document).on("click",".btn_cancel",function(){
		location.href="/";
	});

	$(document).on("click",".btn_cancel2",function(){
		location.href="<?=$rtns['rtnUrl']?>";   
	});
});
//-->
</script>
<? if($rtns['errNo'] > 0){ ?>
	<div class="popup type2">
	  <p class="txt_type2"><?=$rtns['rtnMsg']?></p>
	  <button class="btn_type3 btn_org btn_cancel">확인</button>
	</div>
<? }else{ ?>
	<div class="popup type2">
	  <p class="txt_type2"><?=$rtns['rtnMsg']?></p>
	  <button class="btn_type3 btn_org btn_print">확인</button>
	  <button class="btn_type3 btn_org btn_cancel2">닫기</button>
	</div>
<? } ?>
<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red" leftmargin=0 topmargin=0 >
 <OBJECT id=IEPageSetupX classid="clsid:41C5BC45-1BE8-42C5-AD9F-495D6C8D7586" codebase="/common/IEPageSetupX.cab#version=1,4,0,3" style="width:0;height:0">	
	 <param name="copyright" value="http://isulnara.com">
	
</OBJECT>

<iframe src='/contents/receipt.html?txtFIName=<?=urlencode($_POST["txtFIName"])?>&txtCreditCardNo=<?=urlencode($_POST["txtCreditCardNo"])?>&txtAmount=<?=urlencode($_POST["txtAmount"])?>&txtAuthNo=<?=urlencode($_POST["txtAuthNo"])?>&txtTradeReqDate=<?=urlencode($_POST["txtTradeReqDate"])?>&reqTime=<?=urlencode($_POST["txtTradeReqTime"])?>' name="print_bill" id="print_bill" width=0 height=0></iframe>


</body>

</html>