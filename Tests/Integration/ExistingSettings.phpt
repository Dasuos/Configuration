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

final class ExistingSettings extends \Tester\TestCase {

	public function testReturningExistingProperty() {
		Assert::same(
			'foo',
			(new Configuration\ExistingSettings(
				new Configuration\ParsedConfiguration(
					__DIR__ . '/../TestCase/configuration.ini'
				)
			))->property('Example', 'example')
		);
	}

	public function testReturningNonexistentSection() {
		Assert::exception(
			function() {
				(new Configuration\ExistingSettings(
					new Configuration\ParsedConfiguration(
						__DIR__ . '/../TestCase/configuration.ini'
					)
				))->property('Invalid', 'example');
			},
			\UnexpectedValueException::class,
			"Configuration property 'example' in section 'Invalid' does not exist"
		);
	}

	public function testReturningNonexistentPropertyInExistingSection() {
		Assert::exception(
			function() {
				(new Configuration\ExistingSettings(
					new Configuration\ParsedConfiguration(
						__DIR__ . '/../TestCase/configuration.ini'
					)
				))->property('Example', 'example123');
			},
			\UnexpectedValueException::class,
			"Configuration property 'example123' in section 'Example' does not exist"
		);
	}
}

(new ExistingSettings())->run();
