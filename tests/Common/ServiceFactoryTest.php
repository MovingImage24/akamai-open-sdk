<?php

namespace Mi\Akamai\SDK\Tests\Common;

use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Event\Emitter;
use Mi\Akamai\SDK\Common\Token\AkamaiTokenInterface;
use Mi\Guzzle\ServiceBuilder\ServiceFactoryInterface;
use Mi\Akamai\SDK\Common\ServiceFactory;
use Mi\Akamai\SDK\Common\Subscriber\EdgeGridAuthentication;
use Prophecy\Argument;

/**
 * @author Alexander Miehe <alexander.miehe@movingimage.com>
 * 
 * @covers Mi\Akamai\SDK\Common\ServiceFactory
 */
class ServiceFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function factory()
    {
        $baseFactory = $this->prophesize(ServiceFactoryInterface::class);
        $akamaiToken = $this->prophesize(AkamaiTokenInterface::class);
        $serviceFactory = new ServiceFactory($baseFactory->reveal(), $akamaiToken->reveal());
        $client = $this->prophesize(GuzzleClient::class);
        $emitter = $this->prophesize(Emitter::class);

        $client->getEmitter()->willReturn($emitter->reveal());

        $emitter->attach(Argument::type(EdgeGridAuthentication::class))->shouldBeCalled();

        $baseFactory->factory(['class' => GuzzleClient::class, 'description' => []])->willReturn($client->reveal());

        $service = $serviceFactory->factory(['class' => GuzzleClient::class, 'description' => []]);

        self::assertInstanceOf(GuzzleClient::class, $service);
    }
}
