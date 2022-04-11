<?php
namespace Officialmeritinfos\NextropayPhp;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class NextropayCurlRequests
{
    private $secretKey = '';
    private $publicKey = '';
    private $sandboxUrl = 'https://sandbox.nextropay.com/api/';
    private $liveUrl = 'https://nextropay.com/api/';
    private $url;
    private $client;
    private $headers;

    /**
     * Executes a cURL request to the Nextropay.com API
     * We are using the GuzzleHttp Client package to send these requests
     *
     * @param $publicKey  The public key of the merchant - sandbox or live
     * @param $env        The environment the of the application - LIVE or TEST
     * @param $secretKey  The Secret key of the merchant. Only needed for payouts
     */
    public function __construct($publicKey,$env,$secretKey='')
    {
        $this->secretKey = $secretKey;
        $this->publicKey = $publicKey;
        $this->url = ($env =='LIVE') ? $this->liveUrl:$this->sandboxUrl;
        $this->client = new Client(['base_uri'=>$this->url]);
        $this->headers = empty($this->secretKey)? ['x-api-key'=>$this->publicKey,'Content-Type'=> 'application/json']:['x-api-sec'=>$this->secretKey,'Content-Type'=> 'application/json'];
    }

    /**
     * @param $url
     * @param $data
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function getRequests($url)
    {
        try {
            $request = $this->client->request('GET',$this->url.$url,['headers'=>$this->headers]);
            $response = $request->getBody();
        } catch (ClientException $e) {
            $response = Psr7\Message::toString($e->getResponse());
        }
        return $response;
    }
    /**
     * @param $url
     * @param $data
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function postRequests($url,$data='')
    {
        try {
            $request = $this->client->request('POST',$this->url.$url,['json'=>$data,'headers'=>$this->headers]);
            $response = $request->getBody();
        } catch (ClientException $e) {
            $response = Psr7\Message::toString($e->getResponse());
        }
        return $response;
    }

    /**
     * @param $url
     * @param $data
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function putRequests($url,$data='')
    {
        try {
            $request = $this->client->request('PUT',$this->url.$url,['json'=>$data,'headers'=>$this->headers]);
            $response = $request->getBody();
        } catch (ClientException $e) {
            $response = Psr7\Message::toString($e->getResponse());
        }
        return $response;
    }

}