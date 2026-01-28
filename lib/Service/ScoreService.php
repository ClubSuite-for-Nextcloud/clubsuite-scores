<?php
declare(strict_types=1);

namespace OCA\ClubSuiteScores\Service;

use OCA\ClubSuiteScores\Db\Score;
use OCA\ClubSuiteScores\Db\ScoreMapper;
use OCA\ClubSuiteScores\Db\ScorePart;
use OCA\ClubSuiteScores\Db\ScorePartMapper;
use OCA\ClubSuiteScores\Db\ScoreLoan;
use OCA\ClubSuiteScores\Db\ScoreLoanMapper;
use OCP\AppFramework\Db\DoesNotExistException;

class ScoreService {
    private $scoreMapper;
    private $partMapper;
    private $loanMapper;

    public function __construct(ScoreMapper $scoreMapper, ScorePartMapper $partMapper, ScoreLoanMapper $loanMapper) {
        $this->scoreMapper = $scoreMapper;
        $this->partMapper = $partMapper;
        $this->loanMapper = $loanMapper;
    }

    public function findAll(): array {
        return $this->scoreMapper->findAll();
    }

    public function createScore(string $title, ?string $composer, ?string $arranger, ?string $genre, int $difficulty, ?string $archiveLocation): Score {
        $score = new Score();
        $score->setTitle($title);
        $score->setComposer($composer);
        $score->setArranger($arranger);
        $score->setGenre($genre);
        $score->setDifficulty($difficulty);
        $score->setArchiveLocation($archiveLocation);
        return $this->scoreMapper->insert($score);
    }

    public function updateScore(int $id, string $title, ?string $composer, ?string $arranger, ?string $genre, int $difficulty, ?string $archiveLocation): Score {
        try {
            /** @var Score $score */
            $score = $this->scoreMapper->find($id);
            $score->setTitle($title);
            $score->setComposer($composer);
            $score->setArranger($arranger);
            $score->setGenre($genre);
            $score->setDifficulty($difficulty);
            $score->setArchiveLocation($archiveLocation);
            return $this->scoreMapper->update($score);
        } catch (DoesNotExistException $e) {
            throw $e;
        }
    }
    
    public function deleteScore(int $id) {
        try {
            $score = $this->scoreMapper->find($id);
            $this->scoreMapper->delete($score);
        } catch (DoesNotExistException $e) {
            // handle
        }
    }

    // Parts
    public function getParts(int $scoreId): array {
        return $this->partMapper->findByScore($scoreId);
    }
}
