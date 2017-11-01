<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class Invoice extends Bexio {

    /**
     * Gets all orders
     *
     * @return array
     */
    public function getInvoices(array $params = [])
    {
        return $this->client->get('kb_invoice', $params);
    }

    /**
     * Search for invoices
     *
     * @param array $params
     * @return mixed
     * @deprecated in favor of searchInvoices
     */
    public function searchOrders(array $params = [])
    {
       $this->searchInvoices($params);
    }

    /**
     * Search for invoices
     *
     * @param array $params
     * @return mixed
     */
    public function searchInvoices(array $params = [])
    {
        return $this->client->get('kb_invoice/search', $params);
    }

    /**
     * Get specific invoice
     *
     * @param $id
     * @return mixed
     */
    public function getInvoice($id)
    {
        return $this->client->get('kb_invoice/' . $id, []);
    }

    /**
     * Add new invoice
     * 
     * @param array $params
     * @return mixed
     */
    public function createInvoice($params = [])
    {
        return $this->client->post('kb_invoice', $params);
    }

}
