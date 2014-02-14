<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Entity;

use Snide\Bundle\TravinizerBundle\Model\Repo as BaseRepo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Repo
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * @ORM\MappedSuperclass
 */
class Repo extends BaseRepo
{
    /**
     * Repo ID
     *
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * Repo slug
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $slug;
    /**
     * Scrutinizer quality badge hash
     *
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    protected $qualityBadgeHash;
    /**
     * Scrutinizer coverage badge hash
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    protected $coverageBadgeHash;
    /**
     * "g" for github or "b" for bitbucket
     * @var string
     *
     * @ORM\Column(type="string", length=1)
     */
    protected $type;
}
