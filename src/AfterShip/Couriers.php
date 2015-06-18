<?php

namespace AfterShip;

use AfterShip\Core\Request;

class Couriers extends Request
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
     * Return a list of couriers activated at your AfterShip account.
     *
     * @return mixed
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function get()
    {
        return $this->send('couriers', 'GET');
    }

    /**
     * Return a list of all couriers.
     *
     * @return mixed
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function all()
    {
        return $this->send('couriers/all', 'GET');
    }


    /**
     * Return a list of matched couriers based on tracking number format and selected couriers or a list of couriers.
     *
     * @param       $tracking_number
     * @param array $options
     *
     * @return mixed
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function detect($tracking_number, $options = array())
    {
        if (empty($tracking_number)) {
            throw new \Exception('Tracking number cannot be empty');
        }

        $data = array_merge($options, ['tracking_number' => $tracking_number]);

        return $this->send('couriers/detect/', 'POST', ['tracking' => $data]);
    }
}
