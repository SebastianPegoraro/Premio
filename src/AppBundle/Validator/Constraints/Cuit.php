<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Cuit extends Constraint
{
    public $message = 'El cuit "%cuit%" ingresado es inválido.';
}
