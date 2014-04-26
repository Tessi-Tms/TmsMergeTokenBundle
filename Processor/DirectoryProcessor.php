<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Processor;

use Doctrine\ORM\EntityManager;
use Tms\Bundle\MergeTokenBundle\Model\Token;

class DirectoryProcessor extends AbstractProcessor
{
    protected $em;

    /**
     * Constructor
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function processToken(Token $token)
    {
        die('TODO: DirectoryProcessor');
    }
}
