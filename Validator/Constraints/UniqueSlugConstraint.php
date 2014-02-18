<?php

namespace Snide\Bundle\TravinizerBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class UniqueSlugConstraint
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class UniqueSlugConstraint extends Constraint
{
    /**
     * Constraint message
     *
     * @var string
     */
    public $message = 'The slug %string" already exists';

    /**
     * Get validator class
     *
     * @return string
     */
    public function validatedBy()
    {
        return 'snide_travinizer.unique_slug_constraint_validator';
    }

    /**
     * Get targets
     *
     * @return mixed
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}