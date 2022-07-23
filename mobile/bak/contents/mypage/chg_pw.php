<?
include_once $_SERVER['DOCUMENT_ROOT']."/_common/config.php";


$rtns['errNo']	= 0;
$rtns['inErr']	= '';

try
{
	$phoneNo			= empty($_SESSION['M_login']['phoneNo']) ? $rtns['inErr']	= 'phoneNo' : trim(str_replace('-', '', $_SESSION['M_login']['phoneNo']));
	$birthDay			= empty($_SESSION['M_login']['birthDay']) ? $rtns['inErr'] = 'birthDay' : trim(str_replace('-', '', $_SESSION['M_login']['birthDay']));
	$password			= empty($_POST['password']) ? $rtns['inErr']	= 'password' : trim($_POST['password']);
	$passwordNow		= empty($_POST['passwordNow']) ? $rtns['inErr']	= 'passwordNow' : trim($_POST['passwordNow']);
	$passwordConfirm	= empty($_POST['passwordConfirm']) ? $rtns['inErr']	= 'passwordConfirm' : trim($_POST['passwordConfirm']);
	
	if (empty($rtns['inErr']) == false) throw new Exception("필수값 누락", 1);			
	unset($rtns['inErr']);
	
	if ($password != $passwordConfirm) throw new Exception("비밀번호와 비밀번호 확인이 맞지 않습니다", 90113);
	
	if (strlen($password) < 5) throw new Exception("비밀번호는 5자리 이상 입력해 주세요", 1);

	$npw				= makePW($passwordNow);

	$dbRs				= dbMemberBYphoneNoNbirthDaypwd($phoneNo, $birthDay,$npw);

	if(empty($dbRs['memberIdx']) == true){
		throw new Exception("현재 비밀번호를 정확히 입력해 주세요.", 900);
	}
	
	$memberPW	= makePW($password);
	$memberIdx	= $dbRs['memberIdx'];
	$pushYN		= $dbRs['pushYN'];
	$smsYN		= $dbRs['smsYN'];
	$dbRs		= NULL;
	
	$pwChangeYN	= 'Y';

	$sql	= "UPDATE Member SET pushYN = '".$pushYN."' , smsYN = '".$smsYN."', password = '".$memberPW."', pwChangeYN = '".$pwChangeYN."' WHERE memberIdx = '".$memberIdx."' ";

	$db->query($sql);
	
	
}
catch(Exception $e)
{
	$rtns['errNo']	= $e->getCode();
	$rtns['rtnMsg']	= $e->getMessage();
	
	alert_print($rtns['rtnMsg']);
	history_go();
	exit;
}

alert_print("비밀번호를 변경하였습니다.");
meta_go("/contents/mypage/chg_pw.html?gubun=Y");
?>