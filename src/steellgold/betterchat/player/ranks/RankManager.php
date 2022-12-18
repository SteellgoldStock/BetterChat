<?php

namespace steellgold\betterchat\player\ranks;

use steellgold\betterchat\utils\MySQL;

class RankManager {

	/** @var Rank[] $ranks */
	private array $ranks = [];

	public function __construct() {
		$this->loadRanks();
	}


	public static function addRank(Rank $rank): void {
		self::$ranks[$rank->getUuid()] = $rank;
	private function loadRanks(): void {
		$data = MySQL::mysqli()->query("SELECT * FROM ranks")->fetch_all();

		foreach ($data as $rank) {
			$rank = new Rank(
				$rank[1],
				$rank[2],
				json_decode($rank[3]),
			);
			$this->ranks[$rank->getUuid()] = $rank;
		}

		foreach ($this->ranks as $rank) {
			var_dump($rank->getDisplayName());
		}
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