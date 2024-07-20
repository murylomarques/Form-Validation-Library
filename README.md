# **Form Validation Library**

A PHP library for form validation that allows adding validation rules in a simple and extensible way.

## Installation

Use Composer to install the library:

``` composer require seu-usuario/form-validation ```


## Overview

This library provides a flexible and extensible way to validate form data. You can add multiple validation rules to your form fields and check if the data provided by users is valid.

## Usage

### Basic Example

Let's start with a simple example. Suppose we have a form with two fields: name and email. We want to ensure that the name field is not empty and that the email field contains a valid email address.


``` 
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

```

## Library Structure

### Validator

The Validator class is the core of the library. It takes the form data and allows you to add validation rules for each field.

```
namespace FormValidation;

use FormValidation\Rules\RuleInterface;

class Validator
{
    private array $data;
    private array $rules = [];
    private array $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function addRule(string $field, RuleInterface $rule): void
    {
        $this->rules[$field][] = $rule;
    }

    public function validate(): bool
    {
        foreach ($this->rules as $field => $rules) {
            foreach ($rules as $rule) {
                if (!$rule->validate($this->data[$field] ?? null)) {
                    $this->errors[$field][] = $rule->getErrorMessage();
                }
            }
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
```

## Validation Rules

Validation rules implement the RuleInterface, which defines two methods: validate and getErrorMessage.

### RuleInterface


```
namespace FormValidation\Rules;

interface RuleInterface
{
    public function validate($value): bool;
    public function getErrorMessage(): string;
}

```

### RequiredRule

This rule checks if a field is not empty.

```
namespace FormValidation\Rules;

class RequiredRule implements RuleInterface
{
    private string $message;

    public function __construct(string $message = "Este campo é obrigatório.")
    {
        $this->message = $message;
    }

    public function validate($value): bool
    {
        return !empty($value);
    }

    public function getErrorMessage(): string
    {
        return $this->message;
    }
}

```

### EmailRule

This rule checks if a field's value is a valid email address.

```
namespace FormValidation\Rules;

class EmailRule implements RuleInterface
{
    private string $message;

    public function __construct(string $message = "Este campo deve ser um email válido.")
    {
        $this->message = $message;
    }

    public function validate($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function getErrorMessage(): string
    {
        return $this->message;
    }
}

```


### Creating Custom Rules

You can create your own validation rules by implementing the RuleInterface.

```
namespace FormValidation\Rules;

class CustomRule implements RuleInterface
{
    private string $message;

    public function __construct(string $message = "Este campo não é válido.")
    {
        $this->message = $message;
    }

    public function validate($value): bool
    {
        // Adicione sua lógica de validação aqui
        return true; // ou false dependendo da validação
    }

    public function getErrorMessage(): string
    {
        return $this->message;
    }
}

```
You can then use your custom rule like any other:

```
use FormValidation\Rules\CustomRule;

$validator->addRule('field_name', new CustomRule("Mensagem de erro personalizada."));

```

## Testing

To ensure your library is working correctly, you can add unit tests using PHPUnit.


### EmailRule Test Example

```
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

```

### RequiredRule Test Example

```
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
```

To run the tests, use PHPUnit:
```
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests
```

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a branch for your feature (git checkout -b add-user-authentication).
3. Commit your changes (git commit -am 'Add user authentication feature').
4. Push to the branch (git push origin add-user-authentication).
5. Create a new Pull Request.


## Contact

If you have any questions, feel free to open an issue or reach out.