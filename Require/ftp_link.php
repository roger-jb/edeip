<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 08/09/2015
 * Time: 10:17
 */
class ftp_link {
	private static $ENV;
	private static $FTP_USER;
	private static $FTP_MDP;
	private static $FTP_SRV;
	private static $FTP_DIR_PlanTravail;
	private static $FTP_DIR_Base;

	private static $instance;
	private static $ftp_connect;

	private function __construct () {
		global $__ENV;

		self::$ENV = $__ENV;
		self::$FTP_DIR_PlanTravail = 'PlanTravail/';
		self::$FTP_DIR_Base = 'www/';

		self ::connect();
	}

	private static function connect () {
		if (self::$ftp_connect = ftp_connect(self::$FTP_SRV))
			self::$instance = ftp_login(self::$ftp_connect, self::$FTP_USER, self::$FTP_MDP);
		if (!self::$instance) {
			return false;
		}
		return true;
	}

	public static function close () {
		if (self::$instance) {
			if (ftp_close(self::$ftp_connect))
				return true;
			return false;
		}
		return true;
	}

	public static function getConnect(){
		if (!self::$ftp_connect) {
			new ftp_link();
		}
		return self::$ftp_connect;
	}

	public static function getInstance () {
		if (!self::$instance) {
			new ftp_link();
		}
		return self::$instance;
	}

	public static function estPDFfile($file, $typeApplication){
		if ((strtolower(substr(strrchr($file, '.'), 1)) == 'pdf') && (strtolower($typeApplication == 'application/pdf')))
			return true;
		return false;
	}

	public static function putPlanTravail($fileDest , $fileSrc){
		self::getConnect();

		echo '<pre>';
		var_dump(self::$ftp_connect);
		echo '</pre>';
		echo '<br/>'.$fileDest;
		echo '<br/>'.$fileSrc;

		return self::put(self::$FTP_DIR_Base.self::$FTP_DIR_PlanTravail, $fileDest, $fileSrc);
	}

	private static function put($cheminDest,  $fileDest , $fileSrc , $mode = FTP_BINARY , $startpos = 0 ){
		if (ftp_put(self::getConnect(), $cheminDest.$fileDest, $fileSrc, $mode, $startpos))
			return true;
		return false;
	}
}