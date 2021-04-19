<?php 

namespace Task\Statistics;

use Task\Entity\Post;
use Task\Model\Posts;

class CalcualteTotalPostsPerWeek implements StatsInterface
{
    private $results = [];
    private $name = 'average_posts_per_week';

    public function accessPosts(Posts $posts) : void
    {
        $counts = [];
        if($posts->count() > 0) {
            foreach($posts->getPosts() as $post)
            {
                $dateTime = $post->getCreatedTime();
                $monday = clone $dateTime->modify(('Sunday' == $dateTime->format('l')) ? 'Monday last week' : 'Monday this week');

                $key = $monday->format('d.m.Y');
                if (!isset($counts[$key])) {
                    $counts[$key] = 0;
                }
                $counts[$key]++;
            }
        }
        foreach($counts as $key => $count) {
            $this->results[$key] = $count;
        }
        uksort($this->results, function($a, $b) {
            $tm1 = strtotime($a);
            $tm2 = strtotime($b);
            return ($tm1 < $tm2) ? 1 : (($tm1 > $tm2) ? -1 : 0);
        });
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