<?php

namespace steellgold\betterchat\commands\subs;

use CortexPE\Commando\BaseSubCommand;
use dktapps\pmforms\CustomForm;
use dktapps\pmforms\CustomFormResponse;
use dktapps\pmforms\element\Input;
use dktapps\pmforms\element\Label;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class RankFormatsCommand extends BaseSubCommand {

	protected function prepare(): void {
		// TODO: Implement prepare() method.
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
		if (!$sender instanceof Player) return;
		$sender->sendForm($this->editFormatsForm());
	}

	private function editFormatsForm(): CustomForm {
		$message = "Voici les différents \"§etags§f\" que vous pouvez utilisez pour les formats:" . PHP_EOL;
		$message .= "- §e{player} : §fNom du joueur" . PHP_EOL;
		$message .= "- §e{message} : §fMessage du joueur" . PHP_EOL;
		$message .= "- §e{rank} : §fNom du grade du joueur" . PHP_EOL;
		$message .= "- §e{primary} : §fCouleur primaire du grade du joueur" . PHP_EOL;
		$message .= "- §e{secondary} : §fCouleur secondaire du grade du joueur" . PHP_EOL;

		$options = [];
		$options[] = new Label("label", $message);
		$options[] = new Input("chatFormat", "Format des messages dans le chat", "[Inconnu] Pseudonyme » Mon message");
		$options[] = new Input("privateMessageFormat", "Format des pseudos", "Inconnu | Pseudonyme");

		return new CustomForm(
			"Édition du format de base", $options,
			function (Player $player, CustomFormResponse $response): void {

			},
			function (Player $player): void {

			}
		);
	}
}