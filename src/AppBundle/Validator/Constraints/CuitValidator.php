<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CuitValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (empty($value)) {
            return;
        }

        if (!$this->isValidCuit($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%cuit%', $value)
                ->addViolation();
        }
    }

    /**
     * Devuelve si el verdadero si el cuit
     * es válido (comprueba el dígito de verificación)
     * https://es.wikipedia.org/wiki/Clave_%C3%9Anica_de_Identificaci%C3%B3n_Tributaria
     *
     * @param $cuit cuit a Validad
     * @return bool
     */
    private function isValidCuit($cuit) {
        $cuit = preg_replace('/[^\d]/', '', (string) $cuit);

        if (!preg_match('/^(20|23|24|27|30|33|34)\d{9}/', $cuit)) {
            return false;
        }

        if (strlen($cuit) != 11) {
            return false;
        }

        $acumulado = 0;
        $digitos = str_split($cuit);
        $digito = array_pop($digitos);

        for($i = 0; $i < count($digitos); $i++){
            $acumulado += $digitos[9 - $i] * (2 + ($i % 6));
        }

        $verif = 11 - ($acumulado % 11);
        $verif = $verif == 11? 0 : $verif;

        return $digito == $verif;
    }
}
