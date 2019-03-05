<?php

namespace Bexio\Resource;

use Bexio\Bexio;

/**
 * Class Invoice
 *
 * @package Bexio\Resource
 * https://docs.bexio.com/ressources/kb_invoice/
 */
class Invoice extends Bexio
{

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
        return $this->client->get('kb_invoice/'.$id, []);
    }

    /**
     * Get specific invoice PDF
     *
     * @param $id
     * @return mixed
     */
    public function getPdf($id)
    {
        return $this->client->get('kb_invoice/'.$id.'/pdf', []);
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
     * @param       $id
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
        return $this->client->delete('kb_invoice/'.$id, []);
    }

    /**
     * Issue specific invoice
     *
     * @param $id
     * @return mixed
     */
    public function issueInvoice($id)
    {
        return $this->client->post('kb_invoice/'.$id.'/issue', []);
    }

    /**
     * Send specific invoice
     *
     * @param $id
     * @return mixed
     */
    public function sendInvoice($id)
    {
        return $this->client->post('kb_invoice/'.$id.'/send', []);
    }

    /**
     * Mark specific invoice as sent
     *s
     *
     * @param $id
     * @return mixed
     */
    public function markInvoiceAsSent($id)
    {
        return $this->client->post('kb_invoice/'.$id.'/mark_as_sent', []);
    }


    /**
     * Get comments
     *
     * @param $id
     * @return mixed
     */
    public function getComments($id)
    {
        return $this->client->get('kb_invoice/'.$id.'/comment');
    }

    /**
     * Get specific comment
     *
     * @param $id
     * @param $commentId
     * @return mixed
     */
    public function getComment($id, $commentId)
    {
        return $this->client->get('kb_invoice/'.$id.'/comment/'.$commentId);
    }

    /**
     * Create comment
     *
     * @param       $id
     * @param array $params
     * @return mixed
     */
    public function createComment($id, $params = [])
    {
        return $this->client->post('kb_invoice/'.$id.'/comment', $params);
    }

    /**
     * Get specific invoice payments
     *
     * @param $id
     * @return mixed
     */
    public function getInvoicePayments($id)
    {
        return $this->client->get('kb_invoice/'.$id.'/payment', []);
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
        return $this->client->get('kb_invoice/'.$id.'/payment/'.$paymentId, []);
    }

    /**
     * Create a new invoice payment
     *
     * @param array $params
     * @return mixed
     */
    public function createInvoicePayment($id, $params = [])
    {
        return $this->client->post('kb_invoice/'.$id.'/payment', $params);
    }

    /**
     * Celete a invoice payment
     *
     * @param $id
     * @param $paymentId
     * @return mixed
     */
    public function deleteInvoicePayment($id, $paymentId)
    {
        return $this->client->delete('kb_invoice/'.$id.'/payment/'.$paymentId, []);
    }
}
