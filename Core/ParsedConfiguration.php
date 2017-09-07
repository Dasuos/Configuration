<?php
declare(strict_types = 1);
namespace Dasuos\Configuration;

final class ParsedConfiguration implements Configuration {

	private const WITH_SECTIONS = true;

	private $path;

	public function __construct(string $path) {
		$this->path = $path;
	}

	public function settings(): array {
		$settings = @parse_ini_file(
			$this->path,
			self::WITH_SECTIONS,
			INI_SCANNER_TYPED
		);
		if (!$settings)
			throw new \UnexpectedValueException(
				'Given file is not readable or does not have .ini extension'
			);
		return $settings;
	}
}