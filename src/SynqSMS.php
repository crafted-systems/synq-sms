<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 3/13/18
 * Time: 12:09 AM
 */

namespace CraftedSystems\Synq;

use Unirest\Request;

class SynqSMS
{
    /**
     * Base URL.
     *
     * @var string
     */
    const BASE_URL = 'http://45.55.213.169/api/index.php';

    /**
     * settings .
     *
     * @var array.
     */
    protected $settings;

    /**
     * SynqSMS constructor.
     * @param $settings
     * @throws \Exception
     */
    public function __construct($settings)
    {
        $this->settings = (object)$settings;

        if (
            empty($this->settings->user) ||
            empty($this->settings->password) ||
            empty($this->settings->source)
        ) {
            throw new \Exception('Please ensure that all Synq SMS configuration variables have been set.');
        }
    }

    /**
     * @param $recipient
     * @param $message
     * @param $message_id
     * @return mixed
     * @throws \Exception
     */
    public function send($recipient, $message, $message_id)
    {
        if (!is_string($message)) {

            throw new \Exception('The Message Should be a string');
        }

        if (!is_string($recipient)) {
            throw new \Exception('The Phone number should be a string');
        }

        $source = $this->settings->source;
        $user = $this->settings->user;
        $password = $this->settings->password;

        $str = self::BASE_URL . "?dest=$recipient&message=$message&source=$source&msgID=$message_id&user=$user&passwd=$password";

        $response = Request::get($str);

        return $response->body;

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function getDeliveryReports(\Illuminate\Http\Request $request)
    {
        return json_decode($request->getContent());
    }

    /**
     * @return float
     */
    public function getBalance()
    {
        return 100;
    }

}