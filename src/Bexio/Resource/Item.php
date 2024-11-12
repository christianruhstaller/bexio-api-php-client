<?php

namespace Bexio\Resource;

use Bexio\Bexio;

/**
 * Class Item
 * @package Bexio\Resource
 * https://docs.bexio.com/ressources/article/
 */
class Item extends Bexio {

    /**
     * Gets all items
     *
     * @param array $params
     * @return array
     */
    public function getItems(array $params = [])
    {
        return $this->client->get('article', $params);
    }

    /**
     * Get item types
     *
     * @param array $params
     * @return array
     */
    public function getItemTypes(array $params = [])
    {
        return $this->client->get('article_type', $params);
    }

    /**
     * Add new article
     *
     * @param array $params
     * @return mixed
     */
    public function createItem($params = [])
    {
        return $this->client->post('article', $params);
    }

    /**
     * Edit article
     *
     * @param       $id
     * @param array $params
     * @return mixed
     */
    public function editItem($id, $params = [])
    {
        return $this->client->post('article/' . $id, $params);
    }
    
    /**
     * Get specific contact
     *
     * @param $id
     * @return mixed
     */
    public function getItem($id)
    {
        return $this->client->get('article/' . $id, []);
    }

}
