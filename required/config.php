<?php
	$base = str_replace('required', '', __DIR__);
	define('MURL','http://localhost/af1_api/');
	// define('MURL','https://www.fsoftpro.com/dohung/');
	define('DOCUMENT_ROOT',$_SERVER['DOCUMENT_ROOT'].'/code/');
	// define('AURL',MURL.'admin/');
	define('DEFAULT_PAGE','home');
	define('WEB_NAME','Dohung');
	define('IMAGE_PHOTO',MURL.'uploads/photo/');
	define('NO_PHOTO',MURL.'uploads/no_photo.jpg');
	define('DB','mysqli');
	
	// Config DB localhost
	define('PREFIX', '');
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','root');
	define('DB_DB','af1_api');

	// Production
	// define('PREFIX', 'dh_');
	// define('DB_HOST','localhost');
	// define('DB_USER','fsoftpro_dhpro');
	// define('DB_PASS','29bGG94RSg');
	// define('DB_DB','fsoftpro_dhpro');

	// System config 
	define('DEFAULT_LANGUAGE','2');
	define('DEFAULT_LIMIT_PAGE','30');


	// define('email_username','support@fsoftpro.com');
	// define('email_password','fiverama2');
	// define('email_host','smtp.gmail.com');
	// define('email_port','465');
	// define('email_send','support@fsoftpro.com');
	// define('email_stmpsecure','ssl');

	// define('email_username','info@miss-bangkok.com');
	// define('email_password','bangkok1000');
	// define('email_host','sv5263.xserver.jp');
	// define('email_port','25');
	// define('email_send','info@miss-bangkok.com');
	// define('email_stmpsecure','TLS');

	// var_dump($_SERVER);

	// use PHPMailer\PHPMailer\PHPMailer;
	// use PHPMailer\PHPMailer\Exception;

	// require DOCUMENT_ROOT.'/system/lib/PHPMailer-master-7/src/Exception.php';
	// require DOCUMENT_ROOT.'/system/lib/PHPMailer-master-7/src/PHPMailer.php';
	// require DOCUMENT_ROOT.'/system/lib/PHPMailer-master-7/src/SMTP.php';
	// global	$mail ;
	// $mail = new PHPMailer(true); //New instance, with exceptions enabled

	
?>