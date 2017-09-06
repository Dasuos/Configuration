<?php
declare(strict_types = 1);
namespace Dasuos\Configuration;

final class ParsedConfiguration implements Configuration {

	private $path;

	public function __construct(string $path) {
		$this->path = $path;
	}

	public function settings(): array {
		if (!$this->valid($this->path))
			throw new \UnexpectedValueException(
				'Given file is not readable or does not have .ini extension'
			);
		return parse_ini_file($this->path, true);
	}

	private function valid(string $path): bool {
		return is_readable($path) && $this->extension($path) === 'ini';
	}

	private function extension(string $path): string {
		return pathinfo($path, PATHINFO_EXTENSION);
	}
}