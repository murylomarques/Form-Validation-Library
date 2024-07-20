<?php

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
