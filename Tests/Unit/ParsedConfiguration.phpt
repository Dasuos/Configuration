<?php
declare(strict_types = 1);
/**
 * @testCase
 * @phpVersion > 7.1
 */
namespace Dasuos\Configuration\Unit;

use Dasuos\Configuration;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

class ParsedConfiguration extends \Tester\TestCase {

	public function testReturningValidSettings() {
		Assert::same(
			[
				'Example' => [
					'example' => 'foo',
					'example2' => 'bar',
					'example3' => 12345
				]
			],
			(new Configuration\ParsedConfiguration(
			__DIR__ . '/../TestCase/ParsedConfiguration/configuration.ini'
			))->settings()
		);
	}

	public function testReturningSettingsInInvalidFile() {
		Assert::exception(
			function () {
				(new Configuration\ParsedConfiguration(
					__DIR__ . '/nonexistent/path/to/ini/file'
				))->settings();
			},
			\UnexpectedValueException::class,
			'Given file is not readable or does not have .ini extension'
		);
	}
}

(new ParsedConfiguration())->run();
