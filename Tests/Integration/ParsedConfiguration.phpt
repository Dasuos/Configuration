<?php
declare(strict_types = 1);

namespace Dasuos\Configuration\Integration;

use Dasuos\Configuration;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 * @phpVersion > 7.1
 */

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
				__DIR__ . '/../Fixtures/configuration.ini'
			))->settings()
		);
	}

	public function testThrowingOnCorruptedIniFile() {
		Assert::exception(
			function () {
				(new Configuration\ParsedConfiguration(
					__DIR__ . '/../Fixtures/corruptedConfiguration.ini'
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
					__DIR__ . '/../Fixtures/configuration.txt'
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
