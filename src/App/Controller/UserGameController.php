<?php

namespace App\Controller;

use App\Model\Game;
use App\Model\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UserGameController extends Controller
{
    public function getUserGames(Request $request, Response $response, $id)
    {
        $user = User::with(['ownGames.subjects', 'playedGames.subjects'])->find($id);

        if (null === $user) {
            throw $this->notFoundException($request, $response);
        }

        return $this->ok($response, array_merge($user->ownGames->toArray(), $user->playedGames->toArray()));
    }

    public function getUserGame(Request $request, Response $response, $userId, $gameId)
    {
        $user = User::find($userId);

        if (null === $user) {
            throw $this->notFoundException($request, $response);
        }

        $game = Game::with('subjects')->find($gameId);

        if (null === $game) {
            throw $this->notFoundException($request, $response);
        }

        return $this->ok($response, $game);
    }
}
