<?php

namespace Snide\Bundle\TravinizerBundle\Validator;

use Buzz\Browser;
use Snide\Bundle\TravinizerBundle\Helper\GithubHelper;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class UnexistingRepoValidator
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class UnexistingRepoConstraintValidator extends ConstraintValidator
{
    /**
     * Github helper
     *
     * @var GithubHelper
     */
    protected $githubHelper;

    /**
     * A browser
     *
     * @var Browser
     */
    protected $browser;

    /**
     * Constructor
     *
     * @param GithubHelper $helper
     * @param Browser $browser
     */
    public function __construct(GithubHelper $helper, Browser $browser)
    {
        $this->helper = $helper;
        $this->browser = $browser;
    }

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value      The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     *
     * @api
     */
    public function validate($value, Constraint $constraint)
    {
        $url = $this->helper->getUrl($value);
        if($this->browser->get($url)->getStatusCode() >= 400) {
            $this->context->addViolation($constraint->message, array('%string%' => $url));
        }
    }
}