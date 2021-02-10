<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class Title extends Bexio
{
    /**
     * Gets all the titles
     *
     * @param array $params
     * @return array
     */
    public function getTitles(array $params = [])
    {
        return $this->client->get('title', $params);
    }

    /**
     * Search for titles
     *
     * @param array $params
     * @return mixed
     */
    public function searchTitles(array $params = [])
    {
        return $this->client->post('title/search', $params);
    }

    /**
     * Get specific title
     *
     * @param $id
     * @return mixed
     */
    public function getTitle($id)
    {
        return $this->client->get('title/' . $id, []);
    }

    /**
     * Add new title
     *
     * @param array $params
     * @return mixed
     */
    public function createTitle(array $params = [])
    {
        return $this->client->post('title', $params);
    }

    /**
     * Edit title
     *
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function editTitle($id, array $params = [])
    {
        return $this->client->post('title/'. $id, $params);
    }

    /**
     * Delete specific title
     *
     * @param $id
     * @return mixed
     */
    public function deleteTitle($id)
    {
        return $this->client->delete('title/' . $id);
    }
}
