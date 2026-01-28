<?php
declare(strict_types=1);

namespace OCA\ClubSuiteScores\Db;

use OCP\AppFramework\Db\Entity;

class ScoreLoan extends Entity {
    protected $partId;
    protected $userId;
    protected $loanedAt;
    protected $returnedAt;

    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'partId' => $this->partId,
            'userId' => $this->userId,
            'loanedAt' => $this->loanedAt,
            'returnedAt' => $this->returnedAt,
        ];
    }
}
