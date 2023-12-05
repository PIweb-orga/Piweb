<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ValidType extends Constraint
{

        public $message = 'Le type doit être facturation, qualite_nourriture ou service.';


    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
}