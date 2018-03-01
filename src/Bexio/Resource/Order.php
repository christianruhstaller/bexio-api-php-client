<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class Order extends Bexio {

    /**
     * Gets all orders
     *
     * @return array
     */
    public function getOrders(array $params = [])
    {
        return $this->client->get('kb_order', $params);
    }

    /**
     * Search for orders
     *
     * @param array $params
     * @return mixed
     */
    public function searchOrders(array $params = [])
    {
        return $this->client->post('kb_order/search', $params);
    }

    /**
     * Get specific order
     *
     * @param $id
     * @return mixed
     */
    public function getOrder($id)
    {
        return $this->client->get('kb_order/' . $id, []);
    }

    /**
     * Add new order
     * 
     * @param array $params
     * @return mixed
     */
    public function createOrder($params = [])
    {
        return $this->client->post('kb_order', $params);
    }

    /**
     * Get repetition
     *
     * @param $id
     * @return mixed
     */
    public function getRepetition($id)
    {
        return $this->client->get('kb_order/' . $id . '/repetition', []);
    }

    /**
     * Create repetition
     *
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function createRepetition($id, $params = [])
    {
        return $this->client->post('kb_order/' . $id . '/repetition', $params);
    }

    /**
     * Delete repetition
     *
     * @param $id
     * @return mixed
     */
    public function deleteRepetition($id)
    {
        return $this->client->delete('kb_order/' . $id . '/repetition', []);
    }
}
