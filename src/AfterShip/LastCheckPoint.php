<?php

namespace AfterShip;

use AfterShip\Core\Request;

/**
 * Get tracking information of the last checkpoint of a tracking.
 * Class LastCheckPoint
 * @package AfterShip
 */
class LastCheckPoint extends Request
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
     * Return the tracking information of the last checkpoint of a single tracking.
     *
     * @param $slug
     * @param $tracking_number
     * @param array $options Pass optional Parameters
     *
     * @return mixed
     * @throws \Exception
     */
    public function get($slug, $tracking_number, $options = array())
    {
        if (empty($slug)) {
            throw new \Exception("Slug cannot be empty");
        }

        if (empty($tracking_number)) {
            throw new \Exception('Tracking number cannot be empty');
        }

        return $this->send('last_checkpoint/' . $slug . '/' . $tracking_number, 'GET', $options);
    }
} 