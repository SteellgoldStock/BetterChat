<?php

namespace steellgold\betterchat\player\ranks;

use steellgold\betterchat\utils\MySQL;

class RankManager {

	/** @var Rank[] $ranks */
	private array $ranks = [];

	const DEFAULT_RANK = [
		"uuid" => "2d2ee6de-7808-4ab2-8a28-3a6857160531",
		"display_name" => "Inconnu",
		"colors" => [
			"primary" => "\§f",
			"secondary" => "\§7"
		]
	];

	public function __construct() {
		$data = MySQL::mysqli()->query("SELECT * FROM ranks")->fetch_all();
		foreach ($data as $rank) $this->ranks[$rank[1]] = new Rank($rank[1], $rank[2], json_decode($rank[3], true));

		if (!isset($this->ranks[self::DEFAULT_RANK["uuid"]])) {
			$this->ranks[self::DEFAULT_RANK["uuid"]] = new Rank(self::DEFAULT_RANK["uuid"], self::DEFAULT_RANK["display_name"], self::DEFAULT_RANK["colors"]);
			MySQL::mysqli()->query("INSERT INTO ranks (uuid, display_name, colors, permissions) VALUES ('" . self::DEFAULT_RANK["uuid"] . "', '" . self::DEFAULT_RANK["display_name"] . "', '" . json_encode(self::DEFAULT_RANK["colors"]) . "', '[]')");
		}
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