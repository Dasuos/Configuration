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

final class CombinedConfiguration extends \Tester\TestCase {

	public function testReturningTwoCombinedSettings(): void {
		Assert::same(
			[
				'Example' => [
					'example' => 'FOO',
					'example2' => 'bar',
					'example3' => 54321,
				],
				'Example2' => [
					'example' => 'foo',
					'example2' => 'bar',
				],
			],
			(new Configuration\CombinedConfiguration(
				new Configuration\ParsedConfiguration(
					__DIR__ . '/../Fixtures/configuration.ini'
				),
				new Configuration\ParsedConfiguration(
					__DIR__ . '/../Fixtures/configurationToMerge.ini'
				)
			))->settings()
		);
	}

	public function testReturningTwoCombinedSettingsInOppositeOrder(): void {
		Assert::same(
			[
				'Example' => [
					'example' => 'foo',
					'example2' => 'bar',
					'example3' => 12345,
				],
				'Example2' => [
					'example' => 'foo',
					'example2' => 'bar',
				],
			],
			(new Configuration\CombinedConfiguration(
				new Configuration\ParsedConfiguration(
					__DIR__ . '/../Fixtures/configurationToMerge.ini'
				),
				new Configuration\ParsedConfiguration(
					__DIR__ . '/../Fixtures/configuration.ini'
				)
			))->settings()
		);
	}

	public function testReturningManyCombinedSettings(): void {
		Assert::same(
			[
				'Example' => [
					'example' => 'FOO',
					'example2' => 'BAR',
					'example3' => 1000000,
				],
				'Example2' => [
					'example' => 'FOO',
					'example2' => true,
				],
			],
			(new Configuration\CombinedConfiguration(
				new Configuration\ParsedConfiguration(
					__DIR__ . '/../Fixtures/configuration.ini'
				),
				new Configuration\ParsedConfiguration(
					__DIR__ . '/../Fixtures/configurationToMerge.ini'
				),
				new Configuration\ParsedConfiguration(
					__DIR__ . '/../Fixtures/configurationToMerge2.ini'
				)
			))->settings()
		);
	}
}

(new CombinedConfiguration())->run();
