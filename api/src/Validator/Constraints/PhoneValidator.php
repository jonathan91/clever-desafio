<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

use function assert;

class PhoneValidator extends ConstraintValidator
{
    /** @param mixed $val */
    public function validate($value, Constraint $constraint)
    {
        $listIso = [
            'CM' => "/[2368]\d{7,8}$/",
            'ET' => "/[2368]\d{7,8}$/",
            'MA' => "/[5-9]\d{8}$/",
            'MZ' => "/[28]\d{7,8}$/",
            'UG' => "/d{9}$/",
        ];
        assert($constraint instanceof Phone);

        $field = $constraint->field;
        $field = trim($field);
        $iso = $this->context->getRoot()->$field;
        $pattern = $listIso[$iso];
        if (empty($this->context->getRoot()->$field)) {
            $this->context->buildViolation($constraint->message_blank)->addViolation();
        }

        if(preg_match($pattern, $value) != 1) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
