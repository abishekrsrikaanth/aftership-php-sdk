<?php
namespace AfterShip;


use AfterShip\Core\Request;

class Notifications extends Request
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
     * Get notifications value from a tracking number.
     *
     * @param       $slug
     * @param       $tracking_number
     * @param array $options
     *
     * @return array|bool|float|int|string
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function get($slug, $tracking_number, $options = array())
    {
        return $this->send('notifications/' . $slug . '/' . $tracking_number, 'GET', $options);
    }

    /**
     * Get notifications value from a tracking number using the Tracking Id
     *
     * @param       $id
     * @param array $options
     *
     * @return array|bool|float|int|string
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function getById($id, $options = array())
    {
        return $this->send('notifications/' . $id, 'GET', $options);
    }

    /**
     * Add notifications to a tracking number.
     *
     * @param       $slug
     * @param       $tracking_number
     * @param array $options
     *
     * @return array|bool|float|int|string
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function add($slug, $tracking_number, $options)
    {
        return $this->send('notifications/' . $slug . '/' . $tracking_number . '/add', 'POST', ['notification' => $options]);
    }

    /**
     *  Add notifications to a tracking number using the Tracking Id
     *
     * @param       $id
     * @param array $options
     *
     * @return array|bool|float|int|string
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function addById($id, $options)
    {
        return $this->send('notifications/' . $id . '/add', 'POST', ['notification' => $options]);
    }

    /**
     * Remove notifications from a tracking number.
     *
     * @param       $slug
     * @param       $tracking_number
     * @param array $options
     *
     * @return array|bool|float|int|string
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function remove($slug, $tracking_number, $options)
    {
        return $this->send('notifications/' . $slug . '/' . $tracking_number . '/remove', 'POST', ['notification' => $options]);
    }

    /**
     * Remove notifications from a tracking number using the Tracking Id.
     *
     * @param       $id
     * @param array $options
     *
     * @return array|bool|float|int|string
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function removeById($id, $options)
    {
        return $this->send('notifications/' . $id . '/remove', 'POST', 'POST', ['notification' => $options]);
    }
}