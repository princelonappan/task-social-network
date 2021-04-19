<?php

namespace Task\Helper;

/**
 * Class curl
 * @package simple_curl
 */
class Curl
{

    protected static $url;
    protected static $headers;
    protected static $query;
    protected static $responses;
    protected static $statusCode;
    protected static $error;

    /**
     * @param $url
     * @param $headers
     * @param $query
     */
    public static function prepare($url, $query, $headers = array())
    {
        self::$url = $url;
        self::$headers = $headers;
        self::$query = http_build_query($query);
    }

    /**
     *  Execute post method curl request
     */
    public static function exec_post()
    {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, self::$headers);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, self::$query);
        self::$responses = curl_exec($curl);
        self::$error = curl_errno($curl);
        self::$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
    }

    /**
     *  Execute get method curl request
     */
    public static function exec_get()
    {

        $full_url = self::$url . '?' . self::$query;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $full_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, self::$headers);
        self::$responses = curl_exec($curl);
        self::$error = curl_errno($curl);
        self::$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
    }

    /**
     * @return mixed
     */
    public static function get_response()
    {
        return self::$responses;
    }

    /**
     * @return mixed
     */
    public static function get_response_assoc()
    {
        return array(
            'status_code' => self::$statusCode,
            'response' => self::$responses,
            'error' => self::$error
        );
    }
}
