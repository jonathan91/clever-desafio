<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Code extends Constraint
{
    public string $field;

    public string $message_blank = 'The iso code is required.';
    public string $message = 'This value should not be a valid code.';

    /**
     * @param mixed $options
     */
    public function __construct($options = null)
    {
        $this->field = $options !== null ? $options['field'] : '';
    }
}