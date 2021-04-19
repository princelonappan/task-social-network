<?php

namespace Task\Service;

use Task\Statistics\StatsInterface;
use Task\Model\Posts;
use Task\Model\Post;
use Task\Config\Configuration;


class Stats
{
    private $statistics = [];

    public function add(StatsInterface $statistics)
    {
        $this->statistics[] = $statistics;
    }

    public function generateStatistics(Posts $posts) : array
    {
        $results = [];
        foreach($this->statistics as $statistics)
        {
            $statistics->accessPosts($posts);
            $results[$statistics->getName()] = $statistics->getResults();
        }
        return $results;
    }


    /*
     * Get the Posts
     *
     * return Posts|null
     * */
    public function getPosts(APIRequest $apiRequest) : ? Posts
    {
        $posts = new Posts();
        $token = $this->getToken($apiRequest);
        if ($token !== '') {
            for($page = 1; $page <= 10; $page++) {
                $items = $apiRequest->getPosts($token, $page);
                foreach ($items['data']['posts'] as $item) {
                    $posts->addPost(new Post($item));
                }
            }
            return $posts;
        }
        return null;
    }

    /*
     * Get the token 
     * 
     * @return string
     * */
    public function getToken(APIRequest $apiRequest): string
    {
        if (isset($_SESSION['token']) && ((time() - $_SESSION['time']) > 60 * 60)) {
            return $_SESSION['token'];
        }

        $token = $apiRequest->getToken( Configuration::CLIENT_ID, Configuration::EMAIL, Configuration::NAME);
        if (!is_null($token)) {
            $_SESSION['token'] = $token['data']['sl_token'];
            $_SESSION['time'] = time();
            return $token['data']['sl_token'];
        }
        return '';
    }
}