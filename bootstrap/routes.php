<?php

use App\Service\RestRouter;

use App\Middleware\AuthMiddleware;

use App\Controller\SubjectController;
use App\Controller\GameController;
use App\Controller\GameRoundController;
use App\Controller\UserGameController;

$authMiddleware = new AuthMiddleware($container);

$router = new RestRouter($container['router'], $config['rest']);

/**
 * CORS Pre-flight request
 */
$app->options('/{routes:.+}', function ($request, $response) {
    return $response;
});

/**
 * Authentication
 */
$app->group('', function () use ($container, $authMiddleware) {
    $this->post('/register', 'AuthController:register')->setName('register');
    $this->post('/login', 'AuthController:login')->setName('login');
    $this->post('/auth/refresh', 'AuthController:refresh')->setName('jwt.refresh');
    $this->get('/users/me', 'AuthController:me')
        ->add($authMiddleware)
        ->setName('users.me');
});

$router->CRUD('subjects', SubjectController::class);

$games = $router->CRUD('games', GameController::class);
$games['post']->add($authMiddleware);

$router->cgetSub('users', 'games', UserGameController::class);
$router->getSub('users', 'games', UserGameController::class);

$router->cgetSub('games', 'rounds', GameRoundController::class);
$router->getSub('games', 'rounds', GameRoundController::class);
$router->postSub('games', 'rounds', GameRoundController::class);

$app->patch('/games/{game_id:[0-9]+}/rounds/{round_id:[0-9]+}', GameRoundController::class . ':patchGameRound')
    ->setName('patch_game_round')
    ->add($authMiddleware);
