<?php

namespace Bexio;

class Bexio
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Gets all the contacts
     *
     * @return array
     */
    public function getContacts(array $params = [])
    {
        return $this->client->get('contact', $params);
    }

    public function searchContacts(array $params = [])
    {
        return $this->client->get('contact/search', $params);
    }

    public function getContact($id)
    {
        return $this->client->get('contact/search/'.$id, []);
    }
}