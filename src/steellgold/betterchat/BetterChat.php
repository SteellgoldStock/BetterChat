<?php

namespace steellgold\betterchat;

use CortexPE\Commando\PacketHooker;
use pocketmine\plugin\PluginBase;
use steellgold\betterchat\commands\RankCommand;
use steellgold\betterchat\listeners\PlayerListeners;
use steellgold\betterchat\player\ranks\RankManager;
use steellgold\betterchat\utils\MySQL;
use steellgold\betterchat\utils\Translation;

class BetterChat extends PluginBase {
	public static BetterChat $instance;
	public RankManager $rankManager;

	const BETTERCHAT_PREFIX = "§f[§gBetterChat§f]§r ";
	const BETTERCHAT_ERROR = "§f[§cBetterChat§f]§c ";

	protected function onEnable(): void {
		self::$instance = $this;
		if(!PacketHooker::isRegistered()) {
			PacketHooker::register($this);
		}

		$this->saveResource("langs/fr_FR.yml");
		$this->saveResource("langs/en_US.yml");

		new MySQL();

		$this->rankManager = new RankManager();
		$this->getServer()->getCommandMap()->register("betterchat", new RankCommand($this, "rank", "Manage ranks"));
		$this->getServer()->getPluginManager()->registerEvents(new PlayerListeners(), $this);
	}

	public static function getInstance(): BetterChat {
		return self::$instance;
	}

	/**
	 * @return RankManager
	 */
	public function getRankManager(): RankManager {
		return $this->rankManager;
	}
}