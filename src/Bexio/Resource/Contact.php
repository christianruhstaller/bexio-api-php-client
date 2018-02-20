<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class Contact extends Bexio {

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
        return $this->client->post('contact/search', $params);
    }

    /**
     * Get specific contact
     *
     * @param $id
     * @return mixed
     */
    public function getContact($id)
    {
        return $this->client->get('contact/search/' . $id, []);
    }

    /**
     * Add new contact
     * 
     * @param array $params
     * @return mixed
     */
    public function createContact(array $params = [])
    {
        return $this->client->post('contact', $params);
    }

    /**
     * Edit contact
     *
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function editContact($id, array $params = [])
    {
        return $this->client->post('contact/'. $id, $params);
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
     * Delete specific contact
     *
     * @param $id
     * @return mixed
     */
    public function deleteContact($id)
    {
        return $this->client->delete('contact/' . $id);
    }
}
