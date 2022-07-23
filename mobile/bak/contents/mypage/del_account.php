<?
session_start();
include $_SERVER['DOCUMENT_ROOT']."/_common/config.php";

login_chk();

function getDBMemberOutGETlast1BYmemberIdx($memberIdx)
{
	global $db;

	$sql	= "
		SELECT
			m.memberIdx, m.regDate, m.phoneNo, m.memberCash, m.adminMemo, mo.codeS, 
			cmo.outName, 
			mo.outMemo, mo.regDate outDate
		FROM
			Member m
			INNER JOIN MemberOut mo 		ON m.memberIdx = mo.memberIdx
			INNER JOIN CodeMemberOut cmo	ON mo.codeMO = cmo.codeMO
		WHERE
			m.memberIdx = '".$memberIdx."'
		ORDER BY
			mo.moSeq DESC 
		LIMIT 1
	";
	$dbRs	= $db->get_data($sql);
	return	$dbRs;
}

$codeMO		= $_POST['codeMO'];
$outMemo	= $_POST['outContent'];

$phoneNo	=	addslashes($_SESSION['M_login']['phoneNo']);
$birthDay	=	addslashes($_SESSION['M_login']['birthDay']);
$info		=	dbMemberBYphoneNoNbirthDay($phoneNo,$birthDay);

$memberIdx	=	$info['memberIdx'];


$dbRs		= getDBMemberOutGETlast1BYmemberIdx($memberIdx);

$codeS		= $dbRs['codeS'];



//echo $codeS; exit;

switch($codeS) {
	case 'A' : 
		$rtns['errNo']	= 90012;
		$rtns['rtnMsg']	= '이미 신청중에 있습니다';
		
		alert_print($rtns['rtnMsg']);
		meta_go("/contents/mypage/del_account.html?gubun=Y");
		exit;
	break;
	
	case 'S' :
		$rtns['errNo']	= 90013;
		$rtns['rtnMsg']	= '이미 탈퇴 처리되어 신청하실 수 없습니다';
		
		alert_print($rtns['rtnMsg']);
		meta_go("/contents/mypage/del_account.html?gubun=Y");
		exit;
	break;
}

$sql	= "INSERT INTO MemberOut (memberIdx, codeMO, codeS, outMemo, lastDate) VALUES ('".$memberIdx."', '".$codeMO."', 'A', '".$outMemo."', NOW())";
$db->query($sql);


$rtns['errNo']	= 0;
$rtns['errMsg']	= '탈퇴신청되었습니다';

alert_print($rtns['errMsg']);
meta_go("/contents/mypage/del_account.html?gubun=Y");
exit;
?>