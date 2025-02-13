<?php

declare(strict_types=1);

namespace Utils\PHPStan\Tests\DynamicInstantiationRule;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Utils\PHPStan\DynamicInstantiationRule;

/**
 * @extends RuleTestCase<DynamicInstantiationRule>
 */
final class DynamicInstantiationRuleTest extends RuleTestCase
{
    public function testRulePreventsDynamicInstantiation(): void
    {
        //$this->markTestIncomplete('Enable this test when working on Module9');

        $this->analyse(
            [__DIR__ . '/Fixtures/dynamic-instantiation.php'],
            [['Dynamic class instantiation is not allowed', 3]]
        );
    }

    public function testRuleSkipsNormalClassNameInstantiation(): void
    {
        //$this->markTestIncomplete('Enable this test when working on Module9');

        $this->analyse(
            [__DIR__ . '/Fixtures/skip-class-name-instantiation.php'],
            [] // no errors
        );
    }

    public function testRuleSkipsInlineClassInstantiation(): void
    {
        //$this->markTestIncomplete('Enable this test when working on Module9');

        $this->analyse(
            [__DIR__ . '/Fixtures/skip-inline-class-instantiation.php'],
            [] // no errors
        );
    }


    protected function getRule(): Rule
    {
        return new DynamicInstantiationRule();
    }
}
