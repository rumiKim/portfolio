<?
session_start();

include $_SERVER['DOCUMENT_ROOT']."/_common/config.php";
$M_login		=	null;
session_register("M_login");
setcookie("c_birth",'',time() - 3600,"/",$_SERVER['HTTP_HOST']);
setcookie("c_tel",'',time() - 3600,"/",$_SERVER['HTTP_HOST']);
setcookie("c_pwd",'',time() - 3600,"/",$_SERVER['HTTP_HOST']);


meta_go("/");
?>
