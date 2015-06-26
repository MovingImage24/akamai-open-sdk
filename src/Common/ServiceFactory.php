<?php

namespace Mi\Akamai\SDK\Common;

use Mi\Akamai\SDK\Common\Subscriber\EdgeGridAuthentication;
use Mi\Akamai\SDK\Common\Token\AkamaiTokenInterface;
use Mi\Guzzle\ServiceBuilder\ServiceFactoryInterface as GuzzleServiceFactoryInterface;
use Mi\Guzzle\ServiceBuilder\ServiceFactoryInterface;

/**
 * @author Alexander Miehe <alexander.miehe@movingimage.com>
 */
class ServiceFactory implements ServiceFactoryInterface
{
    private $baseServiceFactory;
    private $akamaiToken;

    /**
     * @param GuzzleServiceFactoryInterface $baseServiceFactory
     * @param AkamaiTokenInterface          $akamaiToken
     */
    public function __construct(GuzzleServiceFactoryInterface $baseServiceFactory, AkamaiTokenInterface $akamaiToken)
    {
        $this->baseServiceFactory = $baseServiceFactory;
        $this->akamaiToken        = $akamaiToken;
    }

    /**
     * {@inheritdoc}
     */
    public function factory($config)
    {
        $service = $this->baseServiceFactory->factory($config);
        $service->getEmitter()->attach(new EdgeGridAuthentication($this->akamaiToken));

        return $service;
    }
}
