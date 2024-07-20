<?php

use PHPUnit\Framework\TestCase;
use FormValidation\Rules\RequiredRule;

class RequiredRuleTest extends TestCase
{
    public function testNotEmptyValue()
    {
        $rule = new RequiredRule();
        $this->assertTrue($rule->validate('some value'));
    }

    public function testEmptyValue()
    {
        $rule = new RequiredRule();
        $this->assertFalse($rule->validate(''));
    }

    public function testErrorMessage()
    {
        $rule = new RequiredRule();
        $this->assertEquals('Este campo é obrigatório.', $rule->getErrorMessage());
    }
}
