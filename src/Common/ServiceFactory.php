<?php

namespace Mi\Akamai\SDK\Common;

use Mi\Akamai\SDK\Common\Subscriber\EdgeGridAuthentication;
use Mi\Guzzle\ServiceBuilder\ServiceFactoryInterface as GuzzleServiceFactoryInterface;
use Mi\Guzzle\ServiceBuilder\ServiceFactoryInterface;

/**
 * @author Alexander Miehe <alexander.miehe@movingimage.com>
 */
class ServiceFactory implements ServiceFactoryInterface
{
    private $baseServiceFactory;
    private $clientToken;
    private $clientSecret;
    private $accessToken;

    /**
     * @param GuzzleServiceFactoryInterface $baseServiceFactory
     * @param string                        $clientToken
     * @param string                        $clientSecret
     * @param string                        $accessToken
     */
    public function __construct(
        GuzzleServiceFactoryInterface $baseServiceFactory,
        $clientToken,
        $clientSecret,
        $accessToken
    ) {
        $this->baseServiceFactory = $baseServiceFactory;
        $this->clientToken        = $clientToken;
        $this->clientSecret       = $clientSecret;
        $this->accessToken        = $accessToken;
    }

    /**
     * {@inheritdoc}
     */
    public function factory($config)
    {
        $service = $this->baseServiceFactory->factory($config);
        $service->getEmitter()->attach(new EdgeGridAuthentication($this->clientToken, $this->clientSecret, $this->accessToken));

        return $service;
    }
}
