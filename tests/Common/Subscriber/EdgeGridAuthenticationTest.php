<?php

namespace Mi\Akamai\SDK\Tests\Common\Subscriber;

use GuzzleHttp\Command\Event\PreparedEvent;
use GuzzleHttp\Message\Request;
use Mi\Akamai\SDK\Common\Subscriber\EdgeGridAuthentication;
use Mi\Akamai\SDK\Common\Token\AkamaiTokenInterface;
use Prophecy\Argument;

/**
 * @author Alexander Miehe <alexander.miehe@movingimage.com>
 * 
 * @covers Mi\Akamai\SDK\Common\Subscriber\EdgeGridAuthentication
 */
class EdgeGridAuthenticationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function prepare()
    {

        $akamaiToken = $this->prophesize(AkamaiTokenInterface::class);
        $authenticator = new EdgeGridAuthentication($akamaiToken->reveal());

        $akamaiToken->getClientToken()->willReturn('token');
        $akamaiToken->getClientSecret()->willReturn('secret');
        $akamaiToken->getAccessToken()->willReturn('access');

        $event = $this->prophesize(PreparedEvent::class);
        $request = $this->prophesize(Request::class);

        $event->getRequest()->willReturn($request->reveal());

        $request->addHeader('Authorization', Argument::containingString('EG1-HMAC-SHA256 client_token=token;access_token=access;timestamp='))->shouldBeCalled();
        $request->getMethod()->willReturn('GET');
        $request->getScheme()->willReturn('https');
        $request->getHost()->willReturn('host');
        $request->getResource()->willReturn('path/path-part?query-param=value');


        $authenticator->onPrepared($event->reveal());
    }

    /**
     * @test
     */
    public function getEvents()
    {
        $akamaiToken = $this->prophesize(AkamaiTokenInterface::class);
        $authenticator = new EdgeGridAuthentication($akamaiToken->reveal());

        self::assertInternalType('array', $authenticator->getEvents());
    }
}
