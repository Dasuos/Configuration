<?php
declare(strict_types = 1);

namespace Dasuos\Configuration\Unit;

use Dasuos\Configuration;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 * @phpVersion > 7.1
 */

final class ExistingSettings extends \Tester\TestCase {

	public function testReturningExistingProperty() {
		Assert::same(
			'bar',
			(new Configuration\ExistingSettings(
				new Configuration\FakeConfiguration(
					[
						'Example' => [
							'example' => 'foo',
							'example2' => 'bar',
							'example3' => 12345,
						],
					]
				)
			))->property('Example', 'example2')
		);
	}

	public function testReturningNonexistentSection() {
		Assert::exception(
			function() {
				(new Configuration\ExistingSettings(
					new Configuration\FakeConfiguration(
						[
							'Example' => [
								'example' => 'foo',
								'example2' => 'bar',
								'example3' => 12345,
							],
						]
					)
				))->property('Invalid', 'example2');
			},
			\UnexpectedValueException::class,
			"Configuration property 'example2' in section 'Invalid' does not exist"
		);
	}

	public function testReturningNonexistentPropertyInExistingSection() {
		Assert::exception(
			function() {
				(new Configuration\ExistingSettings(
					new Configuration\FakeConfiguration(
						[
							'Example' => [
								'example' => 'foo',
								'example2' => 'bar',
								'example3' => 12345,
							],
						]
					)
				))->property('Example', 'invalid');
			},
			\UnexpectedValueException::class,
			"Configuration property 'invalid' in section 'Example' does not exist"
		);
	}
}

(new ExistingSettings())->run();
