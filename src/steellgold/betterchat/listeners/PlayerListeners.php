<?php

namespace steellgold\betterchat\listeners;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use steellgold\betterchat\player\Session;

class PlayerListeners implements Listener {
	public function onPlayerJoin(PlayerJoinEvent $event) {
		$player = $event->getPlayer();

		$session = Session::get($player);
		// Send custom message
	}
}