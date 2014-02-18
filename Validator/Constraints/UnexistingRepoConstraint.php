<?php


namespace Snide\Bundle\TravinizerBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


/**
 * Class UnexistingRepoConstraint
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class UnexistingRepoConstraint extends Constraint
{
    /**
     * Constraint message
     *
     * @var string
     */
    public $message = 'The repository "%string%" does not exist';

    /**
     * Get validator class
     *
     * @return string
     */
    public function validatedBy()
    {
        return 'snide_travinizer.unexisting_repo_constraint_validator';
    }
}