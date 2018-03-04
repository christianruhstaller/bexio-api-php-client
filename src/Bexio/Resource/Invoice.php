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
     */
    public function searchInvoices(array $params = [])
    {
        return $this->client->post('kb_invoice/search', $params);
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
     * Get specific invoice PDF
     *
     * @param $id
     * @return mixed
     */
    public function getInvoicePDF($id)
    {
        return $this->client->get('kb_invoice/' . $id . '/pdf', []);
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

    /**
     * Edit invoice
     *
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function editInvoice($id, $params = [])
    {
        return $this->client->post('kb_invoice/'.$id, $params);
    }

    /**
     * Delete invoice
     *
     * @param $id
     * @return mixed
     */
    public function deleteInvoice($id)
    {
        return $this->client->delete('kb_invoice/' . $id, []);
    }

    /**
     * Issue specific invoice
     *
     * @param $id
     * @return mixed
     */
    public function issueInvoice($id)
    {
        return $this->client->post('kb_invoice/' . $id . '/issue', []);
    }

    /**
     * Send specific invoice
     *
     * @param $id
     * @return mixed
     */
    public function sendInvoice($id)
    {
        return $this->client->post('kb_invoice/' . $id . '/send', []);
    }

    /**
     * Mark specific invoice as sent
     *
     * @param $id
     * @return mixed
     */
    public function markInvoiceAsSent($id)
    {
        return $this->client->post('kb_invoice/' . $id . '/mark_as_sent', []);
    }

    /**
     * Get specific invoice payments
     *
     * @param $id
     * @return mixed
     */
    public function getInvoicePayments($id)
    {
        return $this->client->get('kb_invoice/' . $id . '/payment', []);
    }

    /**
     * Get specific invoice payment
     *
     * @param $id
     * @param $paymentId
     * @return mixed
     */
    public function getInvoicePayment($id, $paymentId)
    {
        return $this->client->get('kb_invoice/' . $id . '/payment/' . $paymentId, []);
    }
}
