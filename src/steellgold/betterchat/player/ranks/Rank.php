<?php

namespace steellgold\betterchat\player\ranks;

class Rank {

	const COLOR_PRIMARY = "primary";
	const COLOR_SECONDARY = "secondary";

	public function __construct(
		private string $uuid,
		private string $displayName,
		private array  $colors = ["primary" => null, "secondary" => null],
		private bool   $isOperator = false
	) {
	}

	public function getUuid(): string {
		return $this->uuid;
	}

	public function getDisplayName(): string {
		return $this->displayName;
	}

	public function setDisplayName(string $displayName): void {
		$this->displayName = $displayName;
	}

	public function getColors(): array {
		return $this->colors;
	}

	public function setColor(string $type, string $color): void {
		$this->colors[$type] = $color;
	}

	public function isOperator(): bool {
		return $this->isOperator;
	}

	public function setIsOperator(bool $isOperator): void {
		$this->isOperator = $isOperator;
	}
}