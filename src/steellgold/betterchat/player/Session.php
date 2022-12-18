<?php

namespace steellgold\betterchat\player;

use pocketmine\player\Player;
use steellgold\betterchat\player\ranks\Rank;
use steellgold\betterchat\utils\MySQL;

final class Session{

	/**
	 * WeakMap ensures that the session is destroyed when the player is destroyed, without causing any memory leaks
	 *
	 * @var \WeakMap
	 * @phpstan-var \WeakMap<Player, Session>
	 */
	private static \WeakMap $data;

	public static function get(Player $player) : Session{
		self::$data ??= new \WeakMap();

		return self::$data[$player] ??= self::loadSessionData($player);
	}

	private static function loadSessionData(Player $player) : Session{
		$data = MySQL::mysqli()->query("SELECT * FROM players WHERE player = '{$player->getName()}'")->fetch_assoc();
		if ($data == null) {
			var_dump("Player data not found");
		} else {
			var_dump($data);
		}

		return new Session(new Rank(
			"00000000-0000-0000-0000-000000000000",
			"default",
			"-= {player} =-",
			"{player} > {message}",
			[]
		));
	}

	public function __construct(
		private Rank $rank
	){}

	/**
	 * @return Rank
	 */
	public function getRank(): Rank {
		return $this->rank;
	}
}