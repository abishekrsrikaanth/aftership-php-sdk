<?php

namespace AfterShip;

use AfterShip\Core\Request;

class Tracking extends Request
{
    public function __construct($api_key, $guzzle_plugins = array(), $api_version = "4")
    {
        if (empty($api_key)) {
            throw new \Exception('API Key is missing');
        }

        $this->_api_key = $api_key;

        if (count($guzzle_plugins) > 0) {
            $this->_guzzle_plugins = $guzzle_plugins;
        }

        parent::__construct();
        $this->_api_version = "v" . $api_version;
    }

    /**
     * Create a tracking.
     *
     * @param array $data
     *
     * @return array|bool|float|int|string
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function create(array $data)
    {
        if (empty($data)) {
            throw new \Exception('Tracking Request cannot be empty');
        }

        return $this->send('trackings', 'POST', json_encode(array('tracking' => $data)));
    }

    /**
     * Get tracking results of multiple trackings.
     *
     * @param array $options
     *
     * @return array|bool|float|int|string
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function get(array $options = array())
    {
        return $this->send('trackings', 'GET', $options);
    }

    /**
     * Delete a tracking by Id.
     * @param $id
     *
     * @return array|bool|float|int|string
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function deleteById($id)
    {
        return $this->send('trackings/' . $id, 'DELETE');
    }

    /**
     * Delete a tracking by Slug and Tracking Number.
     *
     * @param $slug
     * @param $tracking_number
     *
     * @return array|bool|float|int|string
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function deleteByTrackingNumber($slug, $tracking_number)
    {
        return $this->send('trackings/' . $slug . '/' . $tracking_number, 'DELETE');
    }

    /**
     * Get tracking results of a single tracking.
     *
     * @param       $slug
     * @param       $tracking_number
     * @param array $fields
     *
     * @return array|bool|float|int|string
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function info($slug, $tracking_number, array $fields = array())
    {
        if (empty($slug)) {
            throw new \Exception("Slug cannot be empty");
        }

        if (empty($tracking_number)) {
            throw new \Exception('Tracking number cannot be empty');
        }

        return $this->send('trackings/' . $slug . '/' . $tracking_number, 'GET', $fields);
    }

    /**
     * Update a tracking
     *
     * @param       $slug
     * @param       $tracking_number
     * @param array $options
     *
     * @return array|bool|float|int|string
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function update($slug, $tracking_number, array $options)
    {
        if (empty($slug)) {
            throw new \Exception("Slug cannot be empty");
        }

        if (empty($tracking_number)) {
            throw new \Exception('Tracking number cannot be empty');
        }

        return $this->send('trackings/' . $slug . '/' . $tracking_number, 'PUT', json_encode(array('tracking' => $options)));
    }

    /**
     * Retrack an expired tracking once. Max. 3 times per tracking.
     *
     * @param $slug
     * @param $tracking_number
     *
     * @return array|bool|float|int|string
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function reactivate($slug, $tracking_number)
    {
        if (empty($slug)) {
            throw new \Exception("Slug cannot be empty");
        }

        if (empty($tracking_number)) {
            throw new \Exception('Tracking number cannot be empty');
        }

        return $this->send('trackings/' . $slug . '/' . $tracking_number . '/retrack', 'POST');
    }
}
