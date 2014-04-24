<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTagBundle\Processor;

use Tms\Bundle\MergeTagBundle\Model\Tag;

abstract class AbstractProcessor implements ProcessorInterface
{
    /**
     * Create a Tag from a given token
     *
     * @param  array $token ex: array('type' => TYPE, 'field' => FIELD, ['options' => json])
     * @return Tag
     */
    public static function createTag($token)
    {
        if (!isset($token['type'])) {
            throw new \Exception('Tag creation error: missing type');
        }

        if (!isset($token['field'])) {
            throw new \Exception('Tag creation error: missing field');
        }

        $options = array();
        if (isset($token['options'])) {
            $options = json_decode($token['options'], true);
            if (null === $options) {
                throw new \Exception('Tag creation error: wrong options');
            }
        }

        return new Tag(
            $token['type'],
            $token['field'],
            $options
        );
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
