<?php

namespace steellgold\betterchat\commands;

use CortexPE\Commando\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use steellgold\betterchat\BetterChat;
use steellgold\betterchat\commands\subs\RankAddCommand;

class RankCommand extends BaseCommand {

	protected function prepare(): void {
		$this->registerSubCommand(new RankAddCommand("add", "Ajout d'un grade"));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
		if (!$sender instanceof Player) return;

		if (!Server::getInstance()->isOp($sender->getName())) {
			$sender->sendMessage(BetterChat::BETTERCHAT_ERROR . "Vous devez être opérateur pour utiliser cette commande.");
		}
	}
}