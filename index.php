<?php

use Task\Service\Stats;
use Task\Service\APIRequest;

require('vendor/autoload.php');

session_start();

$apiRequest = new APIRequest();

$stats = new Stats();

//Calculate Average Post per month
$average_per_month = new \Task\Statistics\CalcualteAveragePostsPerUserPerMonth();
$stats->add($average_per_month);

// Calculate Longest post
$longest_per_month = new \Task\Statistics\CalcualteLongestPostPerMonth();
$stats->add($longest_per_month);

//Total Post per week
$total_per_week = new \Task\Statistics\CalcualteTotalPostsPerWeek();
$stats->add($total_per_week);

//Average post per month
$average_per_user_per_month = new \Task\Statistics\CalculateAveragePerMonth();
$stats->add($average_per_user_per_month);

//Generate the Statistics and display the result
$results = $stats->generateStatistics($stats->getPosts($apiRequest));

echo json_encode($results);