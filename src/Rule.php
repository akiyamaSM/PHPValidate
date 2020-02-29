<?php
namespace Inani\PHPValidate;

use Inani\PHPValidate\Rules\CustomConstraint;
use Inani\PHPValidate\Rules\Max;
use Inani\PHPValidate\Rules\Min;
use Inani\PHPValidate\Rules\Number;
use Inani\PHPValidate\Rules\Required;

class Rule
{
    protected $key;

    protected $constraints = [];

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function required()
    {
        $this->constraints[] = new Required();

        return $this;
    }

    public function max($value)
    {
        $this->constraints[] = new Max($value);

        return $this;
    }

    public function min($value)
    {
        $this->constraints[] = new Min($value);

        return $this;
    }

    public function number()
    {
        $this->constraints[] = new Number();

        return $this;
    }

    public function inject(CustomConstraint $customConstraint)
    {
        $this->constraints[] = $customConstraint;

        return $this;
    }

    public function validate($value)
    {
        foreach ($this->constraints as $constraint) {
            if (! $constraint->isValid($value)) {
                return false;
            }
        }

        return true;
    }

    public function getConstraints()
    {
        return $this->constraints;
    }

    public function getFieldName()
    {
        return $this->key;
    }
}
