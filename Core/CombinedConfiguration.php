<?php
declare(strict_types = 1);
namespace Dasuos\Configuration;

final class CombinedConfiguration implements Configuration {

	private $origins;

	public function __construct(Configuration ...$origins) {
		$this->origins = $origins;
	}

	public function settings(): array {
		return call_user_func_array(
			'array_replace_recursive',
			array_map(
				function(Configuration $configuration) {
					return $configuration->settings();
				},
				$this->origins
			)
		);
	}
}