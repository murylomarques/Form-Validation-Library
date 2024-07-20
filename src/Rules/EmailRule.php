<?php

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
