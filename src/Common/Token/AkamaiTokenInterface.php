<?php

namespace Mi\Akamai\SDK\Common\Token;

/**
 * @author Alexander Miehe <alexander.miehe@movingimage.com>
 */
interface AkamaiTokenInterface
{
    /**
     * @return string
     */
    public function getClientSecret();

    /**
     * @return string
     */
    public function getClientToken();

    /**
     * @return string
     */
    public function getAccessToken();
}