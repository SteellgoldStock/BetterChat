<?php

namespace steellgold\betterchat\commands\subs;

use CortexPE\Commando\BaseSubCommand;
use dktapps\pmforms\CustomForm;
use dktapps\pmforms\CustomFormResponse;
use dktapps\pmforms\element\Dropdown;
use dktapps\pmforms\element\Input;
use dktapps\pmforms\element\Label;
use dktapps\pmforms\element\Toggle;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use steellgold\betterchat\utils\FormsInfos;

class RankAddCommand extends BaseSubCommand {

	protected function prepare(): void {
		// TODO: Implement prepare() method.
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
		if (!$sender instanceof Player) return;
		$sender->sendForm($this->addRankFormStepOne());
	}

	private function addRankFormStepOne(): CustomForm {
		$options = [];
		$options[] = new Label("label", "- Merci de bien vouloir remplir les champs suivants pour ajouter un grade" . PHP_EOL);
		$options[] = new Input("name", "Nom d'affichage du grade", "Administateur");
		$options[] = new Dropdown("primary", "Couleur primaire (ex: §cRouge§r)", FormsInfos::$colors, 14);
		$options[] = new Dropdown("secondary", "Couleur secondaire (ex: §gOr§r)", FormsInfos::$colors, 14);
		$options[] = new Toggle("isDefault", "Définir ce grade comme grade par défaut");
		$options[] = new Toggle("isOp", "Définir ce grade comme grade opérateur, il aura accès à toutes les commandes");

		$i = 0;
		foreach (Server::getInstance()->getPluginManager()->getPlugins() as $plugin) {
			$options[] = new Toggle("plugin_" . $i, $plugin->getName(), false);
			$i++;
		}

		return new CustomForm(
			"Ajout d'un grade (Étape 1/3)", $options,
			function (Player $player, CustomFormResponse $response): void {

			},
			function (Player $player): void {

			}
		);
	}
}