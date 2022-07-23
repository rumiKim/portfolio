<?
$s_type = "BBSQnA";
include $_SERVER['DOCUMENT_ROOT']."/_common/config.php";
include $_SERVER['DOCUMENT_ROOT']."/_library/function_".$s_type.".php";
//=>	테이블명을 설정합니다.
$VAL		=	$_POST;

$VAL['mode']		=	"insert";
$VAL['bqSeq']		=	$db->get_data_one("SELECT MAX(bqSeq) FROM ".$s_type."") + 1;

$VAL['useFlag']		= "A";
$VAL['memberIdx']	= $_SESSION['M_login']['memberIdx'];
$VAL['qContent']	= stripslashes($VAL['qContent']);

$func_name	= "F_".$s_type;
$func_name($VAL);

alert_print("문의하기가 접수되였습니다.");
meta_go("./direct.html");
?>