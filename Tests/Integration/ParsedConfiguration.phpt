<?php
declare(strict_types = 1);
/**
 * @testCase
 * @phpVersion > 7.1
 */
namespace Dasuos\Configuration\Integration;

use Dasuos\Configuration;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

final class ParsedConfiguration extends \Tester\TestCase {

	public function testReturningValidSettings() {
		Assert::same(
			[
				'Example' => [
					'example' => 'foo',
					'example2' => 'bar',
					'example3' => 12345,
				],
			],
			(new Configuration\ParsedConfiguration(
				__DIR__ . '/../TestCase/configuration.ini'
			))->settings()
		);
	}

	public function testReturningSettingsFromCorruptedConfiguration() {
		Assert::exception(
			function () {
				(new Configuration\ParsedConfiguration(
					__DIR__ . '/../TestCase/corruptedConfiguration.ini'
				))->settings();
			},
			\UnexpectedValueException::class,
			'Given file is not readable or does not have .ini extension'
		);
	}

	public function testThrowingOnInvalidFormat() {
		Assert::exception(
			function () {
				(new Configuration\ParsedConfiguration(
					__DIR__ . '/../TestCase/configuration.txt'
				))->settings();
			},
			\UnexpectedValueException::class,
			'Given file is not readable or does not have .ini extension'
		);
	}

	public function testThrowingOnUnknownFile() {
		Assert::exception(
			function () {
				(new Configuration\ParsedConfiguration(
					'/nonexistent/path/to/ini/file'
				))->settings();
			},
			\UnexpectedValueException::class,
			'Given file is not readable or does not have .ini extension'
		);
	}
}

(new ParsedConfiguration())->run();
