<?php
declare(strict_types = 1);

namespace Dasuos\Configuration;

final class CombinedConfiguration implements Configuration {

	private $origins;

	public function __construct(Configuration ...$origins) {
		$this->origins = $origins;
	}

	public function settings(): array {
		return array_replace_recursive(
			...array_map(
				function(Configuration $configuration): array {
					return $configuration->settings();
				},
				$this->origins
			)
		);
	}
}