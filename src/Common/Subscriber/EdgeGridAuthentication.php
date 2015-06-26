<?php

namespace Mi\Akamai\SDK\Common\Subscriber;

use GuzzleHttp\Command\Event\PreparedEvent;
use GuzzleHttp\Event\SubscriberInterface;
use GuzzleHttp\Message\RequestInterface;
use Mi\Akamai\SDK\Common\Token\AkamaiTokenInterface;

/**
 * @author Alexander Miehe <alexander.miehe@movingimage.com>
 */
class EdgeGridAuthentication implements SubscriberInterface
{
    private $timestamp;
    private $akamaiToken;

    /**
     * @param AkamaiTokenInterface $akamaiToken
     */
    public function __construct(AkamaiTokenInterface $akamaiToken)
    {
        $this->akamaiToken = $akamaiToken;
    }

    /**
     * {@inheritdoc}
     */
    public function getEvents()
    {
        return ['prepared' => ['onPrepared', 'last']];
    }

    public function onPrepared(PreparedEvent $event)
    {
        $this->timestamp = (new \DateTime(null, new \DateTimeZone('UTC')))->format('Ymd\TH:i:sO');
        $nonce           = bin2hex(openssl_random_pseudo_bytes(16));

        $authHeader = 'EG1-HMAC-SHA256 ' .
            'client_token=' . $this->akamaiToken->getClientToken() . ';' .
            'access_token=' . $this->akamaiToken->getAccessToken() . ';' .
            'timestamp=' . $this->timestamp . ';' .
            'nonce=' . $nonce . ';';


        $event
            ->getRequest()
            ->addHeader(
                'Authorization',
                $authHeader . 'signature=' . $this->signRequest($authHeader, $event->getRequest())
            );
    }

    /**
     * Returns a signature of the given request, timestamp and auth header
     *
     * @param string  $authHeader
     * @param RequestInterface $request
     *
     * @return string
     */
    private function signRequest($authHeader, RequestInterface $request)
    {
        $signature = $this->makeBase64HmacSha256(
            $this->makeDataToSign($authHeader, $request),
            $this->makeSigningKey($this->timestamp)
        );

        return $signature;
    }

    /**
     * Creates a signing key based on the secret and timestamp
     *
     * @return string
     */
    private function makeSigningKey()
    {
        return $this->makeBase64HmacSha256($this->timestamp, $this->akamaiToken->getClientSecret());
    }

    /**
     * Returns Base64 encoded HMAC-SHA256 Hash
     *
     * @param string $data
     * @param string $key
     *
     * @return string
     */
    private function makeBase64HmacSha256($data, $key)
    {
        return base64_encode(hash_hmac('sha256', $data, $key, true));
    }

    /**
     * Returns a string with all data that will be signed
     *
     * @param string  $authHeader
     * @param RequestInterface $request
     *
     * @return string
     */
    private function makeDataToSign($authHeader, RequestInterface $request)
    {
        $data_to_sign = array(
            $request->getMethod(),
            $request->getScheme(),
            $request->getHost(),
            $request->getResource(),
            /*
             * MFC 12/24/2014
             * Replaced headers with null as the servers don't accept headers as part of the signature
             */
            null,
            null, //body
            $authHeader
        );

        return implode("\t", $data_to_sign);
    }

}
