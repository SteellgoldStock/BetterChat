<?php

namespace steellgold\betterchat\player\ranks;

class Rank {
	public function __construct(
		private string $uuid,
		private string $rankIdentifier,
		private string $nametagFormat,
		private string $chatFormat,
		private array $permissions
	) { }

	public function getUuid(): string {
		return $this->uuid;
	}

	public function getRankIdentifier(): string {
		return $this->rankIdentifier;
	}

	public function getNametagFormat(): string {
		return $this->nametagFormat;
	}

	public function getChatFormat(): string {
		return $this->chatFormat;
	}

	public function getPermissions(): array {
		return $this->permissions;
	}
}