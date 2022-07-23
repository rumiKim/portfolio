<?
session_start();
include $_SERVER['DOCUMENT_ROOT']."/_common/config.php";

login_chk();

$phoneNo		=	addslashes($_SESSION['M_login']['phoneNo']);
$birthDay		=	addslashes($_SESSION['M_login']['birthDay']);
$smsYN			=	addslashes($_POST['smsYN']);
$info			=	dbMemberBYphoneNoNbirthDay($phoneNo,$birthDay);

$memberIdx		=	$info['memberIdx'];

$db->query("UPDATE Member SET smsYN='".$smsYN."' WHERE memberIdx='".$memberIdx."'");

$rtns['inErr']	= '';
$rtns['errNo']	= 200;

echo json_encode(array($rtns));