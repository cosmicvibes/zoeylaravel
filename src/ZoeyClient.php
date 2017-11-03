<?php

namespace Cosmicvibes\Zoeylaravel;

class ZoeyClient extends Zoey
{

    /**
     * ZoeyClient constructor.
     */
    public function __construct()
    {
        parent::__construct();

        return $this->client;
    }

}
