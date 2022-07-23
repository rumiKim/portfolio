<?
session_start();
include $_SERVER['DOCUMENT_ROOT']."/_common/config.php";

login_chk();

$phoneNo		=	addslashes($_SESSION['M_login']['phoneNo']);
$birthDay		=	addslashes($_SESSION['M_login']['birth']);
$password		=	addslashes($_POST['passwd']);
$callback		=	addslashes($_POST['callback']);
$memberPW		=	makePW($password);

$dbRs			=	dbMemberBYphoneNoNpwd($phoneNo,$memberPW);
$memberIdx		=	$dbRs['memberIdx'];

if (empty($memberIdx) == true){
	//	alert_print("게시판 관리자 비밀번호와 아이디를 입력하세요 (기본값은 DB 관리 아이디와 비밀번호입니다.)");
	alert_print("비밀번호를 확인하세요");
	
	history_go();
}
else{
	meta_go("/contents/mypage/".$callback.".html?gubun=Y");
}
?>