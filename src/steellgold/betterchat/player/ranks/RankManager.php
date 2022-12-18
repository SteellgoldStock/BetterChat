<?php

namespace steellgold\betterchat\player\ranks;

use steellgold\betterchat\utils\MySQL;

class RankManager {

	/** @var Rank[] $ranks */
	private array $ranks = [];
	public function __construct() {
		$this->loadRanks();
	}

	private function loadRanks() {
		$data = MySQL::mysqli()->query("SELECT * FROM ranks")->fetch_assoc();
		var_dump($data);
	}

	public static function addRank(Rank $rank): void {
		self::$ranks[$rank->getUuid()] = $rank;
	}

	public static function removeRank(string $uuid): void {
		unset(self::$ranks[$uuid]);
	}

	public static function getRank(string $uuid): ?Rank {
		return self::$ranks[$uuid] ?? null;
	}

	public static function getRanks(): array {
		return self::$ranks;
	}

	}
}