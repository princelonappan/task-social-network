<?php 

namespace Task\Statistics;

use Task\Model\Post;
use Task\Model\Posts;

class CalculateAveragePerMonth implements StatsInterface
{
    private $results = [];
    private $name = 'average_post_length';


    public function accessPosts(Posts $posts): void
    {
        $totals = [];
        $counts = [];
        if ($posts->count() > 0) {
            foreach ($posts->getPosts() as $post) {
                $month = $post->getCreatedTime()->format('m.Y');
                if (!isset($totals[$month])) {
                    $totals[$month] = 0;
                    $counts[$month] = 0;
                }
                $totals[$month] += strlen($post->getMessage());
                $counts[$month]++;
            }
        }
        foreach ($totals as $month => $total) {
            $this->results[$month] = number_format($total / $counts[$month], 1);
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