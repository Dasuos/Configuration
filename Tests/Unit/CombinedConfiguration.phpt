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

final class CombinedConfiguration extends \Tester\TestCase {

	public function testReturningTwoCombinedSettings() {
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
				new Configuration\FakeConfiguration(
					[
						'Example' => [
							'example' => 'foo',
							'example2' => 'bar',
							'example3' => 12345,
						],
					]
				),
				new Configuration\FakeConfiguration(
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
					]
				)
			))->settings()
		);
	}

	public function testReturningTwoCombinedSettingsInOppositeOrder() {
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
				new Configuration\FakeConfiguration(
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
					]
				),
				new Configuration\FakeConfiguration(
					[
						'Example' => [
							'example' => 'foo',
							'example2' => 'bar',
							'example3' => 12345,
						],
					]
				)
			))->settings()
		);
	}

	public function testReturningManyCombinedSettings() {
		Assert::same(
			[
				'Example' => [
					'example' => 'FOO',
					'example2' => 'BAR',
					'example3' => 1000000,
					'example4' => true,
				],
				'Example2' => [
					'example' => 'FOO',
					'example2' => false,
				],
			],
			(new Configuration\CombinedConfiguration(
				new Configuration\FakeConfiguration(
					[
						'Example' => [
							'example' => 'foo',
							'example2' => 'bar',
							'example3' => 12345,
						],
					]
				),
				new Configuration\FakeConfiguration(
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
					]
				),
				new Configuration\FakeConfiguration(
					[
						'Example' => [
							'example' => 'FOO',
							'example2' => 'BAR',
							'example3' => 1000000,
							'example4' => true,
						],
						'Example2' => [
							'example' => 'FOO',
							'example2' => false,
						],
					]
				)
			))->settings()
		);
	}
}

(new CombinedConfiguration())->run();
