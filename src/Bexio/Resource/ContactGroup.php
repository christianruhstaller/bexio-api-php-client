<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class ContactGroup extends Bexio {

    /**
     * Gets all the contact groups
     *
     * @param array $params
     * @return array
     */
    public function getContactGroups(array $params = [])
    {
        return $this->client->get('contact_group', $params);
    }

    /**
     * Search for contact groups
     *
     * @param array $params
     * @return mixed
     */
    public function searchContactGroups(array $params = [])
    {
        return $this->client->post('contact_group/search', $params);
    }

    /**
     * Get specific contact group
     *
     * @param $id
     * @return mixed
     */
    public function getContactGroup($id)
    {
        return $this->client->get('contact_group/' . $id, []);
    }

    /**
     * Add new contact group
     * 
     * @param array $params
     * @return mixed
     */
    public function createContactGroup(array $params = [])
    {
        return $this->client->post('contact_group', $params);
    }

    /**
     * Edit contact group
     *
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function editContactGroup($id, array $params = [])
    {
        return $this->client->post('contact_group/'. $id, $params);
    }

    /**
     * Delete specific contact group
     *
     * @param $id
     * @return mixed
     */
    public function deleteContactGroup($id)
    {
        return $this->client->delete('contact_group/' . $id);
    }
}
