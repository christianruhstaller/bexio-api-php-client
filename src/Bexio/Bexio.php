<?php

namespace Bexio;

class Bexio
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get available salutations
     *
     * @return mixed
     */
    public function getSalutations()
    {
        return $this->client->get('salutation', []);
    }

    /**
     * Get available titles
     *
     * @return mixed
     */
    public function getTitles()
    {
        return $this->client->get('title', []);
    }

	/**
	 * Get available languages
	 *
	 * @return mixed
	 */
	public function getLanguages()
	{
		return $this->client->get('language', []);
	}

	/**
	 * Get available taxes
	 *
	 * @return mixed
	 */
	public function getTaxes(array $requestParams = [])
	{
		return $this->client->get('taxes', $requestParams, '3.0');
	}
}
