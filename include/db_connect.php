<?php
/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 16/07/2015
 * Time: 16:12
 */

require_once('../ENV.php');

class db_connect {
	static private $ENV;
	static private $DB_SRV;
	static private $DB_NAME;
	static private $DB_USER;
	static private $DB_MDP;

	// la connexion à la BDD
	static private $db_connect;
	// boolean d'existance de connexion
	static private $instance;

	private function __construct () {
		global $__ENV;
		global $__DB_SRV;
		global $__DB_NAME;
		global $__DB_USER;
		global $__DB_MDP;

		self::$ENV = $__ENV;
		self::$DB_SRV = $__DB_SRV;
		self::$DB_USER = $__DB_USER;
		self::$DB_MDP = $__DB_MDP;
		self::$DB_NAME = $__DB_NAME;

		self::connect();
	}

	/**
	 * recuperation de la connexion à la BDD
	 * @return mysqli
	 */
	public static function getInstance () {
		if (!self::$instance) {
			new db_connect();
		}
		return self::$db_connect;
	}

	/**
	 * fermuture de la connexion à la BDD
	 */
	public static function close () {
		if (self::$instance) {
			self::$db_connect->close();
			self::$instance = FALSE;
		}
	}

	public static function query($query){
		$return = self::getInstance()->query($query);
		if ($return === false)
			echo '<br/>Pb dans le requete <br/>'.$query.'<br/>';
		return $return;
	}

	/**
	 * connexion a la BDD
	 */
	private static function connect () {
		self::$db_connect = new mysqli(self::$DB_SRV, self::$DB_USER, self::$DB_MDP, self::$DB_NAME);

		if (self::$db_connect->connect_error) {
			die('Erreur de connexion (' . self::$db_connect->connect_errno . ') ' . self::$db_connect->connect_error);
		}
		self::$instance = TRUE;
	}

	public static function escape_string ($string) {
		return self::getInstance()->escape_string($string);
	}
}