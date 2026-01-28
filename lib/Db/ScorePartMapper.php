<?php
declare(strict_types=1);

namespace OCA\ClubSuiteScores\Db;

use OCP\AppFramework\Db\QBMapper;
use OCP\DB\IDBConnection;

class ScorePartMapper extends QBMapper {
    public function __construct(IDBConnection $db) {
        parent::__construct($db, 'clubsuite_score_parts', ScorePart::class);
    }
    
    public function findByScore(int $scoreId): array {
        $qb = $this->db->getQueryBuilder();
        $qb->select('*')
           ->from('clubsuite_score_parts')
           ->where($qb->expr()->eq('score_id', $qb->createNamedParameter($scoreId)));
        return $this->findEntities($qb);
    }
}
