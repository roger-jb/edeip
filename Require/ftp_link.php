<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 08/09/2015
 * Time: 10:17
 */
class ftp_link {
	private static $FTP_DIR_PlanTravail;
	private static $FTP_DIR_Base;

	private function __construct () {
		self::$FTP_DIR_PlanTravail = 'PlanTravail/';
		self::$FTP_DIR_Base = 'www/';
	}

	public static function estPDFfile($file, $typeApplication){
		if ((strtolower(substr(strrchr($file, '.'), 1)) == 'pdf') && (strtolower($typeApplication == 'application/pdf')))
			return true;
		return false;
	}
}