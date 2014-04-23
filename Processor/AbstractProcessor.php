<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTagBundle\Processor;

use Tms\Bundle\MergeTagBundle\Model\Tag;

abstract class AbstractProcessor implements ProcessorInterface
{
    public static $pattern = '#\%?P<type>([a-z_-]*)\.?P<field>([a-z_-]*)(\.?P<options>(\{.*\}))?\%#i';

    /**
     * Create a Tag from a given token
     *
     * @param  $token
     * @return Tag
     */
    public static function createTag($token)
    {
        $matches = array();
        $isMatched = preg_match(self::$pattern, $token, $matches);

        if (false === $isMatched) {
            throw new \Exception('Tag extraction error');
        }

        var_dump($matches); die('good');
        $type    = $matches[1];
        $field   = $matches[2];
        $options = isset($matches[3]) ? json_decode($matches[3], true) : null;

        return new Tag($type, $field, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function process($token)
    {
        $tag = self::createTag($token);

        if (!$this->processTag($tag)) {
            throw new \Exception('Tag process failed');
        }

        return $tag;
    }

    /**
     * Process Tag
     *
     * @param  Tag $tag
     * @return boolean true if Tag value found, false if not
     */
    abstract public function processTag(Tag & $tag);
}
