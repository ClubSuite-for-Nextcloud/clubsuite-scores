<?php
namespace OCA\ClubSuiteScores\Job;

use OCP\BackgroundJob\TimedJob;

class ScoreStatsJob extends TimedJob {
    public function __construct() { parent::__construct(); }
    public function run($argument) {
        // compute aggregates, warm caches
    }
}
