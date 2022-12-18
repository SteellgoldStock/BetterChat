<?php

namespace steellgold\betterchat\listeners;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class PlayerListeners implements Listener {
	public function onPlayerJoin(PlayerJoinEvent $event) {
		$player = $event->getPlayer();

		if (!$player->hasPlayedBefore()) {
			// Send default message
			return;
		}

		// Send custom message
	}
}