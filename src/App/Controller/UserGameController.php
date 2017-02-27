<?php

namespace App\Controller;

use App\Model\User;
use Respect\Validation\Validator as V;
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

    public function getGame(Request $request, Response $response, $id)
    {
        return $response;
    }

    public function postGame(Request $request, Response $response)
    {
        return $response;
    }

    public function putGame(Request $request, Response $response, $id)
    {
        return $response;
    }

    public function deleteGame(Request $request, Response $response, $id)
    {
        return $response;
    }
}
