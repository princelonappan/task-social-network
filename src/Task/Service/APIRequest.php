<?php

namespace Task\Service;

use Task\Config\Configuration;
use Task\Helper\Curl;

class APIRequest
{
    /*
     * Function to fetch the posts based on the page number
     *
     * @param string $token
     * @param int $page
     *
     * @return array|null
     * */
    public function getPosts($token, $page) : ?array
    {
        $url = Configuration::POST_PATH;
        $data = (array(
            'sl_token' => $token,
            'page' => $page,
        ));
        Curl::prepare($url, $data);
        Curl::exec_get();
        $response = Curl::get_response_assoc();
        if($response['status_code'] != 200) {
            echo "Some error occured while fetching the posts";
        }
        return json_decode($response['response'], true);
    }

    /*
     * Function to generare the token for accessing the post API
     *
     * @param string $client_id
     * @param string $client_email
     * @param string $client_name
     *
     * @return array|null
     * */
    public function getToken($client_id, $client_email, $client_name) : ?array
    {
        
        $url = Configuration::REGISTER_PATH;
        $data = (array(
            'client_id' => $client_id,
            'email' => $client_email,
            'name' => $client_name,
        ));
        Curl::prepare($url, $data);
        Curl::exec_post();
        $response = Curl::get_response_assoc();
        if($response['status_code'] != 200) {
            echo "Some error occured while creating the token";
        }
        return json_decode($response['response'], true);
    }
}