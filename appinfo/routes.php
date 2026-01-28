<?php
return [
    'routes' => [
        ['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
        
        // API
        ['name' => 'score_api#index', 'url' => '/api/scores', 'verb' => 'GET'],
        ['name' => 'score_api#create', 'url' => '/api/scores', 'verb' => 'POST'],
        ['name' => 'score_api#update', 'url' => '/api/scores/{id}', 'verb' => 'PUT'],
        ['name' => 'score_api#destroy', 'url' => '/api/scores/{id}', 'verb' => 'DELETE'],
        
        ['name' => 'score_api#getParts', 'url' => '/api/scores/{id}/parts', 'verb' => 'GET'],
    ]
];
