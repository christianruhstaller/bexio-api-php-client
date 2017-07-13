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

    /**
     * Search for contacts
     *
     * @param array $params
     * @return mixed
     */
    public function searchContacts(array $params = [])
    {
        return $this->client->get('contact/search', $params);
    }

    /**
     * Get specific contact
     *
     * @param $id
     * @return mixed
     */
    public function getContact($id)
    {
        return $this->client->get('contact/search/'.$id, []);
    }

    /**
     * Get relations from contacts
     *
     * @return mixed
     */
    public function getContactsRelations()
    {
        return $this->client->get('contact_relation', []);
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