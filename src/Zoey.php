<?php

namespace Cosmicvibes\Zoeylaravel;

use Magento\Client\Rest\MagentoRestClient;

class Zoey
{
    public $client;

    /**
     * Zoey constructor.
     */
    public function __construct()
    {

        $this->client = MagentoRestClient::factory(array(
            'base_url'        => config('zoey.credentials.base_url'),
            'consumer_key'    => config('zoey.credentials.consumer_key'),
            'consumer_secret' => config('zoey.credentials.consumer_secret'),
            'token'           => config('zoey.credentials.token'),
            'token_secret'    => config('zoey.credentials.token_secret'),
        ));

    }

}
