<?php

namespace steellgold\betterchat\player\ranks;

use steellgold\betterchat\utils\MySQL;

class RankManager {

	/** @var Rank[] $ranks */
	private array $ranks = [];

	public function __construct() {
		$this->loadRanks();
	}

	private function loadRanks(): void {
		$data = MySQL::mysqli()->query("SELECT * FROM ranks")->fetch_all();
		foreach ($data as $rank) $this->ranks[$rank->getUuid()] = new Rank($rank[1], $rank[2], json_decode($rank[3], true));
	}

	public function addRank(Rank $rank): void {
		$this->ranks[$rank->getUuid()] = $rank;
	}

	public function removeRank(string $uuid): void {
		unset($this->ranks[$uuid]);
	}

	public function getRank(string $uuid): ?Rank {
		return $this->ranks[$uuid] ?? null;
	}

	public function getRanks(): array {
		return $this->ranks;
	}
}