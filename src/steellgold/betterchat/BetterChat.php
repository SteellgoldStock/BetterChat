<?php

namespace steellgold\betterchat;

use pocketmine\plugin\PluginBase;
use steellgold\betterchat\utils\MySQL;

class BetterChat extends PluginBase {
	public static $instance;

	protected function onEnable(): void {
		self::$instance = $this;

		new MySQL();
	}

	public static function getInstance(): BetterChat {
		return self::$instance;
	}
}