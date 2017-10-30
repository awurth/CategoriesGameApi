<?php

namespace App\Game\Controller;

use App\Core\Controller\Controller;
use App\Game\Model\Subject;
use Respect\Validation\Validator as V;
use App\Game\Model\Game;
use Slim\Http\Request;
use Slim\Http\Response;

class GameController extends Controller
{
    public function getGames(Request $request, Response $response)
    {
        return $this->ok($response, Game::with('subjects')->get());
    }

    public function getGame(Request $request, Response $response, $id)
    {
        $game = Game::with('subjects')->find($id);

        if (null === $game) {
            throw $this->notFoundException($request, $response);
        }

        return $this->ok($response, $game);
    }

    public function postGame(Request $request, Response $response)
    {
        $this->validator->validate($request, [
            'subjects' => V::arrayType()->notEmpty()
        ]);

        if ($this->validator->isValid()) {
            $subjectsIds = $request->getParam('subjects');
            $subjects = Subject::find($subjectsIds);

            if (count($subjectsIds) !== $subjects->count()) {
                $this->validator->addError('subjects', 'One or more subjects don\'t exist');
            }
        }

        if ($this->validator->isValid()) {
            $game = new Game();
            $game->owner()->associate($this->getUser());
            $game->save();

            $game->subjects()->attach($subjects);

            return $this->created($response, 'get_game', [
                'id' => $game->id
            ]);
        }

        return $this->validationErrors($response);
    }

    public function putGame(Request $request, Response $response, $id)
    {
        $game = Game::find($id);

        if (null === $game) {
            throw $this->notFoundException($request, $response);
        }

        $this->validator->validate($request, [
            'subjects' => V::arrayType()->notEmpty()
        ]);

        if ($this->validator->isValid()) {
            $subjectsIds = $request->getParam('subjects');
            $subjects = Subject::find($subjectsIds);

            if (count($subjectsIds) !== $subjects->count()) {
                $this->validator->addError('subjects', 'One or more subjects don\'t exist');
            }
        }

        if ($this->validator->isValid()) {
            $game->subjects()->sync($subjects);

            return $this->noContent($response);
        }

        return $this->validationErrors($response);
    }

    public function deleteGame(Request $request, Response $response, $id)
    {
        $game = Game::find($id);

        if (null === $game) {
            throw $this->notFoundException($request, $response);
        }

        $game->values()->delete();
        $game->subjects()->detach();
        $game->rounds()->delete();
        $game->delete();

        return $this->noContent($response);
    }
}
