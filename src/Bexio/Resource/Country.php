<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class Country extends Bexio {

    /**
     * Gets all the countries
     *
     * @param array $params
     * @return array
     */
    public function getCountries(array $params = [])
    {
        return $this->client->get('country', $params);
    }

    /**
     * Search for countries
     *
     * @param array $params
     * @return mixed
     */
    public function searchCountries(array $params = [])
    {
        return $this->client->post('country/search', $params);
    }

    /**
     * Get specific country
     *
     * @param $id
     * @return mixed
     */
    public function getCountry($id)
    {
        return $this->client->get('country/' . $id, []);
    }

    /**
     * Add new country
     * 
     * @param array $params
     * @return mixed
     */
    public function createCountry(array $params = [])
    {
        return $this->client->post('country', $params);
    }

    /**
     * Edit country
     *
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function editCountry($id, array $params = [])
    {
        return $this->client->post('country/'. $id, $params);
    }

    /**
     * Delete specific country
     *
     * @param $id
     * @return mixed
     */
    public function deleteCountry($id)
    {
        return $this->client->delete('country/' . $id);
    }
}
