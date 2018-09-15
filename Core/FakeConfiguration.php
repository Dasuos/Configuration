<?php
declare(strict_types = 1);

namespace Dasuos\Configuration;

final class FakeConfiguration implements Configuration {

	private $configuration;

	public function __construct(array $configuration) {
		$this->configuration = $configuration;
	}

	public function settings(): array {
		return $this->configuration;
	}
}