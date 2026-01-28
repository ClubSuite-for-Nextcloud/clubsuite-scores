<?php
declare(strict_types=1);

namespace OCA\ClubSuiteScores\Db;

use OCP\AppFramework\Db\Entity;

class ScorePart extends Entity {
    protected $scoreId;
    protected $instrument;
    protected $partName;
    protected $isDigital;
    protected $filePath;
    
    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'scoreId' => $this->scoreId,
            'instrument' => $this->instrument,
            'partName' => $this->partName,
            'isDigital' => $this->isDigital,
            'filePath' => $this->filePath,
        ];
    }
}
