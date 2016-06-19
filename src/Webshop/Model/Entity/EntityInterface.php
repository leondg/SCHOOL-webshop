<?php

namespace Webshop\Model\Entity;

interface EntityInterface
{
    /**
     * @param array $data
     *
     * @return self
     */
    public static function deserialize(array $data);

    /**
     * @return array
     */
    public function serialize();
}
