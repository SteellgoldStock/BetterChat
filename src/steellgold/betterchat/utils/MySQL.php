<?php

namespace steellgold\betterchat\utils;

use steellgold\betterchat\BetterChat;

class MySQL {
	private static \mysqli $mysqli;

	public function __construct() {
		$config = BetterChat::getInstance()->getConfig();
		self::$mysqli = new \mysqli(
			$config->get("database")["host"],
			$config->get("database")["username"],
			$config->get("database")["password"],
			$config->get("database")["database"],
			$config->get("database")["port"]
		);

		self::default();
	}

	public static function mysqli(): \mysqli {
		return self::$mysqli;
	}

	public static function default(): void {
		self::mysqli()->query("CREATE TABLE IF NOT EXISTS players (
			id 					INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
			player 				VARCHAR(100) NOT NULL,
			player_rank	 		VARCHAR(50) DEFAULT null
		)");

		self::mysqli()->query("CREATE TABLE IF NOT EXISTS ranks (
			id 					INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
			uuid 				VARCHAR(100) NOT NULL,
    		rank_identifier 	VARCHAR(20) NOT NULL,
			nametag_format 		VARCHAR(250) NOT NULL,
			chat_format 		VARCHAR(250) NOT NULL,
			permissions 		JSON DEFAULT null
		)");
	}

}