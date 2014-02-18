<?php


namespace Snide\Bundle\TravinizerBundle\Validator;

use Snide\Bundle\TravinizerBundle\Manager\RepoManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


/**
 * Class UniqueSlugValidator
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class UniqueSlugConstraintValidator extends ConstraintValidator
{
    /**
     * Repo manager
     *
     * @var RepoManagerInterface
     */
    protected $repoManager;

    /**
     * Constructor
     *
     * @param RepoManagerInterface $manager
     */
    public function __construct(RepoManagerInterface $manager)
    {
        $this->repoManager = $manager;
    }

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value      The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     *
     * @api
     */
    public function validate($repo, Constraint $constraint)
    {
        if($this->repoManager->isExists($repo)) {
            $this->context->addViolation($constraint->message, array('string' => $repo->getSlug()));
        }
    }
}