<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

use function assert;

class CodeValidator extends ConstraintValidator
{
    /** @param mixed $val */
    public function validate($value, Constraint $constraint)
    {
        $listIso = [
            'CM' => '237',
            'ET' => '251',
            'MA' => '212',
            'MZ' => '258',
            'UG' => '256',
        ];
        assert($constraint instanceof Code);

        $field = $constraint->field;
        $field = trim($field);
        $iso = $this->context->getRoot()->$field;
        $code = $listIso[$iso];
        if (empty($code)) {
            $this->context->buildViolation($constraint->message_blank)->addViolation();
        }

        if ($code != $value) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
