<?php
declare(strict_types=1);

namespace OCA\ClubSuiteScores\Db;

use OCP\AppFramework\Db\Entity;

class Score extends Entity {
    protected $title;
    protected $composer;
    protected $arranger;
    protected $genre;
    protected $difficulty;
    protected $archiveLocation;

    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'composer' => $this->composer,
            'arranger' => $this->arranger,
            'genre' => $this->genre,
            'difficulty' => $this->difficulty,
            'archiveLocation' => $this->archiveLocation,
        ];
    }
}
