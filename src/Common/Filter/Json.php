<?php

namespace Mi\Akamai\SDK\Common\Filter;

use Webmozart\Json\JsonEncoder;

/**
 * Static Wrapper to allow filters for parameters
 *
 * @author Alexander Miehe <alexander.miehe@movingimage.com>
 *
 * @codeCoverageIgnore
 */
class Json
{
    /**
     * @param mixed $data
     *
     * @return string
     * @throws \Webmozart\Json\ValidationFailedException
     */
    public static function encode($data)
    {
        return (new JsonEncoder())->encode($data);
    }
}
