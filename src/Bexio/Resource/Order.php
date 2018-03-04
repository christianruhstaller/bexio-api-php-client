<?php

namespace Bexio\Resource;

use Bexio\Bexio;
use Bexio\Contract\ItemPosition;

class Order extends Bexio implements ItemPosition {

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
     * Edit order
     *
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function editOrder($id, array $params = [])
    {
        return $this->client->post('kb_order/'. $id, $params);
    }

    /**
     * Delete order
     *
     * @param $id
     * @return mixed
     */
    public function deleteOrder($id)
    {
        return $this->client->delete('kb_order/' . $id);
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

    /**
     * @param $parentId
     * @param array $params
     * @return mixed
     */
    public function listItemPositions($parentId, $params = [])
    {
        return $this->client->get('kb_order/' . $parentId . '/kb_position_article', $params);
    }

    /**
     * @param $parentId
     * @param $itemId
     * @return mixed
     */
    public function showItemPosition($parentId, $itemId)
    {
        return $this->client->get('kb_order/' . $parentId . '/kb_position_article/' . $itemId);
    }

    /**
     * @param $parentId
     * @param array $params
     * @return mixed
     */
    public function createItemPosition($parentId, $params = [])
    {
        return $this->client->post('kb_order/' . $parentId . '/kb_position_article', $params);
    }

    /**
     * @param $parentId
     * @param $itemId
     * @param array $params
     * @return mixed
     */
    public function editItemPosition($parentId, $itemId, $params = [])
    {
        return $this->client->post('kb_order/' . $parentId . '/kb_position_article/' . $itemId, $params);
    }

    /**
     * @param $parentId
     * @param $itemId
     * @param array $params
     * @return mixed
     */
    public function overwriteItemPosition($parentId, $itemId, $params = [])
    {
        return $this->client->put('kb_order/' . $parentId . '/kb_position_article/' . $itemId, $params);
    }

    /**
     * @param $parentId
     * @param $itemId
     * @return mixed
     */
    public function deleteItemPosition($parentId, $itemId)
    {
        return $this->client->delete('kb_order/' . $parentId . '/kb_position_article/' . $itemId);
    }
}
