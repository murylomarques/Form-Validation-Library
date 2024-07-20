<?php

require 'vendor/autoload.php';

use FormValidation\Validator;
use FormValidation\Rules\RequiredRule;
use FormValidation\Rules\EmailRule;

$data = [
    'name' => '',
    'email' => 'invalid-email'
];

$validator = new Validator($data);
$validator->addRule('name', new RequiredRule());
$validator->addRule('email', new EmailRule());

if (!$validator->validate()) {
    print_r($validator->getErrors());
} else {
    echo "Dados válidos!";
}
