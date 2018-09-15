<?php
declare(strict_types = 1);

namespace Dasuos\Configuration;

final class ExistingSettings implements Settings {

	private $configuration;

	public function __construct(Configuration $configuration) {
		$this->configuration = $configuration;
	}

	/**
	 * @return mixed
	 */
	public function property(string $section, string $name) {
		$settings = $this->configuration->settings();
		if (!isset($settings[$section][$name]))
			throw new \UnexpectedValueException(
				sprintf(
					"Configuration property '%s' in section '%s' does not exist",
					$name,
					$section
				)
			);
		return $settings[$section][$name];
	}
}