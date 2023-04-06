<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class Accounts extends Bexio {

    /**
     * Gets all the accounts
     *
     * @param array $params
     * @return array
     */
    public function getAccounts(array $params = [])
    {
        return $this->client->get('accounts', $params);
    }

    /**
     * Search for accounts
     *
     * @param array $params
     * @return mixed
     */
    public function searchAccounts(array $params = [])
    {
        return $this->client->post('accounts/search', $params);
    }
}
