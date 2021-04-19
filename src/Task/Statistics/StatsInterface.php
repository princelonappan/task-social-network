<?php
 
namespace Task\Statistics;

use Task\Model\Posts;

interface StatsInterface
{
    public function accessPosts(Posts $posts) : void;

    public function getName(): string;

    public function getResults(): ?array;
}
