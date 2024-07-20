<?php

use PHPUnit\Framework\TestCase;
use FormValidation\Rules\EmailRule;

class EmailRuleTest extends TestCase
{
    public function testValidEmail()
    {
        $rule = new EmailRule();
        $this->assertTrue($rule->validate('test@example.com'));
    }

    public function testInvalidEmail()
    {
        $rule = new EmailRule();
        $this->assertFalse($rule->validate('invalid-email'));
    }

    public function testErrorMessage()
    {
        $rule = new EmailRule();
        $this->assertEquals('Este campo deve ser um email válido.', $rule->getErrorMessage());
    }
}
