<?php
declare(strict_types=1);

namespace OCA\ClubSuiteScores\Controller;

use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataResponse;
use OCP\IRequest;
use OCA\ClubSuiteScores\Service\ScoreService;

class ScoreApiController extends Controller {
    private $service;
    private $userId;

    public function __construct(string $appName, IRequest $request, ScoreService $service, ?string $UserId) {
        parent::__construct($appName, $request);
        $this->service = $service;
        $this->userId = $UserId;
    }

    /**
     * @NoAdminRequired
     */
    public function index(): DataResponse {
        return new DataResponse($this->service->findAll());
    }

    /**
     * @NoAdminRequired
     */
    public function create(string $title, ?string $composer = null, ?string $arranger = null, ?string $genre = null, int $difficulty = 0, ?string $archiveLocation = null): DataResponse {
        // TODO: Permissions check
        return new DataResponse($this->service->createScore($title, $composer, $arranger, $genre, $difficulty, $archiveLocation));
    }

    /**
     * @NoAdminRequired
     */
    public function update(int $id, string $title, ?string $composer = null, ?string $arranger = null, ?string $genre = null, int $difficulty = 0, ?string $archiveLocation = null): DataResponse {
        return new DataResponse($this->service->updateScore($id, $title, $composer, $arranger, $genre, $difficulty, $archiveLocation));
    }

    /**
     * @NoAdminRequired
     */
    public function destroy(int $id): DataResponse {
        $this->service->deleteScore($id);
        return new DataResponse([]);
    }

    /**
     * @NoAdminRequired
     */
    public function getParts(int $id): DataResponse {
        return new DataResponse($this->service->getParts($id));
    }
}
