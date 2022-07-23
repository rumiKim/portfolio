<?
session_start();
include $_SERVER['DOCUMENT_ROOT']."/_common/config.php";

$birthDay		=	addslashes($_POST['birth']);
$phoneNo		=	addslashes($_POST['tel']);
$password		=	addslashes($_POST['passwd']);
$chk_login		=	$_POST['chk_login'];

if($_POST['auto_login'] == 'Y'){
	$memberPW	= $password;
}else{
	$memberPW	= makePW($password);
}

$dbRs = dbMemberBYphoneNoNbirthDaypwd($phoneNo, $birthDay,$memberPW);

$memberIdx		= $dbRs['memberIdx'];
$phoneNo		= $dbRs['phoneNo'];
$loginCnt		= $dbRs['loginCnt'];
$pwChangeYN		= $dbRs['pwChangeYN'];

if (empty($memberIdx) == true){
	//	alert_print("게시판 관리자 비밀번호와 아이디를 입력하세요 (기본값은 DB 관리 아이디와 비밀번호입니다.)");
	alert_print("아이디/비밀번호를 확인하세요");
	
	history_go();
}
else{

	$M_login['memberIdx']			=	$memberIdx;
	$M_login['birthDay']			=	$birthDay;
	$M_login['phoneNo']				=	$phoneNo;
	$M_login['pwChangeYN']			=	$pwChangeYN;
	$M_login['loginCnt']			=	$loginCnt + 1;
	session_register("M_login");
	//$_SESSIONS['M_login'] = $M_login;

	if($chk_login == 'Y' || $chk_login == 'on'){
		setcookie("c_birth",$M_login['birthDay'],time() + 99*365*24*3600,"/",$_SERVER['HTTP_HOST']);
		setcookie("c_tel",$M_login['phoneNo'],time() + 99*365*24*3600,"/",$_SERVER['HTTP_HOST']);
		setcookie("c_pwd",$memberPW,time() + 99*365*24*3600,"/",$_SERVER['HTTP_HOST']);
	}else{
		setcookie("c_birth",'',time() - 3600,"/",$_SERVER['HTTP_HOST']);
		setcookie("c_tel",'',time() - 3600,"/",$_SERVER['HTTP_HOST']);
		setcookie("c_pwd",'',time() - 3600,"/",$_SERVER['HTTP_HOST']);
	}

	$sql	= "UPDATE Member SET loginCnt = loginCnt + 1, lastDate = NOW() WHERE memberIdx = '".$memberIdx."' ";
	$db->query($sql);

	meta_go('/');
}

dbMemberEXEloginCnt($memberIdx);



?>
