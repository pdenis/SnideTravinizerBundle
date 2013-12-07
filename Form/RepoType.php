<?php

namespace Snide\Bundle\MonitorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class RepoType
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class RepoType extends AbstractType
{
    /**
     * Class model
     *
     * @var string
     */
    protected $class;

    /**
     * Constructor
     *
     * @param $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * Build form
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('slug', 'text');
    }

    /**
     * Get form default options
     *
     * @param array $options
     * @return array Form options
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => $this->class,
        );
    }

    /**
     * Get form name
     * @return string Form name
     */
    public function getName()
    {
        return 'snide_travinizer_repository_type';
    }
}
