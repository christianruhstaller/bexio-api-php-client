<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class AdditionalAddress extends Bexio {

    /**
     * Gets all the additional addresses
     *
     * @param array $params
     * @return array
     */
    public function getAdditionalAddresses(int $contactId, array $params = [])
    {
        return $this->client->get("contact/$contactId/additional_address", $params);
    }

    /**
     * Search for additional addresses
     *
     * @param array $params
     * @return mixed
     */
    public function searchAdditionalAddresses(int $contactId, array $params = [])
    {
        return $this->client->post("contact/$contactId/additional_address/search", $params);
    }

    /**
     * Get specific additional address
     *
     * @param $id
     * @return mixed
     */
    public function getAdditionalAddress(int $contactId, int $additionalAddressId)
    {
        return $this->client->get("contact/$contactId/additional_address/$additionalAddressId", []);
    }

    /**
     * Add new additional address
     * 
     * @param array $params
     * @return mixed
     */
    public function createAdditionalAddress(int $contactId, array $params = [])
    {
        return $this->client->post("contact/$contactId/additional_address", $params);
    }

    /**
     * Edit additional address
     *
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function editAdditionalAddress(int $contactId, int $additionalAddressId, array $params = [])
    {
        return $this->client->post("contact/$contactId/additional_address/$additionalAddressId", $params);
    }

    /**
     * Delete specific additional address
     *
     * @param $id
     * @return mixed
     */
    public function deleteAdditionalAddress(int $contactId, int $additionalAddressId)
    {
        return $this->client->delete("contact/$contactId/additional_address/$additionalAddressId");
    }
}
