<?php

use GuzzleHttp\Client;

/**
 * Class KL_Rulemailer_Model_Api_Rest_GuzzleClient
 * @author David Wickström <david@karlssonlord.com>
 */
class KL_Rulemailer_Model_Api_Rest_GuzzleClient implements KL_Rulemailer_Model_Api_Rest_Client
{
    /**
     * Base url
     */
    const BASE_URL = 'http://app.rule.io/api/v2/';
    /**
     * @var null
     */
    private $httpClient = null;

    /**
     * @param $client
     */
    public function __construct($client = null)
    {
        $client = $client ? : new Client([
            'base_uri' => self::BASE_URL,
            'query' => ['apikey' => $this->getApiKey()],
            'headers' => ['Accept-Charset' => 'ISO-8859-1,utf-8'],
        ]);

        $this->setHttpClient($client);
    }

    /**
     * Get the API key from the config
     *
     * @return mixed
     */
    private function getApiKey()
    {
        return Mage::getStoreConfig('kl_rulemailer_settings/general/key') ? : getenv('RULEMAILER_APIKEY');
    }

    /**
     * @param $client
     */
    private function setHttpClient($client)
    {
        $this->httpClient = $client;
    }

    /**
     *  Return a new instance of this client
     *
     * @return mixed
     */
    public function httpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param       $path
     * @param array $data
     * @return mixed
     */
    public function get($path, array $data = array())
    {
        return $this->httpClient()->get($path, array('query' => $data));
    }

    /**
     * @param       $path
     * @param array $data
     * @return mixed
     */
    public function post($path, array $data = array())
    {
        return $this->httpClient()->post($path, array('json' => $data));
    }

    /**
     * @param $path
     * @param $data
     * @return mixed
     */
    public function put($path, array $data = array())
    {
        return $this->httpClient()->put($path, array('json' => $data));
    }

    /**
     * @param       $path
     * @param array $data
     * @return mixed
     */
    public function delete($path, array $data = array())
    {
        return $this->httpClient()->delete($path, array('json' => $data));
    }

}
