<?php

use PHPUnit\Framework\TestCase;
use FormValidation\Validator;
use FormValidation\Rules\RequiredRule;
use FormValidation\Rules\EmailRule;

class ValidatorTest extends TestCase
{
    public function testValidation()
    {
        $data = [
            'name' => '',
            'email' => 'invalid-email'
        ];

        $validator = new Validator($data);
        $validator->addRule('name', new RequiredRule());
        $validator->addRule('email', new EmailRule());

        $this->assertFalse($validator->validate());
        $this->assertNotEmpty($validator->getErrors());
    }
}
