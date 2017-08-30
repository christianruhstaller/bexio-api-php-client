<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class Item extends Bexio {

    /**
     * Gets all items
     *
     * @return array
     */
    public function getItems(array $params = [])
    {
        return $this->client->get('article', $params);
    }
    
    /**
     * Get item types
     * 
     * @return array
     */
    public function getItemTypes(array $params = [])
    {
        return $this->client->get('article_type', $params);
    }

}
