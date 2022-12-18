<?php

namespace steellgold\betterchat\player;

use pocketmine\player\Player;
use steellgold\betterchat\player\ranks\Rank;
use steellgold\betterchat\player\ranks\RankManager;
use steellgold\betterchat\utils\MySQL;

final class Session {

	/**
	 * WeakMap ensures that the session is destroyed when the player is destroyed, without causing any memory leaks
	 *
	 * @var \WeakMap
	 * @phpstan-var \WeakMap<Player, Session>
	 */
	private static \WeakMap $data;

	public static function get(Player $player): Session {
		self::$data ??= new \WeakMap();

		return self::$data[$player] ??= self::loadSessionData($player);
	}

	private static function loadSessionData(Player $player): Session {
		if (!$player->hasPlayedBefore()) {
			MySQL::mysqli()->query("INSERT INTO players (player, rank_uuid) VALUES ('{$player->getName()}', '{" . RankManager::DEFAULT . "}')");
		}
		$data = MySQL::mysqli()->query("SELECT * FROM players WHERE player = '{$player->getName()}'")->fetch_assoc();
		if ($data == null) {
			var_dump("Player data not found");
		} else {
			var_dump($data);
		}

		return new Session(new Rank("test", "test", [
			"primary" => "§a",
			"secondary" => "§b"
		]));
	}

	public function __construct(
		private Rank $rank
	) {
	}

	/**
	 * @return Rank
	 */
	public function getRank(): Rank {
		return $this->rank;
	}
}