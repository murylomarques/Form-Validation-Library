<?php

namespace FormValidation;

use FormValidation\Rules\RuleInterface;

class Validator
{
    private array $data;
    private array $rules;
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
