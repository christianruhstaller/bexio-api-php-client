<?php

namespace Bexio;

class Bexio
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get available salutations
     *
     * @return mixed
     */
    public function getSalutations()
    {
        return $this->client->get('salutation', []);
    }

    /**
     * Get available titles
     *
     * @return mixed
     */
    public function getTitles()
    {
        return $this->client->get('title', []);
    }
    
}