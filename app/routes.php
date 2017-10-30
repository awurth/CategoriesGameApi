<?php

use App\Core\Rest\Router as RestRouter;
use App\Game\Controller\GameController;
use App\Game\Controller\GameRoundController;
use App\Game\Controller\SubjectController;
use App\Game\Controller\UserGameController;

$router = new RestRouter($container['router'], $container['config']['rest']);

/**
 * CORS Pre-flight request
 */
$app->options('/{routes:.+}', function ($request, $response) {
    return $response;
});

/**
 * Authentication
 */
$app->group('', function () use ($container) {
    $this->post('/register', 'security.auth.controller:register')->setName('register');
    $this->post('/login', 'security.auth.controller:login')->setName('login');
    $this->post('/auth/refresh', 'security.auth.controller:refresh')->setName('jwt.refresh');
    $this->get('/users/me', 'security.auth.controller:me')
        ->add($container['auth.middleware']())
        ->setName('users.me');
});

$app->get('/', 'core.controller:root')->setName('root');

$router->crud('subjects', SubjectController::class);

$games = $router->crud('games', GameController::class);
$games['post']->add($container['auth.middleware']());

$router->cgetSub('users', 'games', UserGameController::class);
$router->getSub('users', 'games', UserGameController::class);

$router->cgetSub('games', 'rounds', GameRoundController::class);
$router->getSub('games', 'rounds', GameRoundController::class);
$router->postSub('games', 'rounds', GameRoundController::class);

$app->patch('/games/{game_id:[0-9]+}/rounds/{round_id:[0-9]+}', GameRoundController::class . ':patchGameRound')
    ->setName('patch_game_round')
    ->add($container['auth.middleware']());
