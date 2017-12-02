<?php
declare(strict_types = 1);
namespace Dasuos\Configuration;

interface Settings {
	/**
	 * @return mixed
	 */
	public function property(string $section, string $name);
}