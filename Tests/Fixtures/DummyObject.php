<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Tests\Fixtures;

class DummyObject
{
    protected $id;

    public function __construct($id = 1)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
