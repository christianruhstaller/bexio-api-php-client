<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class Discount extends Bexio {

    /**
     * Gets all discounts
     * 
     * @param string $resource
     * @param int $parentId
     * @return array
     */
    public function getDiscounts($resource, $parentId, array $params = [])
    {
        return $this->client->get("$resource/$parentId/kb_position_discount", $params);
    }

    /**
     * Search for discounts
     *
     * @param string $resource 
     * @param int $parentId
     * @param array $params
     * @return mixed
     */
    public function searchDiscounts($resource, $parentId, array $params = [])
    {
        return $this->client->get("$resource/$parentId/kb_position_discount", $params);
    }

    /**
     * Get specific discount
     *
     * @param string $resource
     * @param $parentId
     * @param $id
     * @return mixed
     */
    public function getDiscount($resource, $parentId, $id)
    {
        return $this->client->get("$resource/$parentId/kb_position_discount/" . $id, []);
    }

    /**
     * Add new discount
     * 
     * @param string $resource
     * @param int $parentId
     * @param array $params
     * @return mixed
     */
    public function createDiscount($resource, $parentId, $params = [])
    {
        return $this->client->post("$resource/$parentId/kb_position_discount", $params);
    }

}
