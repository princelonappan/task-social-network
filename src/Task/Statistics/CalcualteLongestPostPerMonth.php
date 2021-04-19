<?php

namespace Task\Statistics;

use Task\Model\Post;
use Task\Model\Posts;

class CalcualteLongestPostPerMonth implements StatsInterface
{
    private $results = [];
    private $name = 'longest_post';

    public function accessPosts(Posts $posts) : void
    {
        $longest_post = [];
        if($posts->count() > 0) {
            foreach($posts->getPosts() as $post)
            {
                $month = $post->getCreatedTime()->format('m.Y');
                $length = strlen($post->getMessage());
                if (!isset($longest_post[$month])) {
                    $longest_post[$month] = 0;
                }
                if($length > $longest_post[$month])
                {
                    $longest_post[$month] = $length;
                }
            }
        }
        foreach($longest_post as $month => $max) {
            $this->results[$month] = $max;
        }
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function getResults() : array
    {
        return $this->results;
    }
}