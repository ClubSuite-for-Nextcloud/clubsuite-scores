<?php
namespace OCA\ClubSuiteScores\Service;

use OCA\ClubSuiteScores\Db\AssignmentMapper;
use OCA\ClubSuiteScores\Db\AssignmentEntity;

class AssignmentService {
    private AssignmentMapper $mapper;

    public function __construct(AssignmentMapper $mapper) { $this->mapper = $mapper; }

    public function listForPart(int $partId): array { return $this->mapper->findByPart($partId); }
    public function getAssignment(int $id): ?AssignmentEntity { return $this->mapper->findById($id); }
    public function createAssignment(AssignmentEntity $a): int { return $this->mapper->create($a); }
    public function deleteAssignment(int $id): void { $this->mapper->delete($id); }
}
