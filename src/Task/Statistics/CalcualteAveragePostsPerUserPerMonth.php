<?php

namespace Task\Statistics;

use Task\Model\Post;
use Task\Model\Posts;

class CalcualteAveragePostsPerUserPerMonth implements StatsInterface
{
    private $results = [];
    private $name = 'average_user_posts_per_month';

    /*
     * Calcualte the average user posts per month
     * 
     * */
    public function accessPosts(Posts $posts): void
    {
        $collection = [];
        if ($posts->count() > 0) {
            foreach ($posts->getPosts() as $post) {
                $month = $post->getCreatedTime()->format('m.Y');
                $user = $post->getFromId();
                if (!isset($collection[$month])) {
                    $collection[$month] = [];
                }
                if (!isset($collection[$month][$user])) {
                    $collection[$month][$user] = 0;
                }
                $collection[$month][$user]++;
            }
        }
        foreach ($collection as $month => $userPosts) {
            $total = 0;
            foreach ($userPosts as $user => $posts) {
                $total += $posts;
            }
            $this->results[$month] = number_format($total / count($userPosts), 1);
        }
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function getResults(): array
    {
        return $this->results;
    }
}