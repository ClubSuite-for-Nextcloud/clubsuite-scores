<?php
namespace OCA\ClubSuiteScores\Service;

use OCA\ClubSuiteScores\Db\PartMapper;
use OCA\ClubSuiteScores\Db\PartEntity;

class PartService {
    private PartMapper $mapper;

    public function __construct(PartMapper $mapper) { $this->mapper = $mapper; }

    public function listForScore(int $scoreId): array { return $this->mapper->findByScore($scoreId); }
    public function getPart(int $id): ?PartEntity { return $this->mapper->findById($id); }
    public function createPart(PartEntity $p): int { return $this->mapper->create($p); }
    public function updatePart(PartEntity $p): void { $this->mapper->update($p); }
    public function deletePart(int $id): void { $this->mapper->delete($id); }
}
