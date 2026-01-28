<?php
declare(strict_types=1);

namespace OCA\ClubSuiteScores\Db;

use OCP\AppFramework\Db\QBMapper;
use OCP\DB\IDBConnection;

class ScoreMapper extends QBMapper {
    public function __construct(IDBConnection $db) {
        parent::__construct($db, 'clubsuite_scores', Score::class);
    }

    public function findAll(): array {
        $qb = $this->db->getQueryBuilder();
        $qb->select('*')
           ->from('clubsuite_scores')
           ->orderBy('title', 'ASC');
        return $this->findEntities($qb);
    }
}
