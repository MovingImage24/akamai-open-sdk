<?php

namespace Mi\Akamai\SDK\Common\Token;

/**
 * @author Alexander Miehe <alexander.miehe@movingimage.com>
 *
 * @codeCoverageIgnore
 */
class AkamaiToken implements AkamaiTokenInterface
{
    private $clientSecret;
    private $clientToken;
    private $accessToken;

    /**
     * @param string $clientSecret
     * @param string $clientToken
     * @param string $accessToken
     */
    public function __construct($clientSecret, $clientToken, $accessToken)
    {
        $this->clientSecret = $clientSecret;
        $this->clientToken  = $clientToken;
        $this->accessToken  = $accessToken;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @return string
     */
    public function getClientToken()
    {
        return $this->clientToken;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
