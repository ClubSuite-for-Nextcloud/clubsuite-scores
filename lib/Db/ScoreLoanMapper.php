<?php
declare(strict_types=1);

namespace OCA\ClubSuiteScores\Db;

use OCP\AppFramework\Db\QBMapper;
use OCP\DB\IDBConnection;

class ScoreLoanMapper extends QBMapper {
    public function __construct(IDBConnection $db) {
        parent::__construct($db, 'clubsuite_score_loans', ScoreLoan::class);
    }

    public function findActiveByPart(int $partId): ?ScoreLoan {
        $qb = $this->db->getQueryBuilder();
        $qb->select('*')
            ->from('clubsuite_score_loans')
            ->where($qb->expr()->eq('part_id', $qb->createNamedParameter($partId)))
            ->andWhere($qb->expr()->isNull('returned_at'));
        
        try {
            return $this->findEntity($qb);
        } catch (\OCP\AppFramework\Db\DoesNotExistException $e) {
            return null;
        }
    }
}
